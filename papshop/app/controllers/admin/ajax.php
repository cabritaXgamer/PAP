<?php


class Ajax extends Controller
{
    //Public default metodo index, mesmo que o utilizador coloque ou não qualquer URL, o Index vai sempre correr
    
    public function index()
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
            
            // Handle deleting a category
            elseif ($data->data_type == 'delete_row') {
                
                $check = $category->delete($data->id);
                if ($check) {
                    $arr['message'] = "A sua categoria foi removida com sucesso!";
                    $arr['message_type'] = "info";
                } else {
                    $arr['message'] = "Erro ao remover a categoria!";
                    $arr['message_type'] = "error";
                }
                $_SESSION['error'] = "";
                $arr['data'] = "";
                $arr['data_type'] = "delete_row";
                
                echo json_encode($arr);
            }

             // Handle change state of a category
            elseif ($data->data_type == 'disabled_row') {
                $id = $data->id;
                $disabled = $data->current_state ? 0 : 1;
    
                $query = "UPDATE categories SET disabled = :disabled WHERE id = :id LIMIT 1";
                $params = array(':disabled' => $disabled, ':id' => $id);
                $DB = Database::getInstance();
                $DB->write($query, $params);
    
                $arr['message'] = "";
                $_SESSION['error'] = "";
                $arr['message_type'] = "info";
                $arr['data'] = "";
                $arr['data_type'] = "disabled_row";
    
                echo json_encode($arr);
            }
    
    }    } 
}  
