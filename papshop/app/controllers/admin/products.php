<?php


class Products extends Controller
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
        $categoryModel = $this->load_model('Product');
        $data['products'] = $categoryModel->get_product();
        $data['categories'] = $categoryModel->get_categories();

       //show($data['categories']);
       //$this->title = 'Admin - Dashboard';
       $data['page_title'] = "Admin - Products";
       //Rota onde esta a view que vai carregar
       $this->view("../admin/products", $data);
    } 



    // Function to handle category-related actions
    public function product()
    {
        // Load the Product model
        $product = $this->load_model('Product');
        
        // Get the data sent from the client
        $data = file_get_contents("php://input");
        $data = json_decode($data);

        show($_POST);
        show($_FILES);
        die;

        // Verify that data is an object and has the required property
        if (is_object($data) && isset($data->data_type)) {
            
          
            // Handle adding a new category
            if ($data->data_type == 'add_product') {
                $check = $product->create_product($data);

                $arr = array();
                if (!empty($_SESSION['error'])) {
                    $arr['message'] = $_SESSION['error'];
                    $_SESSION['error'] = "";
                    $arr['message_type'] = "error";
                    $arr['data_type'] = "add_product";
                } else {
                    $arr['message'] = "Produto adiciionado com sucesso!";
                    $arr['message_type'] = "info";
                    $arr['data_type'] = "add_product";
                }

                $arr['data'] = "";
                echo json_encode($arr);
            }
            // Handle editing a category
            elseif ($data->data_type == 'edit_product') {
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
                
                $check = $product->delete_product($data->id);
                if ($check) {
                    $arr['message'] = "O seu produto foi removido com sucesso!";
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

        } else {
            // Handle invalid data
            $arr['message'] = "Dados inválidos recebidos!";
            $arr['message_type'] = "error";
            $arr['data'] = "";
            echo json_encode($arr);
        }
    }
    
}


  