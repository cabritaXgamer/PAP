<?php


class Shop extends Controller
{
    //Public default metodo index, mesmo que o utilizador coloque ou não qualquer URL, o Index vai sempre correr

    public function index()
    {

        $User = $this->load_model('User');
        $user_data = $User->check_login();

        //validate if the user is really log in
        if (is_object($user_data)) {
            $data['user_data'] = $user_data;
            //show($data['user_data']);
        }

        // Get category list
        $categoryModel = $this->load_model('Product');
        $data['products'] = $categoryModel->get_product();


        // Adiciona o nome da categoria aos dados de cada produto
        foreach ($data['products'] as &$product) {
            if (isset($categoryNames[$product['categoryId']])) {
                $product['categoryName'] = $categoryNames[$product['categoryId']];
            } else {
                $product['categoryName'] = 'Categoria Desconhecida'; // Trate casos em que a categoria não existe
            }
        }
        unset($product); // Limpa a referência ao último produto

        //$this->title = 'Admin - Dashboard';
        $data['page_title'] = "Shop - loja";
        //Rota onde esta a view que vai carregar
        $this->view("shop", $data);
    }
}
