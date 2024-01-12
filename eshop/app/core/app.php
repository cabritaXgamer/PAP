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
        $this->controller = strtolower($url[0]);
        unset($url[0]);
        

    }
        require "../app/controllers/" . $this->controller . ".php";
        $this->controller = new $this->controller;
        if(isset($url[1]))
        {
            $url[1] = strtolower($url[1]);
            if(method_exists($this->controller,$url[1]));

        }
        show ($url);

    }

    private function parseURL()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : "home";
        return explode("/", filter_var(trim($url, "/"),FILTER_SANITIZE_URL));
      
    }

}