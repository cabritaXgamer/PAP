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

        // Get category list
        $categoryModel = $this->load_model('Category');
        $data['categories'] = $categoryModel->get_categories();

       //$this->title = 'Admin - Dashboard';
       $data['page_title'] = "Admin - Categories";
       //Rota onde esta a view que vai carregar
       $this->view("../admin/categories", $data);
    } 



    // Function to handle category-related actions
    public function category()
    {
        // Load the Category model
        $category = $this->load_model('Category');
        
        // Get the data sent from the client
        $data = file_get_contents("php://input");
        $data = json_decode($data);
    
        // Verify that data is an object and has the required property
        if (is_object($data) && isset($data->data_type)) {
            // Handle adding a new category
            if ($data->data_type == 'add_category') {
                $check = $category->create($data);
    
                // Check if there were any errors
                if (!empty($_SESSION['error'])) {
                    $arr['message'] = $_SESSION['error'];
                    $_SESSION['error'] = "";
                    $arr['message_type'] = "error";
                    $arr['data_type'] = "add_new";
                } else {
                    $arr['message'] = "Categoria adicionada com sucesso!";
                    $arr['message_type'] = "info";
                    $arr['data_type'] = "add_new";
                }
    
                $arr['data'] = "";
                echo json_encode($arr);
            }

            // Handle editing a category
            elseif ($data->data_type == 'edit_category') {
                $id = $data->id;
                $new_category = $data->data;

                // Call the model's edit method
                $check = $category->edit($id, $new_category);

                if ($check) {
                    $arr['message'] = "Categoria editada com sucesso!";
                    $arr['message_type'] = "info";
                } else {
                    $arr['message'] = "Erro ao editar a categoria!";
                    $arr['message_type'] = "error";
                }
                $_SESSION['error'] = "";
                $arr['data'] = "";
                $arr['data_type'] = "edit_row";

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
    
            // Handle deleting a category
            elseif ($data->data_type == 'delete_row') {
                
                $check = $category->delete($data->id);
                // if ($check) {
                //     $arr['message'] = "A sua categoria foi removida com sucesso!";
                //     $arr['message_type'] = "info";
                // } else {
                //     $arr['message'] = "Erro ao remover a categoria!";
                //     $arr['message_type'] = "error";
                // }
                // $_SESSION['error'] = "";
                // $arr['data'] = "";
                // $arr['data_type'] = "delete_row";

                if ($check === true) {
                    $arr['message'] = "A sua categoria foi removida com sucesso!";
                    $arr['message_type'] = "info";
                } elseif ($check === "Não é possível excluir a categoria enquanto o estado estiver ativado.") {
                    $arr['message'] = $check;
                    $arr['message_type'] = "error";
                } else {
                    $arr['message'] = "Erro ao remover a categoria!";
                    $arr['message_type'] = "error";
                }
                $_SESSION['error'] = "";
                $arr['data'] = "";
                $arr['data_type'] = "delete_row";

                echo json_encode($arr);
            }

        } else {
            // Handle invalid data
            $arr['message'] = "Dados inválidos recebidos!";
            $arr['message_type'] = "error";
            $arr['data'] = "";
            echo json_encode($arr);
        }
    }
    
}


  