<?php


class Home extends Controller
{
    public function index()
    {
        $User = $this->load_model('User');
        $user_data = $User->check_login();
        if (is_object($user_data)) {
            $data['user_data'] = $user_data;
        }
        $data['page_title'] = "Home - Dashboard";
        $this->view("index", $data);
    }
}
