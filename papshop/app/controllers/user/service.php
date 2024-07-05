<?php


class Service extends Controller
{
    //Public default metodo index, mesmo que o utilizador coloque ou não qualquer URL, o Index vai sempre correr

    public function index()
    {

        $User = $this->load_model('User');
        $user_data = $User->check_login(false);

        //validate if the user is really log in
        if (is_object($user_data)) {
            $data['user_data'] = $user_data;
            //show($data['user_data']);
        }

        //$this->title = 'Admin - Dashboard';
        $data['page_title'] = "service - serviços";
        //Rota onde esta a view que vai carregar
        $this->view("service", $data);
    }
}
