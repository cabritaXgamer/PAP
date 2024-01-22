<?php
//extenção da class controller para a home
class home extends controlers
{   

   public function index()
{
   
   //mostra a pagina home
    $this->view("eshop/index");
}
}

