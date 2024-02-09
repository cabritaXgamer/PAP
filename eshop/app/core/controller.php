<?php
class Controller
{
    //metodo que atribui responsabilidade as views
    public function view($path,$data = [] )
    {
        if(file_exists("../app/views/" . THEME . $path . ".php"))
        {
            include "../app/views/" . THEME . $path . ".php";

        }
    }
    //metodo que atribui responsabilidade a base de dados 
    public function Load_model($model)
    {
        if(file_exists("../app/models/" . strtolower($model) . "class.php"))
        {
            include "../app/models/" . strtolower($model) . "class.php";
            return $a = new $model();
        }
        return false;
    }
}
