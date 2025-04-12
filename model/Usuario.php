<?php
class Usuario{
    private $pdo;
    private $id;
    private $nombreCompleto;
    private $email;
    private $password;
    private $fotografia;
    private $idtipousuario;
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
            $sql = "select u.id, u.nombrecompleto, u.email,u.fotografía,u.idtipousuario,t.nombre as tipo, u.estado from usuario as u inner join tipousuario as t on u.idtipousuario=t.id;";
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
            $sql = "select u.id, u.nombrecompleto, u.email,u.fotografía,u.idtipousuario,t.nombre as tipo, u.estado from usuario as u inner join tipousuario as t on u.idtipousuario=t.id where u.id = ?";
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
            $sql = "select u.id, u.nombrecompleto, u.email,u.fotografía,u.idtipousuario,t.nombre as tipo, u.estado from usuario as u inner join tipousuario as t on u.idtipousuario=t.id where u.estado = ?";
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
            $sql = "INSERT INTO usuario(nombrecompleto,email,password,fotografía,idtipousuario) VALUES(?,?,MD5(?),?,?)";
            $sql = $this->pdo->prepare($sql)->execute([
                array(
                    $data->nombrecompleto,
                    $data->email,
                    $data->password,
                    $data->fotografia,
                    $data->idtipousuario
                )
            ]);

        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    public function update($data){
        try{
            //code
            $sql = "UPDATE usuario SET nombrecompleto = ?,email = ?, fotografía = ?, idtipousuario = ? WHERE id = ?";
            $sql = $this->pdo->prepare($sql)->execute([
                array(
                    $data->nombrecompleto,
                    $data->email,
                    $data->fotografia,
                    $data->idtipousuario,
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
            $sql = "UPDATE usuario SET estado = ? WHERE id = ?";
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