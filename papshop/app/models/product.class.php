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

    public function create_product($data)
    {
        $DB = Database::getInstance();

        // Validação dos dados antes de inserir
        if (!empty($data->product_name) && !empty($data->product_quantity)) {
            $description = trim($data->product_name);
            $quantity = (int)$data->product_quantity;
            $categoryId = trim($data->category_name);
            $price = (float)$data->price_name;

            // Verifique se a descrição é válida
            if ($description === "") {
                $_SESSION['error'] = "A descrição do produto é obrigatória.";
                return false;
            }

            // Verifique se a quantidade é um número não negativo
            if ($quantity < 0) {
                $_SESSION['error'] = "A quantidade do produto deve ser um número não negativo.";
                return false;
            }

            // Construa e execute a consulta SQL para inserção
            $query = "INSERT INTO products (description, quantity, categoryId, price) VALUES (:description, :quantity, :categoryId, :price)";
            $params = array(
                ':description' => $description,
                ':quantity' => $quantity,
                ':categoryId' => $categoryId,
                ':price' => $price
            );
            $check = $DB->write($query, $params);

            if ($check) {
                return true;
            } else {
                $_SESSION['error'] = "Erro ao inserir produto na base de dados.";
            }
        } else {
            $_SESSION['error'] = "A descrição e a quantidade do produto são obrigatórias.";
        }
        return false;
    }

    

    //Function model edit category
    public function edit_product($id, $new_category) {
        $DB = Database::getInstance();
    
        // Validate the new category name
        $new_category = ucwords(trim($new_category));
        if (!preg_match("/^[a-zA-Z]+$/", $new_category)) {
            $_SESSION['error'] = "Por favor insira um nome de categoria correto!";
            return false;
        }
    
        // Update the category in the database
        $query = "UPDATE categories SET category = :category WHERE id = :id LIMIT 1";
        $params = array(':category' => $new_category, ':id' => $id);
        return $DB->write($query, $params);
    }
    
    public function delete_product($id)
    {
        $DB = Database::getInstance();
        $id = (int)$id;

        $query = "DELETE FROM products WHERE id = '$id' LIMIT 1";
        return $DB->write($query);
    }
}



