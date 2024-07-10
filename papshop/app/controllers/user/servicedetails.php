<?php


class ServiceDetails extends Controller
{
    //Public default metodo index, mesmo que o utilizador coloque ou não qualquer URL, o Index vai sempre correr

    public function index()
    {

        //Validate if is login
        $user_data = $User->check_login();

        //validate if the user is really log in
        if (is_object($user_data)) {
            $data['user_data'] = $user_data;
        }

        //Page title
        $data['page_title'] = "Serviços";
        // Path where the view that will load is located
        $this->view("service-details", $data);
    }
}
