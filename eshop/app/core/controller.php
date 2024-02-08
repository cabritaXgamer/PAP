<?php

class Controller 
{
   //In this method is where we call the route and we can also pass some data to the view
    public function view($path, $data = [])
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
}
