<?php


class User
{

    private $error = "";

    //function register user
    function Signup($POST)
    {

        $data = array();
        $db = Database::getInstance();

        $data['name']       = trim($POST['name']);
        $data['email']      = trim($POST['email']);
        $data['password']   = trim($POST['password']);
        $password2          = trim($POST['password2']);

        //validate email
        if (empty($data['email']) || !preg_match("/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/", $data['email'])) {
            $this->error .= "Please enter a valid email <br>";
        }

        //validate name
        if (empty($data['name']) || !preg_match("/^[a-zA-Z]+$/", $data['name'])) {
            $this->error .= "Please enter a valid name <br>";
        }

        //validate password 1 equal to password2
        if ($data['password'] !== $password2) {
            $this->error .= "Passwords do not match <br>";
        }

        // Check if the password is at least 4 characters long
        if (strlen($data['password']) < 4) {
            $this->error .= "Password must be at least 4 characters <br>";
        }


        //Check if the email exists

        $sql = "select * from users where email = :email limit 1";
        $arr['email'] = $data['email'];
        $check = $db->read($sql, $arr);
        if (is_array($check)) {

            $this->error .= "That email already exits! <br>";
        }


        //Generate a random string with numbers and letters to assign to user
        // This will be use like content access token
        $data['url_address'] = $this->get_random_string_max(60);

        $arr = false;
        $sql = "select * from users where url_address = :url_address limit 1";
        $arr['url_address'] = $data['url_address'];
        $check = $db->read($sql, $arr);
        // var_dump($arr);
        if (is_array($check)) {
            $data['url_address'] = $this->get_random_string_max(60);
        }


        if ($this->error == "") {
            $data['role'] = "costumer";
            $data['date'] = date("Y-m-d H:i:s");

            $data['password'] = hash('sha1', $data['password']);
            $query = "insert into users (email,name,password,date,role,url_address) values(:email,:name,:password,:date,:role,:url_address)";
            $result = $db->write($query, $data);
            if ($result) {
                header("location: " . ROOT . "login");
                die;
            }
        }
        $_SESSION['error'] = $this->error;
    }

    // Private method to generate a random string
    private function get_random_string_max($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $random_string = '';

        for ($i = 0; $i < $length; $i++) {
            $random_string .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $random_string;
    }

    // Function to authenticate user
    function Login($POST)
    {

        $data = array();
        $db = Database::getInstance();

         // Assign email and password values from POST to the data array for login
        $data['email'] = trim($POST['email']);
        $data['password'] = trim($POST['password']);

        // Check if the email is valid
        if (empty($data['email']) || !preg_match("/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/", $data['email'])) {
            $this->error .= "Please enter a valid email <br>";
        }

        // Check if the password is at least 4 characters long
        if (strlen($data['password']) < 4) {
            $this->error .= "Password must be at least 4 characters <br>";
        }

        if ($this->error == "") {

            $data['password'] = hash('sha1', $data['password']);

            $sql = "select * from users where email = :email && password = :password limit 1";
            $arr['email'] = $data['email'];
            $result = $db->read($sql, $data);

            if (is_array($result)) {
                $_SESSION['user_url'] = $result[0]->url_address;
                header("Location: " . ROOT . "index");
                die;
            }
            $this->error .= "Wrong email or password! <br>";
        }

        $_SESSION['error'] = $this->error;
    }

    // Function to log out user
    public function logout()
    {
        if (isset($_SESSION['user_url'])) {
            unset($_SESSION['user_url']);
        }

        header("Location: " . ROOT . "login");
        die;
    }

    // Function to check if user is logged in
    function check_login($redirect = false, $allowed = array())
    {
        if (!isset($_SESSION['user_url'])) {
            if ($redirect) {
                header("Location: " . ROOT . "login");
                exit;
            }
            return false;
        }
        $db = Database::getInstance();
        $url = $_SESSION['user_url'];
        $query = "SELECT * FROM users WHERE url_address = :url LIMIT 1";
        $result = $db->read($query, array('url' => $url));
        if (!$result) {
            if ($redirect) {
                header("Location: " . ROOT . "login");
                exit;
            }
            return false;
        }

        $user = $result[0];
        if (!empty($allowed) && !in_array($user->role, $allowed)) {
            if ($redirect) {
                header("Location: " . ROOT . "login");
                exit;
            }
            return false;
        }

        return $user;
    }
}
