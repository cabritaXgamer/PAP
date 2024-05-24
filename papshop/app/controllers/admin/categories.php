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


     /*//get category list
     */
     
     $categoryList =$this->load_model('Category');
     $result = $categoryList->get_categories($data);

     show($result);
    //  if ($categoryList["statusCode"] === 401){
    //      //faz o refresh do accessToken
    //      //$this->userTokenRefresh();

    //      $groupsList = $modelo->get_categories();
    //  }
    //  if ($categoryList["statusCode"] === 200){
         
    //     show($categoryList);
    //     // $this->userdata['$categoryList'] = array_orderby($categoryList["body"]["groups"], "dateCreated", SORT_DESC);
    //  }

       //$this->title = 'Admin - Dashboard';
       $data['page_title'] = "Admin - Categories";
       //Rota onde esta a view que vai carregar
       $this->view("../admin/categories", $data);
    } 



    //Function to create a Category
    public function addCategory()
    {
        //Obtenha os dados enviados pelo cliente
        $data = file_get_contents("php://input");
        //print_r($data);  
        $data = json_decode($data);

        //show($data);

        if (is_object($data) && isset($data->data_type) && $data->data_type == 'add_category') {
            // Carrega o modelo de categoria
            $category = $this->load_model('Category');
            $check = $category->create($data);

            if (!empty($_SESSION['error'])) {
                $arr['message'] = $_SESSION['error'];
                $_SESSION['error'] = "";
                $arr['message_type'] = "error";
            } else {
                $arr['message'] = "Categoria adicionada com sucesso!";
                $arr['message_type'] = "info";
            }

            $arr['data'] = "";
            echo json_encode($arr);
        }
    }

    // public function addCategory()
    // {
    //     $data = file_get_contents("php://input");
    //     $data = json_decode($data);

    //     var_dump($data);

    //     if (is_object($data)) {
    //         // Assuming Category is the class name containing the create method
    //         $category = $this->load_model('Category');
    //         $check = $category->create($data);

    //         if ($_SESSION['error'] != "") {
    //             $arr['message'] = $_SESSION['error'];
    //             $_SESSION['error'] = ""; // Clear the error after retrieving it
    //             $arr['message_type'] = "error";
    //             $arr['data'] = "";

    //             echo json_encode($arr);
    //         } else {
    //             $arr['message'] = "Categoria adicionada com sucesso!";
    //             $arr['message_type'] = "info";
    //             $arr['data'] = "";

    //             echo json_encode($arr);
    //         }
    //     }
    // }
}


  