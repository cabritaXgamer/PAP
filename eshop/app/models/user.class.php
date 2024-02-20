<?php
class User
{
    private $error = "";
    function signup($POST)
    {
        $data['name']       = trim($POST['name']);

        //$data['username']   = trim($POST['username']);

        $data['email']      = trim($POST['email']);
        $data['password']   = trim($POST['password']);
        $password2          = trim($POST['password2']);

        if (empty($data['email']) || !preg_match("/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/", $data['email'])) {
            $this->error .= "Please enter a valid email <br>";
        }
        if (empty($data['email']) || !preg_match("/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/", $data['email'])) {
            $this->error .= "Please enter a valid email <br>";
        }
    }

    function login($POST)
    {
    }

    function get_user($url)
    {
    }
}
