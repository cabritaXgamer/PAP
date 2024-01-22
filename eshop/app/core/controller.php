<?php
class controlers
{
    public function view($path,$HTTP_RAW_POST_DATA=[])
    {
        if(file_exists("../app/views/" . $path . ".php"))
        {
            include "../app/views/" . $path . ".php";
        }

    }

}