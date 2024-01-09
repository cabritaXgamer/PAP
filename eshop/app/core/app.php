<?php 

/**
 * Todo o website vai arrancar desta classe
 * 
 */

class App
{
    protected $controller = "home"; 
    protected $method ="index";

    //Constructor
    public function __construct()
    {
        $url= $this->parseURL();
        show($url);
    }

    //Serve para 
    private function parseURL()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : "home";
        return explode("/", filter_var(trim($url, "/"),FILTER_SANITIZE_URL));      
    }

}