<?php

    class User
    {
        private $pdo;
        public $id;
        public $nombrecompleto;
        public $email;
        public $password;
        public $fotografia;
        public $idtipousuario;
        public $estado;
        
        public function __CONSTRUCT(){
            try {
                $this->pdo = Connection::Conn();
            } catch (\Throwable $th) {
                die($th->getMessage());
            }
        }

        public function create($data)
        {
            try {
                #sql
                $sql = "INSERT INTO usuario(nombrecompleto, email, password, fotografía, idtipousuario) VALUES(?,?,md5(?),?,?)";
                #preparar y ejecutar el sql
                $this->pdo->prepare($sql)
                            ->execute(
                                array(
                                    $data->nombrecompleto,
                                    $data->email,
                                    $data->password,
                                    $data->fotografia,
                                    $data->idtipousuario
                                )
                            );                

            } catch (\Throwable $th) {
                die($th->getMessage());
            }
        }

        public function update($data)
        {
            try {
                #sql
                $sql = "UPDATE usuario SET 
                            nombrecompleto = ?, email = ?, fotografía = ?, idtipousuario = ?
                        WHERE id = ?";
                #preparar y ejecutar el sql
                $this->pdo->prepare($sql)
                            ->execute(
                                array(
                                    $data->nombrecompleto,
                                    $data->email,
                                    $data->fotografia,
                                    $data->idtipousuario,
                                    $data->id
                                )
                            );                

            } catch (\Throwable $th) {
                die($th->getMessage());
            }
        }

        public function changeState($nuevo_estado, $id)
        {
            try {
                #sql
                $sql = "UPDATE usuario SET 
                            estado = ?
                        WHERE id = ?";
                #preparar y ejecutar el sql
                $this->pdo->prepare($sql)
                            ->execute(
                                array(
                                    $nuevo_estado,
                                    $id
                                )
                            );                

            } catch (\Throwable $th) {
                die($th->getMessage());
            }
        }

        public function readAll()
        {
            try {
                $stm = $this->pdo->prepare("SELECT u.id, u.nombrecompleto, u.email, u.fotografía, u.idtipousuario, tu.nombre as tipo, u.estado 
                FROM usuario as u INNER JOIN tipousuario as tu
                ON u.idtipousuario = tu.id");
                $stm->execute();

                return $stm->fetchAll(PDO::FETCH_OBJ);

            } catch (\Throwable $th) {
                die($th->getMessage());
            }       

        }

        public function readId($id)
        {
            try {
                $stm = $this->pdo->prepare("SELECT u.id, u.nombrecompleto, u.email, u.fotografía, u.idtipousuario, tu.nombre as tipo, u.estado 
                FROM usuario as u INNER JOIN tipousuario as tu
                ON u.idtipousuario = tu.id WHERE u.id = ?");
                $stm->execute([$id]);

                return $stm->fetch(PDO::FETCH_OBJ);

            } catch (\Throwable $th) {
                die($th->getMessage());
            }       

        }

        public function readState($estado)
        {
            try {
                $stm = $this->pdo->prepare("SELECT u.id, u.nombrecompleto, u.email, u.fotografía, u.idtipousuario, tu.nombre as tipo, u.estado 
                FROM usuario as u INNER JOIN tipousuario as tu
                ON u.idtipousuario = tu.id WHERE u.estado = ?");
                $stm->execute([$estado]);

                return $stm->fetchAll(PDO::FETCH_OBJ);

            } catch (\Throwable $th) {
                die($th->getMessage());
            }       

        }

        public function changePassword($password, $id)
		{
			try 
			{
				$sql = "UPDATE usuario SET  
							password = md5(?)
						WHERE id = ?";

					$this->pdo->prepare($sql)
							->execute(
								array(
									$password,
									$id
								)
							);
				
			} catch (\Throwable $th) {
                die($th->getMessage());
            } 
		}

		
		public function login($email, $password)
		{
			try 
			{
				$stm = $this->pdo
						->prepare("SELECT * FROM usuario WHERE (email = ? AND password = md5(?)) AND estado = 1");
						
				$stm->execute(array($email, $password));
				
				return $stm->fetch(PDO::FETCH_OBJ);
			} catch (\Throwable $th) {
                die($th->getMessage());
            } 
		}
		
		public function startSession($data)
		{
			try 
			{
				//condicionar el inicio de sesión
				if ($data != null) {
					#tomar los valores es variables de sesión
					session_start();
					$_SESSION["id"] = $data->id;
					$_SESSION["nombrecompleto"] = $data->nombrecompleto;
					$_SESSION["email"] = $data->email;
					$_SESSION["fotografía"] = $data->fotografía;
					$_SESSION["idtipousuario"] = $data->idtipousuario;

					//para validar cada inicio de sesión
					$_SESSION["token"] = base64_encode($data->id);
						# entrar como encargado de inventario
						header("Location: ?c=".base64_encode('User'));
				
				} else {
					// enviar al login del freelancer
					header("Location: ?c=".base64_encode('User')."&a=".base64_encode('out'));
				}

			} catch (\Throwable $th) {
                die($th->getMessage());
            } 
		}


    }
    

?>