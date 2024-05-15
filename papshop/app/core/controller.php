<?php

class Controller 
{
   
    public function view($path, $data = [])
    {
        $fullPath = "../app/views/" . THEME .  "/" . $path . ".php";
        
        //show($fullPath);

        try {
            if (!file_exists($fullPath)) {
                throw new Exception('View não encontrada');
            }

            require_once $fullPath;
        } catch (Exception $e) {
            $this->showErrorPage();
        }
    }

    // public function view($path,$data = [] )
    // {
    //     if(file_exists("../app/views/" . THEME .  "/" . $path . ".php"))
    //     {
    //         include "../app/views/" . THEME .  "/" . $path . ".php";

    //         //show( "../app/views/carserv/" . THEME . $path . ".php");
    //     }
    //     else
    //     {
    //         include "../app/views/carserv/"  . $path . "404.php";
    //     }
    // }

    private function showErrorPage() {
        require_once "../app/views/carserv/404.php";
        // Ou redirecione para a página de erro 404 usando header() se preferir
        // header("HTTP/1.0 404 Not Found");
        //include "../app/views/carserv/404.php";
    }

    //In this method is where we call the route and we can also pass some data to the view
    public function load_model($model)
    {

        if (file_exists("../app/models/" .  strtolower($model) . ".class.php"))
        {
            include "../app/models/" .  strtolower($model) . ".class.php";
            return $a = new $model();                 
        }
        return false;
    }

}