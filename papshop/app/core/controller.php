<?php

class Controller
{

    //public function view
    public function view($path, $data = [])
    {
        $fullPath = "../app/views/" . THEME .  "/" . $path . ".php";

        try {
            if (!file_exists($fullPath)) {
                throw new Exception('View não encontrada');
            }

            require_once $fullPath;
        } catch (Exception $e) {
            $this->showErrorPage();
        }
    }


    //public function show error page
    private function showErrorPage()
    {
        require_once "../app/views/carserv/404.php";
    }

    //public function load model
    public function load_model($model)
    {

        if (file_exists("../app/models/" .  strtolower($model) . ".class.php")) {
            include "../app/models/" .  strtolower($model) . ".class.php";
            return $a = new $model();
        }
        return false;
    }
}
