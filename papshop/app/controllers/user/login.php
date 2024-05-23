<?php

//extenção da class controller para a home
class Login extends Controller
{

   public function index()
   {
      $data['page_title'] = "Login";
      //mostra a pagina home
      if ($_SERVER['REQUEST_METHOD'] == "POST") {

         // show($_POST);

         $user = $this->load_model("User");
         $user->login($_POST);
      }
      //mostra a pagina do login
      $this->view("login", $data);
   }
}
