<?php

class User
{

    private $error = "";
    //função que vai fazer o registro do utilizador na base de dados
    function SignUp($POST)
    {
        //array para guardar os dados dos utilizadores
        $data = array();
        $db = Database::getInstance();


        $data['name']       = trim($POST['name']);
        $data['email']      = trim($POST['email']);
        $data['password']   = trim($POST['password']);
        $password2          = trim($POST['password2']);

        //var_dump("___________________ESTOU AQUI");


        //validação de email
        if (empty($data['email']) || !preg_match("/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/", $data['email'])) {
            $this->error .= "Please enter a valid email <br>";
        }

        //validação do nome 
        if (empty($data['name']) || !preg_match("/^[a-zA-Z]+$/", $data['name'])) {
            $this->error .= "Please enter a valid name <br>";
        }


        if ($data['password'] !== $password2) {
            $this->error .= "password do not match <br>";
        }

        //verificar se a password é igual a password2
        if (strlen($data['password']) < 4) {
            $this->error .= "Password must be at last 4 characters long! <br>";
        }


        //ver se o email ja existe na base de dados
        //$sql = "select * from users where email = : email limite 1";
        $sql = "select * from users where email = :email limit 1";
        $arr['email'] = $data['email'];
        $check = $db->read($sql, $arr);
        if (is_array($check)) {

            $this->error .= "That email already exits! <br>";
        }

        $data['url_address'] = $this->get_random_string_max(60);

        //verificar as URL 
        $arr = false;
        //$sql = "select * from users where url_address = : url_address limite 1";
        $sql = "select * from users where url_address = :url_address limit 1";

        $arr['url_address'] = $data['url_address'];
        $check = $db->read($sql, $arr);
        if (is_array($check)) {
            $data['url_address'] = $this->get_random_string_max(60);
        }

        if ($this->error == "") {
            // Para testar com a minha base de dados
            //$data['role'] = "costumer";
            $data['rank'] = "custumer";
            $data['date'] = date("Y-m-d H:i:s");
            //Hash a palavra passe
            $data['password'] = hash('sha1', $data['password']);
            $query = "insert into users (url_address,name,email,password,date,rank) values(:url_address,:name,:email,:password,:date,:rank)";
            //$query = "insert into users (url_address,name,email,password,date,role) values(:url_address,:name,:email,:password,:date,:role)";

            $result = $db->write($query, $data);





            if ($result) {
                header("location: " . ROOT . "login");
                die;
            }
        }

        $_SESSION['error'] = $this->error;
    }
    //verifica e valida se o utilizador existe e entra no index 
    function Login($POST)
    {
        $data = array();
        $db = Database::getInstance();

        $data['email']      = trim($POST['email']);
        $data['password']   = trim($POST['password']);

        //validation for you write an email corretly
        if (empty($data['email']) || !preg_match("/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/", $data['email'])) {
            $this->error .= "Please enter a valid email <br>";
        }

        //validation for minimal password lenght
        if (strlen($data['password']) < 4) {
            $this->error .= "Password must be at last 4 characters long! <br>";
        }

        if ($this->error == "") {
            //confirm
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

    function get_user($url)
    {
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
    // Função para verificar se um utilizador está autenticado ao recuperar os seus detalhes com base no URL armazenado na sessão.

    function check_login()
    {
        if (isset($_SESSION['user_url'])) {
            $arr['url'] = $_SESSION['user_url'];
            $query = "select * from users where url_address = :url limit 1";
            $db = Database::getInstance();

            $result = $db->read($query, $arr);
            if (is_array($result)) {
                return $result[0];
            }
        }
        return false;
    }
    public function logout()
    {
        if (isset($_SESSION['user_url'])) {
            unset($_SESSION['user_url']);
        }
        header("location: " . ROOT . "home");
        die;
    }
}