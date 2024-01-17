<?php


class Home extends Controller
{
    //Public default metodo index, mesmo que o utilizador coloque ou não qualquer URL, o Index vai sempre correr
    public function index()
     {
        //Direção de onde esta a view que vai carregar
        $this->view("home");

     }
}