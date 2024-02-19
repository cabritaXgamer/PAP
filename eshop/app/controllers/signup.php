<?php

class Signup extends Controller
{   

   public function index()
{
   $data['page_title'] = "Signup";
   //mostra a pagina home
   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      show($_POST);
      $user = $this->Load_model("User");
     // $user->signup($_POST);
   }
    $this->view("signup",$data);
}

}