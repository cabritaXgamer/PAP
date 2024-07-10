<?php


class Shop extends Controller
{
    //Public default metodo index, mesmo que o utilizador coloque ou não qualquer URL, o Index vai sempre correr

    public function index()
    {

        //Load model User, to access database
        $User = $this->load_model('User');
        $user_data = $User->check_login();

        //validate if the user is really log in
        if (is_object($user_data)) {
            $data['user_data'] = $user_data;
        }

        // Get category list
        $categoryModel = $this->load_model('Product');
        $data['products'] = $categoryModel->get_product();


        // Adds the category name to each product's data
        foreach ($data['products'] as &$product) {
            if (isset($categoryNames[$product['categoryId']])) {
                $product['categoryName'] = $categoryNames[$product['categoryId']];
            } else {
                $product['categoryName'] = 'Categoria Desconhecida'; // Trate casos em que a categoria não existe
            }
        }
        unset($product);

        //Page title
        $data['page_title'] = "Shop - loja";
        // Path where the view that will load is located
        $this->view("shop", $data);
    }
}
