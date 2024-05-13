<?php 

/**
 * Todo o website vai arrancar desta classe
 * File app.php
 */

class App
{
    // protected $controller = "home"; 
    // protected $method ="index";
    // protected $params;

    // //Constructor
    // public function __construct()
    // { 
        
    //     $url= $this->parseURL();

    //     //show($url);

    //     //Se o ficheiro existir, ele vai substituir o controlador para aceder às funçoes do controlador especifico
    //     //Concatena a URL com as funçoes 
    //     if(file_exists("../app/controllers/user/" . strtolower($url[0]) . ".php"))
    //     {
    //         $this->controller = strtolower($url[0]);
    //         unset($url[0]);
    //     }

    //      //Senao encontrar o controlador ele vai para a home
    //      require "../app/controllers/user/" . $this->controller . ".php";
    //      $this->controller = new $this->controller;

    

    //     //Aqui vamos procurar um metodo dentro do controldaor no array pos [1] da URL
    //     if(isset($url[1]))
    //     {
    //         //primeiro verificamos se existe um um metodo pos[2] da URL
    //         $url[1] = strtolower($url[1]);
    //         if(method_exists($this->controller, $url[1]))
    //         {
    //             //remover 
    //             $this->method = $url[1];
    //             unset($url[1]);
    //         }
    //     }
    
    //     //show( ADMIN_THEME);
    //     //Validação se nao existir nada na url ele manda para a home, caso contrario
    //     //O params pode receber o array fornecido pelo utilizador, caso contrario recebe a home 
    //     //$this->params = (count($url) > 0) ? $url : ["home"];
    //     //show(array_values($url));

    //     if (count($url) > 0) {
    //         $this->params = $url;
    //     } else {
    //         $this->params = ["home"];
    //     }

    //     call_user_func_array([$this->controller,$this->method],$this->params);
    // }

    // //Serve para 
    // private function parseURL()
    // {
    //     $url = isset($_GET['url']) ? $_GET['url'] : "home";
    //     return explode("/", filter_var(trim($url, "/"),FILTER_SANITIZE_URL));      
    // }



    protected $controller = "home";
    protected $method = "index";
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        // Determine the base folder for the controller
        $controllerFolder = 'user'; // Default folder
        if (!empty($url[0]) && is_dir("../app/controllers/admin/") && strtolower($url[0]) == 'admin') {
            $controllerFolder = 'admin';
            array_shift($url); // Remove 'admin' from URL to access the next part as controller
        }

        // Update controller if exists
        if (!empty($url[0]) && file_exists("../app/controllers/{$controllerFolder}/" . strtolower($url[0]) . ".php")) {
            $this->controller = strtolower($url[0]);
            unset($url[0]);
        }

        // Load the controller
        require_once "../app/controllers/{$controllerFolder}/" . $this->controller . ".php";
        $this->controller = new $this->controller;

        // Check if a specific method is requested
        if (isset($url[1])) {
            $url[1] = strtolower($url[1]);
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Set parameters or default to ["home"]
        $this->params = $url ? array_values($url) : ["home"];

        // Call the method on the controller with parameters
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseURL()
    {
        if (isset($_GET['url'])) {
            return explode("/", filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return ["home"];
    }
}

