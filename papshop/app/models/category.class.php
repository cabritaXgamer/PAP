<?php


Class Category
{
    public function get_categories()
    {
        $DB = Database::newInstance();

        $query    = "select * from categories";
        $result = $DB->read($query);
       

        return json_decode(json_encode($result), true);
        
    }


    public function create($data)
    {
        $DB = Database::getInstance();

        // Verifica se os dados são válidos antes de inserir
        if (!empty($data->data) && $data->data_type == 'add_category') {
            // Prepare os dados para inserção
            $category = ucwords(trim($data->data));

            // Verifica se o nome da categoria é válido
            if (!preg_match("/^[a-zA-Z]+$/", $category)) {
                $_SESSION['error'] = "Por favor insira um nome de categoria correto!";
                return false;
            }
            // Construa a consulta SQL para inserção
            $query = "INSERT INTO categories (category) VALUES (:category)";
            $params = array(':category' => $category);
            // Executa a consulta SQL
            $check = $DB->write($query, $params);
            if ($check) {
                return true;
            } else {
                // Se houver um erro ao inserir, defina uma mensagem de erro na sessão
                $_SESSION['error'] = "Erro ao inserir categoria no banco de dados.";
            }
        } else {
            $_SESSION['error'] = "Dados inválidos para adicionar categoria.";
        }
        return false;
    }



    public function edit()
    {
        
    }

    public function delete($id)
    {
        $DB = Database::newInstance();
        $id = (int)$id;
        $query = "delete from categories where id = '$id' limit 1";
        $DB->write($query);
    }

}


