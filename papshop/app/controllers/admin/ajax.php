<?php


class Ajax extends Controller
{
    //Public default metodo index, mesmo que o utilizador coloque ou não qualquer URL, o Index vai sempre correr
    
    public function index()
    {
       
        // Obtenha os dados enviados pelo cliente
        $data = file_get_contents("php://input");
        print_r(json_decode($data));

        //print_r($_POST);

        // if (is_object($data) && isset($data->data_type) && $data->data_type == 'add_category') {
        //     // Carrega o modelo de categoria
        //     $category = $this->load_model('Category');
        //     $check = $category->create($data);

        //     if (!empty($_SESSION['error'])) {
        //         $arr['message'] = $_SESSION['error'];
        //         $_SESSION['error'] = "";
        //         $arr['message_type'] = "error";
        //     } else {
        //         $arr['message'] = "Categoria adicionada com sucesso!";
        //         $arr['message_type'] = "info";
        //     }

        //     $arr['data'] = "";
        //     echo json_encode($arr);
        }     
}  
