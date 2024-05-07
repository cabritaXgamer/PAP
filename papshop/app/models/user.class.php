<?php


Class User
{

    private $error = "";

    function Signup($POST)
    {

        $data = array();
        $db = Database::getInstance();

        $data['name']       = trim($POST['name']);
        //$data['username']   = trim($POST['username']);
        $data['email']      = trim($POST['email']);
        $data['password']   = trim($POST['password']);
        $password2          = trim($POST['password2']);

        //var_dump($data[0]);

        //validação de email
        if (empty($data['email']) || !preg_match("/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/", $data['email'])) 
            { 
                $this->error .= "Please enter a valid email <br>";
            }

        //validação do nome
        if (empty($data['name']) || !preg_match("/^[a-zA-Z]+$/", $data['name'])){
            $this->error .= "Please enter a valid name <br>";
        }

        //verificar se a password é igual à password2
        if ($data['password'] !== $password2){
            $this->error .= "Passwords do not match <br>";
        }
        
        //validação do tamanho da senha (min 4 caracteres)
        if (strlen($data['password']) < 4) {
            $this->error .= "Password must be at least 4 characters <br>";
        }

       
        //Check if the email exists
        
        $sql = "select * from users where email = :email limit 1";
        $arr['email'] = $data['email'];
        $check= $db->read($sql,$arr);
        if(is_array($check)){

            $this->error .= "That email already exits! <br>";
        
        }
        

        //Generate a random string with numbers and letters to assign to user
        // This will be use like content access token
        $data['url_address'] = $this->get_random_string_max(60);

        //verificar as URL
        
        $arr = false;
        $sql = "select * from users where url_address = :url_address limit 1"; 
        $arr['url_address'] = $data['url_address'];
        $check = $db->read ($sql, $arr);
        // var_dump($arr);
        if (is_array($check)) {
        $data['url_address'] = $this->get_random_string_max (60);
        }

        

        
        if ($this->error ==""){
            // Para testar com a minha base de dados
            $data['role'] = "costumer";
            $data['date'] = date("Y-m-d H:i:s");

            //Hash a palavra passe
            $data['password'] = hash('sha1', $data['password']);
            //Query to insert values into DB table users
            $query = "insert into users (email,name,password,date,role,url_address) values(:email,:name,:password,:date,:role,:url_address)"; 
            //Call method insert
            $result = $db->write($query, $data);


            //Check the result
            //If ok, send the user to new location and disconet the db connection
            if ($result) {
                header("location: ". ROOT. "login");
                die;
            }
            // If not give the error

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


    function Login($POST)
    {

        $data = array();
        $db = Database::getInstance();

        //atribuir dentro do array data um valor para o email e para a password que serão responsáveis pelo login
        $data['email'] = trim($POST['email']);
        $data['password'] = trim($POST['password']);

        //verificar se o email é válido
        if (empty($data['email']) || !preg_match("/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/", $data['email'])) 
            { 
                $this->error .= "Please enter a valid email <br>";
            }

        //verificar se a passowrd tem pelo menos 4 caracteres
        if (strlen($data['password']) < 4) 
            {
                $this->error .= "Password must be at least 4 characters <br>";
            }

        if($this->error == "")
        {

            $data['password'] = hash('sha1', $data['password']);

            $sql = "select * from users where email = :email && password = :password limit 1";
            $arr['email'] = $data['email'];
            $result = $db->read($sql,$data);

            if(is_array($result))
            {
                $_SESSION ['user_url'] = $result[0]->url_address;
                header("Location: " . ROOT . "index");
                die;
            }
            $this->error .= "Wrong email or password! <br>";

        }

        $_SESSION['error']=$this->error;
        
    }

    public function logout()
    {
        if(isset($_SESSION['user_url']))
        {
            unset($_SESSION['user_url']);
        }

        header("Location: " . ROOT . "login");
                die;
    }
    

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