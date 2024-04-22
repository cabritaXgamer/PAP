<?php

class Home extends Controller
{
   // Método index para renderizar a página inicial
   public function index()
   {
      // Carrega o modelo de usuário e verifica o status de login
      $User = $this->load_model('User');
      $data['user_data'] = $User->check_login();

      // Verifica se os dados do usuário são um array antes de atribuí-los
      if (is_array($data['user_data'])) {
         $data['user_data'] = $data['user_data'];
      }

      // Define o título da página
      $data['page_title'] = "Home";

      // Renderiza a página inicial com os dados do usuário e o título definido
      $this->view("index", $data);
   }
}
