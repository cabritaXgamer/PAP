<?php 


//Comentario A função geral desta parte do código é capturar a URL fornecida e imprimir seu valor. 


Class App
{
    protected $controller = "home"; 
    protected $method ="index";

    public function __construct()
    {
        $url= $this->parseURL();
        show($url);
    if(file_exists("../app/controlles/" . strtolower($url[0]). ".php"))
    {
        require "../app/controllers/" . $this->controller . ".php";
        $this->controller = new $this->controller;
        show ($url);

    }
}

   


    private function parseURL()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : "home";
        return explode("/", filter_var(trim($url, "/"),FILTER_SANITIZE_URL));
      
    }

}