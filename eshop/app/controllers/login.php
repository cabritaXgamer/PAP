<?php
//extenção da class controller para a home
class Login extends Controller
{   

   public function index()
{
   $data['page_title'] = "Login";
   //mostra a pagina home
    $this->view("login",$data);
}
}