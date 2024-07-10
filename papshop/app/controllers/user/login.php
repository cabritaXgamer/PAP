<?php


class Login extends Controller
{

    // Public default method index, even if the user does or does not specify a URL, the Index will always run
   public function index()
   {
      
      //Page title
      $data['page_title'] = "Login";

      if ($_SERVER['REQUEST_METHOD'] == "POST") {

         $user = $this->load_model("User");
         $user->login($_POST);
      }
      
      // Path where the view that will load is located
      $this->view("login", $data);
   }
}
