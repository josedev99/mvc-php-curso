<?php

    class UserType
    {
        private $pdo;
        public $id;
        public $nombre;
        public $descripcion;
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
                $sql = "INSERT INTO tipousuario(nombre, descripcion) VALUES(?,?)";
                #preparar y ejecutar el sql
                $this->pdo->prepare($sql)
                            ->execute(
                                array(
                                    $data->nombre,
                                    $data->descripcion
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
                $sql = "UPDATE tipousuario SET 
                            nombre = ?, descripcion = ?
                        WHERE id = ?";
                #preparar y ejecutar el sql
                $this->pdo->prepare($sql)
                            ->execute(
                                array(
                                    $data->nombre,
                                    $data->descripcion,
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
                $sql = "UPDATE tipousuario SET 
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
                $stm = $this->pdo->prepare("SELECT * FROM tipousuario");
                $stm->execute();

                return $stm->fetchAll(PDO::FETCH_OBJ);

            } catch (\Throwable $th) {
                die($th->getMessage());
            }       

        }

        public function readId($id)
        {
            try {
                $stm = $this->pdo->prepare("SELECT * FROM tipousuario WHERE id = ?");
                $stm->execute(array(
                    $id
                ));

                return $stm->fetch(PDO::FETCH_OBJ);

            } catch (\Throwable $th) {
                die($th->getMessage());
            }       

        }

        public function readState($estado)
        {
            try {
                $stm = $this->pdo->prepare("SELECT * FROM tipousuario WHERE estado = ?");
                $stm->execute(array(
                    $estado
                ));

                return $stm->fetchAll(PDO::FETCH_OBJ);

            } catch (\Throwable $th) {
                die($th->getMessage());
            }       

        }


    }
    

?>