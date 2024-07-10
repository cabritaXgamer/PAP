<?php


class Home extends Controller
{
    // Public default method index, even if the user does or does not specify a URL, the Index will always run
    public function index()
    {
        //Validate if is login
        $User = $this->load_model('User');
        $user_data = $User->check_login();

        //validate if the user is really log in
        if (is_object($user_data)) {
            $data['user_data'] = $user_data;
        }

        //Page title
        $data['page_title'] = "Home - Dashboard";
        // Path where the view that will load is located
        $this->view("index", $data);
    }
}
