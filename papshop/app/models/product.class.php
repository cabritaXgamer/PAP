<?php


Class Product
{
    public function get_product()
    {
        // Utilize a instância única do Database
        $DB = Database::getInstance();

        $query = "SELECT * FROM products";
        $result = $DB->read($query);

        // Converta o resultado para um array associativo
        return json_decode(json_encode($result), true);
    }

    public function get_categories()
    {
        // Utilize a instância única do Database
        $DB = Database::getInstance();

        $query = "SELECT * FROM categories WHERE disabled = 0";
        $result = $DB->read($query);

        // Converta o resultado para um array associativo
        return json_decode(json_encode($result), true);
    }

    public function get_categories_name($id)
    {
        // Utilize a instância única do Database
        $DB = Database::getInstance();

        $query = "SELECT * FROM categories WHERE id = '$id' limit 1 ";
        $result = $DB->read($query);
        //show($result);
        // Converta o resultado para um array associativo
        return $result;
    }

    public function create_product($data, $files)
    {
        $DB = Database::getInstance();

        // Validação dos dados antes de inserir
        if (!empty($data->product_name) && !empty($data->product_quantity) && !empty($data->category_name) && !empty($data->price_name)) {
            
            $description    = ucwords($data->product_name);
            $quantity       = $data->product_quantity;
            $categoryId     = $data->category_name;  // Assuming category_id is passed correctly
            $price          = $data->price_name; 
            $date           = date("Y-m-d H:i:s");
            $user_url       = $_SESSION['user_url'];
            // Inicializa a variável para o caminho da imagem
            $image          = ''; 

            // Verifique se o nome do produto é válido
            if (!preg_match("/^[a-zA-Z\s]+$/", $description)){
                $_SESSION['error'] = "Insira um nome de produto válido.";
                return false;
            }

            // Verifique se a quantidade é um número não negativo
            if (!is_numeric($quantity) || $quantity < 0) {
                $_SESSION['error'] = "A quantidade do produto deve ser um número não negativo.";
                return false;
            }

            // Verifique se o preço é um número
            if (!is_numeric($price) || $price < 0) {
                $_SESSION['error'] = "O preço do produto deve ser um número não negativo.";
                return false;
            }

            // Verifica se foi enviado um arquivo de imagem
            if (isset($files['product_image']) && $files['product_image']['error'] === UPLOAD_ERR_OK) {
                
                // Configurações para o upload da imagem
                $uploadDir = "uploads/";
                $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
                $maxSize = 10 * 1024 * 1024; // 10 MB

                if(!file_exists($uploadDir))
                {
                    mkdir($uploadDir, 0777, true);
                }

                // Verifica se o tipo de arquivo é permitido e se o tamanho está dentro do limite
                if (in_array($files['product_image']['type'], $allowedTypes) && $files['product_image']['size'] <= $maxSize) {
                    // Gera um nome único para o arquivo de imagem
                    $fileName = uniqid('img_') . '_' . $files['product_image']['name'];
                    $filePath = $uploadDir . $fileName;

                    // Move o arquivo de imagem para o diretório de uploads
                    if (move_uploaded_file($files['product_image']['tmp_name'], $filePath)) {
                        $image = $filePath; // Define o caminho da imagem para ser inserido no banco de dados
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

            // Construa e execute a consulta SQL para inserção
            $query = "INSERT INTO products (description, quantity, categoryId, price, date, user_url, image) VALUES (:description, :quantity, :categoryId, :price, :date, :user_url, :image)";
            $params = array(
                ':description'  => $description,
                ':quantity'     => $quantity,
                ':categoryId'   => $categoryId,
                ':price'        => $price,
                ':date'         => $date,
                ':user_url'     => $user_url,
                ':image'        => $image // Insere o caminho da imagem no banco de dados
            );

            // Adiciona captura de exceção para verificar erros do banco de dados
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
    
        // Verifica se foi enviado um arquivo de imagem
        if (isset($files['product_image']) && $files['product_image']['error'] === UPLOAD_ERR_OK) {
            // Configurações para o upload da imagem
            $uploadDir = "uploads/";
            $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
            $maxSize = 10 * 1024 * 1024; // 10 MB
    
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
    
            // Verifica se o tipo de arquivo é permitido e se o tamanho está dentro do limite
            if (in_array($files['product_image']['type'], $allowedTypes) && $files['product_image']['size'] <= $maxSize) {
                // Gera um nome único para o arquivo de imagem
                $fileName = uniqid('img_') . '_' . $files['product_image']['name'];
                $filePath = $uploadDir . $fileName;
    
                // Move o arquivo de imagem para o diretório de uploads
                if (move_uploaded_file($files['product_image']['tmp_name'], $filePath)) {
                    $image = $filePath; // Define o caminho da imagem para ser inserido no banco de dados
    
                    // Remove a imagem antiga, se existir
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
    
    public function delete_product($id)
    {
        $DB = Database::getInstance();
        $id = (int)$id;

        $query = "DELETE FROM products WHERE id = '$id' LIMIT 1";
        return $DB->write($query);
    }
}



