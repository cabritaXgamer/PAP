<?php


class Test extends Controller
{
    //Public default metodo index, mesmo que o utilizador coloque ou não qualquer URL, o Index vai sempre correr
    public function index()
     {
        
        $User = $this->load_model('User');
        $data['user_data'] = $User->check_login();

        //validate if the user is really log in
        if(is_array($data['user_data']))
        {
            $data['user_data'] = $user_data;
            //show($data['user_data']);
        }

        //$this->title = 'Admin - Dashboard';
        $data['page_title'] = "Test";
        //Rota onde esta a view que vai carregar
        //$this->view("test", $data);

        /** Balance load page to force user view */
        require ABSPATH . '/views/user/_includes/admin_header.php';

        require ABSPATH . '/views/user/test.php';

        require ABSPATH . '/views/user/_includes/admin_footer.php';

     }
}