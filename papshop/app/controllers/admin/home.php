<?php


class Home extends Controller
{
    // Public default method index, even if the user does or does not specify a URL, the Index will always run

    public function index()
    {

        //Load model User, to access database
        $User = $this->load_model('User');

        //Validate if is login and if is an admin
        $data['user_data'] = $User->check_login(true, ["admin"]);

        //validate if the user is really log in
        if (is_array($data['user_data'])) {
            $data['user_data'] = $user_data;
        }

        //Page title
        $data['page_title'] = "Admin Home - Dashboard";
        // Path where the view that will load is located
        $this->view("../admin/index", $data);
    }

    public function categories()
    {

        //Load model User, to access database
        $User = $this->load_model('User');

        //Validate if is login and if is an admin
        $data['user_data'] = $User->check_login(true, ["admin"]);

        //validate if the user is really log in
        if (is_array($data['user_data'])) {
            $data['user_data'] = $user_data;
            //show($data['user_data']);
        }

        //Page title
        $data['page_title'] = "Admin Home - Dashboard";
        // Path where the view that will load is located
        $this->view("admin/categories", $data);
    }
}
