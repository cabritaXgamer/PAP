<?php

Class User 
{

    private $error = "";

    function SignUp($POST)
    {

        $data = array();

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

        if($this->error == "")
        {
            //save at database
            $data['role'] = "costumer";
            $data['url_address'] = $this->get_random_string_max(60);
            $data['date'] = date("Y-m-d H:i:s");

            $query = "insert into users (url_address,name,email,password,date,role) values(:url_address,:name,:email,:password,:date,:role)";
            $db = Database::getInstance();
            $result = $db->write($query,$data);

            if($result)
            {
                header("Location: " . ROOT . "login");
                die;
            }
        }
    }

    function Login($POST)
    {
        
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

}