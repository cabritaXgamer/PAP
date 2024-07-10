<?php

class Products extends Controller
{
     // Public default method index, even if the user does or does not specify a URL, the Index will always run
    
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
     }

        // Get category list
        $categoryModel = $this->load_model('Product');
        $data['products'] = $categoryModel->get_product();
        $data['categories'] = $categoryModel->get_categories();
        
        // Maps category IDs to corresponding names
        $categoryNames = [];
        foreach ($data['categories'] as $category) {
            $categoryNames[$category['id']] = $category['category'];
        }

        // Adds the category name to each product's data
        foreach ($data['products'] as &$product) {
            if (isset($categoryNames[$product['categoryId']])) {
                $product['categoryName'] = $categoryNames[$product['categoryId']];
            } else {
                $product['categoryName'] = 'Categoria Desconhecida'; // Trate casos em que a categoria não existe
            }
        }
        unset($product); // clean last name referenc


       //Page title
       //$this->title = 'Admin - Dashboard';
       $data['page_title'] = "Admin - Products";
       // Path where the view that will load is located
       $this->view("../admin/products", $data);
    } 



    // Function to handle category-related actions
    public function product()
    {
        // Load the Product model
        $product = $this->load_model('Product');
        
        $data = (object)$_POST;

        // Verify that data is an object and has the required property
        if (is_object($data) && isset($data->data_type)) {
            
          
            // Handle adding a new category
            if ($data->data_type == 'add_product') {
                $check = $product->create_product($data, $_FILES);

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

            // Handle editing a product
            elseif ($data->data_type == 'edit_product') {
                // Checks if all required properties are defined
                if (isset($data->id, $data->description, $data->quantity, $data->category, $data->price)) {
                    $id = $data->id;
                    $description = $data->description;
                    $quantity = $data->quantity;
                    $categoryId = $data->category; // Ajuste o nome do campo se necessário
                    $price = $data->price;
                    $files = $_FILES;

                    // Calls the edit method on the model
                    $check = $product->edit_product($id, $description, $quantity, $categoryId, $price, $files);

                    $arr = array();
                    if ($check) {
                        $arr['message'] = "Produto editado com sucesso!";
                        $arr['message_type'] = "info";
                    } else {
                        $arr['message'] = !empty($_SESSION['error']) ? $_SESSION['error'] : "Erro ao editar o produto!";
                        $_SESSION['error'] = ""; 
                        $arr['message_type'] = "error";
                    }
                } else {
                    $arr['message'] = "Dados incompletos para editar o produto!";
                    $arr['message_type'] = "error";
                }

                $arr['data'] = "";
                $arr['data_type'] = "edit_product";

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


  