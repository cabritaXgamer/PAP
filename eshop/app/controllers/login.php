<?php

//extenção da class controller para a home
class Login extends Controller
{

   public function index()
   {
      $data['page_title'] = "Login";
      //mostra a pagina home
      if ($_SERVER['REQUEST_METHOD'] == "POST") {
         $user = $this->load_model("User");
         $user->slogin($_POST);
      }

      $this->view("login", $data);
   }
}
