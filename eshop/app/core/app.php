<?php 


//Comentario A função geral desta parte do código é capturar a URL fornecida e imprimir seu valor. 


class app
{
    protected $controller = "home"; 
    protected $method ="index";

    public function __construct()
    {
        $url= $this->parseURL();
        print_r($url);

    }


    private function parseURL()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : "home";
        return $url;
    }

}