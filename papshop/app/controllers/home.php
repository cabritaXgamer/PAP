<?php

// Controlador responsável por exibir a página inicial e verificar o status de login do usuário.
class Home extends Controller
{
   // Método index para renderizar a página inicial
   public function index()
   {
      // Carrega o modelo de usuário e verifica o status de login
      $User = $this->load_model('User');
      $user_data = $User->check_login();
      if (is_array($user_data)) {
         $data['user_data'] = $user_data;
      }

      // Define o título da página
      $data['page_title'] = "Home";

      // Renderiza a página inicial com os dados do usuário e o título definido
      $this->view("index", $data);
   }
}
