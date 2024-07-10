<?php

/**
 * Todo o website vai arrancar desta classe
 * File app.php
 */

class App
{
    
    protected $controller = "home";
    protected $method = "index";
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        // Determine the base folder for the controller
        $controllerFolder = 'user'; // Default folder
        if (!empty($url[0]) && is_dir("../app/controllers/admin/") && strtolower($url[0]) == 'admin') {
            $controllerFolder = 'admin';
            array_shift($url); // Remove 'admin' from URL to access the next part as controller
        }

        // Update controller if exists
        if (!empty($url[0]) && file_exists("../app/controllers/{$controllerFolder}/" . strtolower($url[0]) . ".php")) {
            $this->controller = strtolower($url[0]);
            unset($url[0]);
        }

        // Load the controller
        require_once "../app/controllers/{$controllerFolder}/" . $this->controller . ".php";
        $this->controller = new $this->controller;

        // Check if a specific method is requested
        if (isset($url[1])) {
            $url[1] = strtolower($url[1]);
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : ["home"];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseURL()
    {
        if (isset($_GET['url'])) {
            return explode("/", filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return ["home"];
    }
}
