<?php


class Ajax extends Controller
{
    //Public default metodo index, mesmo que o utilizador coloque ou não qualquer URL, o Index vai sempre correr
    
    public function index()
    {
       
        // $data = file_get_contents("php://input");       
        // print_r(json_decode($data));

        
        print_r($_POST);      

    } 
    
}