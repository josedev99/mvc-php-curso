<?php
    //para usar los métodos del modelo user
    require_once 'model/User.php';
    require_once 'model/UserType.php';

    class UserController    
    {
        private $model;
        private $userType;
        
        public function __CONSTRUCT()
        {
            //inicializa el modelo
            $this->model = new User();
            $this->userType = new UserType();
            
            Connection::sessionOK();
        }

        public function index() {
            //creamos la vista
            require_once 'view/pages/include/header.php';
            require_once 'view/pages/principal.php';
            require_once 'view/pages/include/footer.php'; 
        }

        public function read() {
            //creamos la vista
            require_once 'view/pages/include/header.php';
            require_once 'view/pages/user/read.php';
            require_once 'view/pages/include/footer.php'; 
        }

        public function createForm()
        {
            //creamos la vista
            require_once 'view/pages/include/header.php';
            require_once 'view/pages/user/create.php';
            require_once 'view/pages/include/footer.php';

        }
        public function updateForm()
        {
            //objeto
            $usertype = new UserType();

            $usertype = $this->model->readId(base64_decode($_REQUEST["id"]));
            
            //creamos la vista
            require_once 'view/pages/include/header.php';
            require_once 'view/pages/user/update.php';
            require_once 'view/pages/include/footer.php';

        }

        public function update()
        {
            //pasar los datos al modelo ($data)
            $this->model->id = $_REQUEST['id'];
            $this->model->nombre = $_REQUEST['nombre'];
            $this->model->descripcion = $_REQUEST['descripcion'];
            //cambiamos el estado
            $this->model->update($this->model);

            header('location: ?c='. base64_encode("UserType"));

        }
        
        public function changeState()
        {
            $newState = base64_decode($_REQUEST['newState']);
            $id = base64_decode($_REQUEST['id']);
            //cambiamos el estado
            $this->model->changeState($newState, $id);

            header('location: ?c='. base64_encode("UserType"));

        }

        public function into() {
            try {
                $user = new User();
            
                //captura todos los datos
                $email = $_REQUEST['email'];
                $password = $_REQUEST['password'];

                $user = $this->model->login($email, $password);
                
                $this->model->startSession($user); 

            } catch (\Throwable $th) {
                die($th->getMessage());
            }
        }

        public function out() {
            try {
                            
                header("Location: ?c=".base64_encode('Login')."&error=".base64_encode('1'));


            } catch (\Throwable $th) {
                die($th->getMessage());
            }
        }
    }
    

?>