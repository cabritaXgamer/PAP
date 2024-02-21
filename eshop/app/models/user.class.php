<?php

class User
{

    private $error = "";

    function signUp($POST)
    {
        //array para guardar os dados dos utilizadores
        $data = array();

        $data['name']       = trim($POST['name']);
        $data['email']      = trim($POST['email']);
        $data['password']   = trim($POST['password']);
        $password2          = trim($POST['password2']);

        var_dump("___________________ESTOU AQUI");


        //validação de email
        if (empty($data['email']) || !preg_match("/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/", $data['email'])) {
            $this->error .= "Please enter a valid email <br>";
        }

        //validação do nome 
        if (empty($data['name']) || !preg_match("/^[a-zA-Z]+$/", $data['name'])) {
            $this->error .= "Please enter a valid name <br>";
        }

        //verificar se a password é igual a password2
        if (strlen($data['password']) < 4) {
            $this->error .= "Password must be at last 4 characters long! <br>";
        }

        if ($this->error == "") {
            // Para testar com a minha base de dados
            //$data['role'] = "costumer";
            $data['rank'] = "custumer";
            $data['url_address'] = $this->get_random_string_max(60);
            $data['date'] = date("Y-m-d H:i:s");

            //Hash a palavra passe
            $data['password'] = hash('sha1', $data['password']);

            $query = "insert into users (url_address,name,email,password,date,rank) values(:url_address,:name,:email,:password,:date,:rank)";

            //$query = "insert into users (url_address,name,email,password,date,role) values(:url_address,:name,:email,:password,:date,:role)";

            $db = Database::getInstance();
            $result = $db->write($query, $data);



            if ($result) {
                header("location: " . ROOT . "login");
                die;
            }
        }
    }

    function login($POST)
    {
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
}
