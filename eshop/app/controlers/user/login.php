<?php


class Login extends Controller
{
    //Public default metodo index, mesmo que o utilizador coloque ou não qualquer URL, o Index vai sempre correr
    public function index()
     {
        $this->title = 'Admin - Login';
        //Direção de onde esta a view que vai carregar

        if($_SERVER['REQUEST_METHOD'] == "POST")
         {
               //show($_POST);

               $User = $this->load_model("User");
               $User->login($_POST);
         }

        $this->view("login");

     }
}