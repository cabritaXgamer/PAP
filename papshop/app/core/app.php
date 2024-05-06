<?php


//Comentario A função geral desta parte do código é capturar a URL fornecida e imprimir seu valor. 


class App
{
    protected $controller = "home";
    protected $method = "index";
    protected $params;

    public function __construct()
    {
        $url = $this->parseURL();
        //     show($url);
        if (file_exists("../app/controllers/" . strtolower($url[0]) . ".php")) {
            $this->controller = strtolower($url[0]);
            unset($url[0]);
        }
        require "../app/controllers/" . $this->controller . ".php";

        $this->controller = new $this->controller;
        if (isset($url[1])) {
            $url[1] = strtolower($url[1]);
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        //Validação se nao existir nada na url ele manda para a home, caso contrario
        if (count($url) > 0) {
            $this->params = $url;
        } else {
            $this->params = ["home"];
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseURL()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : "home";
        return explode("/", filter_var(trim($url, "/"), FILTER_SANITIZE_URL));
    }
}
