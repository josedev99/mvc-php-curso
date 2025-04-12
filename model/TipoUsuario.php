<?php
class TipoUsuario{
    private $pdo;
    private $id;
    private $nombre;
    private $descripcion;
    private $estado;

    public function __construct()
    {
        try{
            $this->pdo = Conexion::Conectar();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function readAll(){
        try{
            //code
            $sql = "SELECT * FROM tipousuario";
            $sql = $this->pdo->prepare($sql);
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);

        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    public function readId($id){
        try{
            //code
            $sql = "SELECT * FROM tipousuario where id = ?";
            $sql = $this->pdo->prepare($sql);
            $sql->execute($id);
            return $sql->fetch(PDO::FETCH_OBJ);

        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    public function readState($estado){
        try{
            //code
            $sql = "SELECT * FROM tipousuario where estado = ?";
            $sql = $this->pdo->prepare($sql);
            $sql->execute($estado);
            return $sql->fetch(PDO::FETCH_OBJ);

        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    public function create($data){
        try{
            //code
            $sql = "INSERT INTO tipousuario(nombre,descripcion) VALUES(?,?)";
            $sql = $this->pdo->prepare($sql)->execute([
                array(
                    $data->nombre,
                    $data->descripcion
                )
            ]);

        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    public function update($data){
        try{
            //code
            $sql = "UPDATE tipousuario SET nombre = ?,descripcion = ? WHERE id = ?";
            $sql = $this->pdo->prepare($sql)->execute([
                array(
                    $data->nombre,
                    $data->descripcion,
                    $data->id
                )
            ]);

        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    public function changeState($nuevo_estado, $id){
        try{
            //code
            $sql = "UPDATE tipousuario SET estado = ? WHERE id = ?";
            $sql = $this->pdo->prepare($sql)->execute([
                array(
                    $nuevo_estado,
                    $id
                )
            ]);

        }catch(Exception $e){
            die($e->getMessage());
        }
    }
}