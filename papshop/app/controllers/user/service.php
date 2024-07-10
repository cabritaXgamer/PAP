<?php


class Service extends Controller
{
    // Public default method index, even if the user does or does not specify a URL, the Index will always run

    public function index()
    {

        
        //Validate if is login
        $user_data = $User->check_login(false);

        //validate if the user is really log in
        if (is_object($user_data)) {
            $data['user_data'] = $user_data;
        }

        //Page title
        $data['page_title'] = "service - serviços";
        // Path where the view that will load is located
        $this->view("service", $data);
    }
}
