<?php


Class Product
{
    //function get products to show on main page
    public function get_product()
    {
        // Use the singleton instance of the Database
        $DB = Database::getInstance();

        $query = "SELECT * FROM products";
        $result = $DB->read($query);

        // Convert the result to an associative array
        return json_decode(json_encode($result), true);
    }

    //function get categories
    public function get_categories()
    {
        // Use the singleton instance of the Database
        $DB = Database::getInstance();

        $query = "SELECT * FROM categories WHERE disabled = 0";
        $result = $DB->read($query);

        // Convert the result to an associative array
        return json_decode(json_encode($result), true);
    }

    //function çget categories name
    public function get_categories_name($id)
    {
        // Use the singleton instance of the Database
        $DB = Database::getInstance();

        $query = "SELECT * FROM categories WHERE id = '$id' limit 1 ";
        $result = $DB->read($query);
        // Convert the result to an associative array
        return $result;
    }

    //function create product
    public function create_product($data, $files)
    {
        // Use the singleton instance of the Database
        $DB = Database::getInstance();

        // Validate the data before inserting
        if (!empty($data->product_name) && !empty($data->product_quantity) && !empty($data->category_name) && !empty($data->price_name)) {
            
            $description    = ucwords($data->product_name);
            $quantity       = $data->product_quantity;
            $categoryId     = $data->category_name;  // Assuming category_id is passed correctly
            $price          = $data->price_name; 
            $date           = date("Y-m-d H:i:s");
            $user_url       = $_SESSION['user_url'];
            // Initialize the variable for the image path
            $image          = ''; 

            // Validate the product name
            if (!preg_match("/^[a-zA-Z\s]+$/", $description)){
                $_SESSION['error'] = "Insira um nome de produto válido.";
                return false;
            }

             // Validate that the quantity is a non-negative number
            if (!is_numeric($quantity) || $quantity < 0) {
                $_SESSION['error'] = "A quantidade do produto deve ser um número não negativo.";
                return false;
            }

            // Validate that the price is a number
            if (!is_numeric($price) || $price < 0) {
                $_SESSION['error'] = "O preço do produto deve ser um número não negativo.";
                return false;
            }

            // Check if an image file was uploaded
            if (isset($files['product_image']) && $files['product_image']['error'] === UPLOAD_ERR_OK) {
                
                // Settings for image upload
                $uploadDir = "uploads/";
                $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
                $maxSize = 10 * 1024 * 1024; // 10 MB

                if(!file_exists($uploadDir))
                {
                    mkdir($uploadDir, 0777, true);
                }

                // Check if the file type is allowed and the size is within the limit
                if (in_array($files['product_image']['type'], $allowedTypes) && $files['product_image']['size'] <= $maxSize) {
                    // Generate a unique name for the image file
                    $fileName = uniqid('img_') . '_' . $files['product_image']['name'];
                    $filePath = $uploadDir . $fileName;

                     // Move the image file to the uploads directory
                    if (move_uploaded_file($files['product_image']['tmp_name'], $filePath)) {
                        $image = $filePath; // Set the image path to be inserted into the database
                    } else {
                        $_SESSION['error'] = "Erro ao mover o arquivo de imagem para o diretório de uploads.";
                        return false;
                    }
                }else {
                    $_SESSION['error'] = "Tipo de arquivo de imagem não permitido ou tamanho excede o limite de 10MB.";
                    return false;
                }
            } else {
                $_SESSION['error'] = "Falha no envio do arquivo de imagem.";
                return false;
            }

            // Build and execute the SQL query for insertion
            $query = "INSERT INTO products (description, quantity, categoryId, price, date, user_url, image) VALUES (:description, :quantity, :categoryId, :price, :date, :user_url, :image)";
            $params = array(
                ':description'  => $description,
                ':quantity'     => $quantity,
                ':categoryId'   => $categoryId,
                ':price'        => $price,
                ':date'         => $date,
                ':user_url'     => $user_url,
                ':image'        => $image // Insert the image path into the database
            );

            // Add exception handling to check for database errors
            try {
                $check = $DB->write($query, $params);

                if ($check) {
                    return true;
                } else {
                    $_SESSION['error'] = "Erro ao inserir produto na base de dados.";
                    return false;
                }
            } catch (Exception $e) {
                $_SESSION['error'] = "Erro ao inserir produto: " . $e->getMessage();
                return false;
            }
        } else {
            $_SESSION['error'] = "O nome do produto, quantidade, categoria e preço são obrigatórios.";
            return false;
        }
    }

    //function edit product
    public function edit_product($id, $description, $quantity, $categoryId, $price, $files) {
        $DB = Database::getInstance();
    
        // Validate inputs
        $description = ucwords(trim($description));
        $quantity = (int)$quantity;
        $categoryId = (int)$categoryId;
        $price = (float)$price;
    
        // Ensure valid inputs
        if (empty($description) || !is_numeric($quantity) || $quantity < 0 || !is_numeric($categoryId) || !is_numeric($price) || $price < 0) {
            $_SESSION['error'] = "Por favor, insira valores corretos!";
            return false;
        }
    
        // Initialize image variable
        $image = null;
    
        // Check if an image file was uploaded
        if (isset($files['product_image']) && $files['product_image']['error'] === UPLOAD_ERR_OK) {
            // Settings for image upload
            $uploadDir = "uploads/";
            $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
            $maxSize = 10 * 1024 * 1024; // 10 MB
    
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
    
            // Check if the file type is allowed and the size is within the limit
            if (in_array($files['product_image']['type'], $allowedTypes) && $files['product_image']['size'] <= $maxSize) {
                // Gera um nome único para o arquivo de imagem
                $fileName = uniqid('img_') . '_' . $files['product_image']['name'];
                $filePath = $uploadDir . $fileName;
    
                 // Move the image file to the uploads directory
                if (move_uploaded_file($files['product_image']['tmp_name'], $filePath)) {
                    $image = $filePath;// Set the image path to be inserted into the database
    
                    // Remove the old image, if it exists
                    $oldImageQuery = "SELECT image FROM products WHERE id = :id";
                    $oldImageParams = array(':id' => $id);
                    $oldImageResult = $DB->read($oldImageQuery, $oldImageParams);
    
                    if ($oldImageResult) {
                        $oldImage = $oldImageResult[0]->image;
                        if ($oldImage && file_exists($oldImage)) {
                            unlink($oldImage);
                        }
                    }
                } else {
                    $_SESSION['error'] = "Erro ao mover o arquivo de imagem para o diretório de uploads.";
                    return false;
                }
            } else {
                $_SESSION['error'] = "Tipo de arquivo de imagem não permitido ou tamanho excede o limite de 10MB.";
                return false;
            }
        }
    
        // Update the product in the database
        $query = "UPDATE products SET description = :description, quantity = :quantity, categoryId = :categoryId, price = :price" . ($image ? ", image = :image" : "") . " WHERE id = :id LIMIT 1";
        $params = array(
            ':description' => $description,
            ':quantity' => $quantity,
            ':categoryId' => $categoryId,
            ':price' => $price,
            ':id' => $id
        );
    
        if ($image) {
            $params[':image'] = $image;
        }
    
        try {
            $check = $DB->write($query, $params);
    
            if ($check) {
                return true;
            } else {
                $_SESSION['error'] = "Erro ao atualizar produto na base de dados.";
                return false;
            }
        } catch (Exception $e) {
            $_SESSION['error'] = "Erro ao atualizar produto: " . $e->getMessage();
            return false;
        }
    }
    
    //function delete product
    public function delete_product($id)
    {
        $DB = Database::getInstance();
        $id = (int)$id;

        $query = "DELETE FROM products WHERE id = '$id' LIMIT 1";
        return $DB->write($query);
    }
}



