<?php

    class LoginController    
    {
        public function index() {
            //destruir sesión
            session_destroy();
            
            //creamos la vista
            require_once 'view/pages/login.php';
        }

    }
    

?>