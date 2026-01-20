<?php

    require_once __DIR__ . "/../modelos/mIcono.php";

    class CIcono{
        private $modelo;

        public function __construct(){
            $this->modelo = new MIcono();
        }

        public function listarIconos($idAdmin){
            $iconos = $this->modelo->obtenerIconos();
            include __DIR__ . '/../vistas/lIconos.php';
        }

        public function eliminarIcono($idAdmin){
            $this->modelo->eliminarIcono();
            $this->listarIconos($idAdmin); 
        }
        
        public function mostrarModificarIcono($id, $idAdmin){
            $icono = $this->modelo->mostrarModificarIcono($id);
            include __DIR__ . '/../vistas/modificarIcono.php';
        }

        public function modificarIcono(){
            $id = $_GET['id'];
            $nombre = $_POST['nombre'];
            $codigo = $_POST['codigo'];
            $error = "";
            
            if(empty($nombre) || empty($codigo)) {
                $error = "Error: Todos los campos son obligatorios";
                $icono = $this->modelo->mostrarModificarIcono($id);
                require __DIR__ . '/../vistas/modificarIcono.php';
                return false;
            }

            $resultado = $this->modelo->modificarIcono($id, $nombre, $codigo);
            
            if($resultado) {
                $error = "Icono modificado correctamente";
                $iconos = $this->modelo->obtenerIconos(); 
                require __DIR__ . '/../vistas/lIconos.php';
            } else {
                $icono = $this->modelo->mostrarModificarIcono($id);
                require __DIR__ . '/../vistas/modificarIcono.php';
            }
        }

        public function vistaCrearIcono($idAdmin){
            require __DIR__ . '/../vistas/crearIcono.php';
        }

        public function crearIcono(){
            $idAdmin = $_POST['idAdmin']; 
            $nombre = $_POST['nombre'];
            $codigo = $_POST['codigo'];
            $error = "";

            if(empty($nombre) || empty($codigo)){
                $error = "Error: Todos los campos son obligatorios";
                require __DIR__ . '/../vistas/crearIcono.php'; 
                return false;
            }

            $resultado = $this->modelo->crearIcono($nombre, $codigo);

            if($resultado){
                $error = "Icono creado correctamente";
                $this->listarIconos($idAdmin); 
            }else{
                require __DIR__ . '/../vistas/crearIcono.php';
            }
        }
    }

?>