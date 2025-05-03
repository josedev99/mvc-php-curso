<?php

    class Connection
    {
        public static function Conn()
        {
            $pdo = new PDO('mysql:host=localhost;dbname=mvc2025;charset=utf8', 'root', 'computoc3');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;

        }

		public static function sessionOk(){            
            if (!isset($_SESSION["token"]) || $_SESSION["token"] != base64_encode($_SESSION["id"]))
			{
                # enviarnos al marketing fuera del sistema
				header("Location: ?c=".base64_encode('Login'));
            }              
        }
    }

?>