<?php
require_once __DIR__ . '/../modelos/mEventos.php';

class CEvento { 
    
    private $mEventos;
    
    public function __construct(){
        $this->mEventos = new MEvento();
    }

    public function vistaListarEventos(){
        $idUsuario = $_SESSION['idAdmin']; 
        $eventos = $this->mEventos->listarEventos();
        require __DIR__ .'/../vistas/lEventos.php';
    }

    public function vistaModificarEvento($idEvento){
        $idAdmin = $_SESSION['idAdmin']; 
        $evento = $this->mEventos->obtenerEvento($idEvento);
        $zonas = $this->mEventos->obtenerZonas();
        $iconos = $this->mEventos->obtenerIconos();
        
        require __DIR__ . '/../vistas/modificarEvento.php';
    }

    public function vistaCrearEvento(){
        $idAdmin = $_SESSION['idAdmin']; 
        $zonas = $this->mEventos->obtenerZonas();
        $iconos = $this->mEventos->obtenerIconos();
        
        require __DIR__ . '/../vistas/crearEvento.php';
    }

    public function procesarModificarEvento(){
        $idEvento = $_POST['idEvento'];
        $idAdmin = $_SESSION['idAdmin']; 
        
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $dano = $_POST['dano'];
        $turnos_duracion = $_POST['turnos_duracion'];
        $id_zona = $_POST['id_zona'];
        $id_icono = $_POST['id_icono'];
        
        $mensaje = "";

        if(empty($nombre) || empty($dano) || empty($turnos_duracion) || empty($id_zona)){
             $mensaje = "Error: Campos obligatorios vacíos";
             $this->vistaModificarEvento($idEvento);
             return;
        }

        $resultado = $this->mEventos->modificarEvento($idEvento, $nombre, $descripcion, $dano, $turnos_duracion, $id_zona, $id_icono, $mensaje);

        if($resultado){
             $this->vistaListarEventos();
        } else {
             $this->vistaModificarEvento($idEvento);
        }
    }
    public function procesarEliminarEvento(){
        $idEvento = $_GET['idEvento'];

        if(empty($idEvento)){
             $this->vistaListarEventos(); 
             return;
        }

        $resultado = $this->mEventos->eliminarEvento($idEvento);

        $this->vistaListarEventos();
    }



    public function procesarCrearEvento(){
        $idAdmin = $_SESSION['idAdmin']; 
        
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $dano = $_POST['dano'];
        $turnos_duracion = $_POST['turnos_duracion'];
        $id_zona = $_POST['id_zona'];
        $id_icono = $_POST['id_icono'];
        
        $mensaje = "";

        if(empty($nombre) || empty($dano) || empty($turnos_duracion) || empty($id_zona)){
             $mensaje = "Error: Campos obligatorios vacíos";
             $this->vistaCrearEvento();
             return;
        }

        $resultado = $this->mEventos->crearEvento($nombre, $descripcion, $dano, $turnos_duracion, $id_zona, $id_icono, $mensaje);

        if($resultado){
             $this->vistaListarEventos();
        } else {
             $this->vistaCrearEvento();
        }
    }
}
?>
