<?php

class Signup extends Controller
{   

   public function index()
{
   $data['page_title'] = "Signup";
   //mostra a pagina home
    $this->view("signup",$data);
}

}