<?php


class Categories extends Controller
{
    //Public default metodo index, mesmo que o utilizador coloque ou não qualquer URL, o Index vai sempre correr
    
    public function index()
    {
       
     //Load model User, to access database
     $User = $this->load_model('User');
     
     //Validate if is login and if is an admin
     $data['user_data'] = $User->check_login(true, ["admin"]);
     
     //validate if the user is really log in
     if(is_array($data['user_data']))
     {
         $data['user_data'] = $user_data;
         //show($data['user_data']);
     }

     

       //$this->title = 'Admin - Dashboard';
       $data['page_title'] = "Admin - Categories";
       //Rota onde esta a view que vai carregar
       $this->view("../admin/categories", $data);
    } 

    public function test()
    {
        echo "Send from AJAX controller";
    }

    
}