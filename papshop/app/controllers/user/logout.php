<?php

// Controlador responsável por exibir a página inicial e verificar o status de login do usuário.
class logout extends Controller
{
    // Método index para renderizar a página inicial
    public function index()
    {
        // Carrega o modelo de usuário e verifica o status de login
        $User = $this->load_model('User');
        $User->logout();
    }
}
