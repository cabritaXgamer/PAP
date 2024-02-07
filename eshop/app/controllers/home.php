<?php
//extenção da class controller para a home
class Home extends Controller
{   

   public function index()
{
   $data['page_title'] = "Home";
   //mostra a pagina home
    $this->view( "index",$data);
}
}