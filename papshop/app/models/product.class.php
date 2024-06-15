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
            
            $description    = ucwords($data->product_name);
            $quantity       = $data->product_quantity;
            $categoryId     = $data->category_name;  // Assuming category_id is passed correctly
            $price          = $data->price_name; 
            $date           = date("Y-m-d H:i:s");
            $user_url       = $_SESSION['user_url'];

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

            // Converte e formata o preço para float com duas casas decimais
            $price = number_format((float)$price, 2, '.', '');

            // Construa e execute a consulta SQL para inserção
            $query = "INSERT INTO products (description, quantity, categoryId, price, date, user_url) VALUES (:description, :quantity, :categoryId, :price, :date, :user_url)";
            $params = array(
                ':description'  => $description,
                ':quantity'     => $quantity,
                ':categoryId'   => $categoryId,
                ':price'        => $price,
                ':date'         => $date,
                ':user_url'     => $user_url
            );
            $check = $DB->write($query, $params);

            if ($check) {
                return true;
            } else {
                $_SESSION['error'] = "Erro ao inserir produto na base de dados.";
            }
        } else {
            $_SESSION['error'] = "O nome do produto e a quantidade são obrigatórios.";
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



