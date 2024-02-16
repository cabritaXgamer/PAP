<?php

class Controller 
{
   //In this method is where we call the route and we can also pass some data to the view
   //At this moment this function are not working
   /* public function view($path, $data = [])
    {

        if (file_exists("../app/views/" . THEME .  $path . ".php"))
        {
            include "../app/views/"  . THEME .  $path . ".php" ;
            //show("../app/views/" . THEME .  $path . ".php");
            //show("../app/views/" .   $path . ".php");
           
        }
        else
        {
            //if not exists the view, give to the user a 404 error
            include "../app/views/" . THEME . "404.php" ;
        }
    }
*/
    public function view($path, $data = [])
    {
        $fullPath = "../app/views/" . THEME .  $path . ".php";

        if (file_exists($fullPath)) {
            include $fullPath;
        } else {
            // Se a view não existir, exibir página de erro 404
            include "../app/views/" . THEME . "404.php";
        }
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
