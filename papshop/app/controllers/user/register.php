<?php

class Register extends Controller
{

   public function index()
   {
      
      //Load model User, to access database
      if ($_SERVER['REQUEST_METHOD'] == "POST") {
         $User = $this->load_model("User");
         $User->signup($_POST);
      }
      
      //Page title
      $data['page_title'] = "Signup";
      // Path where the view that will load is located
      $this->view("register", $data);
   }
}
