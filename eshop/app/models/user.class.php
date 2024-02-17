<?php

Class User 
{

    private $error = "";

    function SignUp($POST)
    {

        $data = array();
        $db = Database::getInstance();

        $data['name']       = trim($POST['name']);
        //$data['username']   = trim($POST['username']);
        $data['email']      = trim($POST['email']);
        $data['password']   = trim($POST['password']);
        $password2          = trim($POST['password2']);

        //validation for you write an email corretly
        if(empty($data['email']) || !preg_match("/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/", $data['email']))
        {
            $this->error .= "Please enter a valid email <br>";
        }

        //validation for you write a name corretly
        if(empty($data['name']) || !preg_match("/^[a-zA-Z]+$/", $data['name'] ))
        {
            $this->error .= "Please enter a valid name <br>";
        }

        //validation for password equal
        if($data['password'] !== $password2 )
        {
            $this->error .= "Password must to be equal! <br>";
        }

        //validation for minimal password lenght
        if(strlen($data['password']) < 4 )
        {
            $this->error .= "Password must be at last 4 characters long! <br>";
        }

        /*
        * Check if the email exists
        */
        $sql = "select * from users where email = :email limit 1";
        $arr['email'] = $data['email'];
        $check= $db->read($sql,$arr);
        if(is_array($check)){

            $this->error .= "That email already exits! <br>";
        
        }

        $data['url_address'] = $this->get_random_string_max(60);
        
        /*
        * Check if the url_address exists
        */
        $arr =false;
        $sql = "select * from users where url_address = :url_address limit 1";
        $arr['url_address'] = $data['url_address'];
        $check= $db->read($sql,$arr);
        if(is_array($check)){

            $data['url_address'] = $this->get_random_string_max(60);
        
        }

        if($this->error == "")
        {
            //save at database
            $data['role'] = "costumer";
            $data['date'] = date("Y-m-d H:i:s");
            $data['password'] = hash('sha1', $data['password']);
            
            $query = "insert into users (url_address,name,email,password,date,role) values(:url_address,:name,:email,:password,:date,:role)";            
            $result = $db->write($query,$data);

            if($result)
            {
                header("Location: " . ROOT . "login");
                die;
            }
        }

        $_SESSION['error'] = $this->error;
    }

    function Login($POST)
    {
        $data = array();
        $db = Database::getInstance();

        $data['email']      = trim($POST['email']);
        $data['password']   = trim($POST['password']);

        //validation for you write an email corretly
        if(empty($data['email']) || !preg_match("/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/", $data['email']))
        {
            $this->error .= "Please enter a valid email <br>";
        }

        //validation for minimal password lenght
        if(strlen($data['password']) < 4 )
        {
            $this->error .= "Password must be at last 4 characters long! <br>";
        }


        if($this->error == "")
        {
            //confirm
            $data['password'] = hash('sha1', $data['password']);
            
            $sql = "select * from users where email = :email && password = :password limit 1";
            $arr['email'] = $data['email'];
            $result= $db->read($sql,$data);
            
            if(is_array($result))
            {
                $_SESSION['user_url'] = $result[0]->url_address;
                header("Location: " . ROOT . "home");
                die;
        
            }
            $this->error .= "Wrong email or password! <br>";
        }

        $_SESSION['error'] = $this->error;
    }

    function get_user($url)
    {
        
    }

    // Private method to generate a random string
    private function get_random_string_max($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $random_string = '';

        for ($i = 0; $i < $length; $i++) {
            $random_string .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $random_string;
    }

    //Function to check login
    function check_login($redirect=false)
    {
        if(isset($_SESSION['user_url']))
        {
            $arr['url'] = $_SESSION['user_url'];
            $query = "select * from users where url_address = :url limit 1";
            $db = Database::getInstance();

            $result = $db->read($query,$arr);
            if(is_array($result))
            {
                return $result[0];
            }
        }

        if($redirect)
        {
            header("Location: " . ROOT . "login");
            die;
        }

        return false;
    }

    //Function to logout
    public function logout()
    {
        if(isset($_SESSION['user_url']))
        {
            unset($_SESSION['user_url']);
        }

        header("Location: " . ROOT . "login");
                die;
    }

}