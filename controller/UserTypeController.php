<?php
    
    //para usar los métodos del modelo UserType
    require_once 'model/UserType.php';

    class UserTypeController
    {
        private $model;
        
        public function __CONSTRUCT()
        {
            //inicializa el modelo
            $this->model = new UserType();
            
            Connection::sessionOK();
        }
        
        public function index()
        {
            //creamos la vista
            require_once 'view/pages/include/header.php';
            require_once 'view/pages/usertype/read.php';
            require_once 'view/pages/include/footer.php';

        }
        
        public function createForm()
        {
            //creamos la vista
            require_once 'view/pages/include/header.php';
            require_once 'view/pages/usertype/create.php';
            require_once 'view/pages/include/footer.php';

        }
        
        public function create()
        {
            //pasar los datos al modelo ($data)
            $this->model->nombre = $_REQUEST['nombre'];
            $this->model->descripcion = $_REQUEST['descripcion'];
            //cambiamos el estado
            $this->model->create($this->model);

            header('location: ?c='. base64_encode("UserType"));

        }        
        
        public function updateForm()
        {
            //objeto
            $usertype = new UserType();

            $usertype = $this->model->readId(base64_decode($_REQUEST["id"]));
            
            //creamos la vista
            require_once 'view/pages/include/header.php';
            require_once 'view/pages/usertype/update.php';
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
    }

?>