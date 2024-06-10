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

    public function create_product($data)
    {
        $DB = Database::getInstance();
    
        // Verifique se os dados são válidos antes de inserir
        if (isset($data->data) && isset($data->data_type) && $data->data_type == 'add_product') {
            // Prepare os dados para inserção
            $product = ucwords(trim($data->data));
    
            // Verifique se o nome da categoria é válido (permitindo letras e espaços)
            if (!preg_match("/^[a-zA-Z\s]+$/", $product)) {
                $_SESSION['error'] = "Por favor insira um nome de produto correto!";
                return false;
            }
    
            // Construa a consulta SQL para inserção
            $query = "INSERT INTO products (description) VALUES (:description)";
            $params = array(':description' => $product);
    
            // Execute a consulta SQL
            $check = $DB->write($query, $params);
            if ($check) {
                return true;
            } else {
                // Se houver um erro ao inserir, defina uma mensagem de erro na sessão
                $_SESSION['error'] = "Erro ao inserir o produto na base de dados.";
            }
        } else {
            $_SESSION['error'] = "Dados inválidos para adicionar produto.";
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



