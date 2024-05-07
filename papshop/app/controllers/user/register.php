<?php

class Register extends Controller
{

   public function index()
   {
      $data['page_title'] = "Signup";

      //mostra a pagina home
      if ($_SERVER['REQUEST_METHOD'] == "POST") {
         show($_POST);

         $User = $this->load_model("User");
         $User->signup($_POST);
      }

      $this->view("register", $data);
   }
}
