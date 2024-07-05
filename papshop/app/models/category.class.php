<?php


class Category
{
    public function get_categories()
    {
        // Utilize a instância única do Database
        $DB = Database::getInstance();

        $query = "SELECT * FROM categories";
        $result = $DB->read($query);

        // Converta o resultado para um array associativo
        return json_decode(json_encode($result), true);
    }

    public function create($data)
    {
        $DB = Database::getInstance();

        // Verifique se os dados são válidos antes de inserir
        if (!empty($data->data) && $data->data_type == 'add_category') {
            // Prepare os dados para inserção
            $category = ucwords(trim($data->data));

            // Verifique se o nome da categoria é válido
            if (!preg_match("/^[a-zA-Z]+$/", $category)) {
                $_SESSION['error'] = "Por favor insira um nome de categoria correto!";
                return false;
            }
            // Construa a consulta SQL para inserção
            $query = "INSERT INTO categories (category) VALUES (:category)";
            $params = array(':category' => $category);

            // Execute a consulta SQL
            $check = $DB->write($query, $params);
            if ($check) {
                return true;
            } else {
                // Se houver um erro ao inserir, defina uma mensagem de erro na sessão
                $_SESSION['error'] = "Erro ao inserir categoria na base de dados.";
            }
        } else {
            $_SESSION['error'] = "Dados inválidos para adicionar categoria.";
        }
        return false;
    }

    //Function model edit category
    public function edit($id, $new_category)
    {
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




    //Function model delete with enabling /disabling validation
    public function delete($id)
    {
        $DB = Database::getInstance();
        $id = (int)$id;

        // Verificar se o estado de desativação está ativo para esta categoria
        $query_check_disable = "SELECT disabled FROM categories WHERE id = :id";
        $params_check_disable = array(':id' => $id);
        $disable_result = $DB->read($query_check_disable, $params_check_disable);

        // Se o estado de desativação estiver ativo, proceda com a exclusão
        if (!empty($disable_result) && $disable_result[0]->disabled == 1) {
            $query = "DELETE FROM categories WHERE id = :id LIMIT 1";
            $params = array(':id' => $id);
            $delete_result = $DB->write($query, $params);

            // Se a exclusão for bem-sucedida, retornar true
            if ($delete_result) {
                return true;
            } else {
                // Se ocorrer algum erro durante a exclusão, retornar false
                return false;
            }
        } else {
            // Se o estado de desativação não estiver ativo, retornar uma mensagem explicativa
            return "Não é possível excluir a categoria enquanto o estado estiver ativado.";
        }
    }
}
