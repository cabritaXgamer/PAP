<?php


class Category
{
    public function get_categories()
    {
        // Use the singleton instance of the Database
        $DB = Database::getInstance();

        $query = "SELECT * FROM categories";
        $result = $DB->read($query);

        // Convert the result to an associative array
        return json_decode(json_encode($result), true);
    }

    public function create($data)
    {
        $DB = Database::getInstance();

        // Check if the data is valid before inserting
        if (!empty($data->data) && $data->data_type == 'add_category') {
            // Prepare the data for insertion
            $category = ucwords(trim($data->data));

            // Validate the category name
            if (!preg_match("/^[a-zA-Z]+$/", $category)) {
                $_SESSION['error'] = "Por favor insira um nome de categoria correto!";
                return false;
            }
            // Build the SQL query for insertion
            $query = "INSERT INTO categories (category) VALUES (:category)";
            $params = array(':category' => $category);

            // Execute the SQL query
            $check = $DB->write($query, $params);
            if ($check) {
                return true;
            } else {
                // If there's an error inserting, set an error message in the session
                $_SESSION['error'] = "Erro ao inserir categoria na base de dados.";
            }
        } else {
            $_SESSION['error'] = "Dados inválidos para adicionar categoria.";
        }
        return false;
    }

    // Function to edit a category
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

        // Check if the disabled state is active for this category
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
