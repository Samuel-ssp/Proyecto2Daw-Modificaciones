<?php
require_once __DIR__ . '/../modelos/mUsuario.php';

class CUsuarios { 
    
    private $modelo;
    
    public function __construct(){
        $this->modelo = new MUsuarios();
    }

    public function listarUsuarios(){
        $idAdmin = $_SESSION['idAdmin']; 
        $usuarios = $this->modelo->listarUsuarios();
        require __DIR__ . '/../vistas/lUsuarios.php';
    }

    public function eliminarUsuario($idTarget){
        $idAdmin = $_SESSION['idAdmin']; 
        $this->modelo->eliminarUsuario($idTarget);
        $this->listarUsuarios();
    }
    

    
    public function perfilUsuario(){
        $idUsuario = $_SESSION['idUsuario'];
        $filaUsuario = $this->modelo->mostrarUsuarioPerfil($idUsuario);
        require __DIR__ . '/../vistas/perfilUsuario.php'; 
    }
    
    public function vistaModificarcontrasena(){
        $idUsuario = $_SESSION['idUsuario'];
        $filaUsuario = $this->modelo->mostrarUsuarioPerfil($idUsuario);
        require __DIR__ . '/../vistas/modificarContrasenaUsuario.php';
    }
    
    public function procesarCambioContrasena(){
        $idUsuario = $_SESSION['idUsuario'];
        $contrasena_actual = $_POST['contrasena_actual'];
        $nueva_contrasena = $_POST['nueva_contrasena'];
        $confirmar_contrasena = $_POST['confirmar_contrasena'];
        $mensaje = "";
        
        if(empty($contrasena_actual) || empty($nueva_contrasena) || empty($confirmar_contrasena)) {
            $mensaje = "Error: Todos los campos son obligatorios";
            $filaUsuario = $this->modelo->mostrarUsuarioPerfil($idUsuario);
            require __DIR__ . '/../vistas/modificarContrasenaUsuario.php';
            return false;
        }
        
        if($nueva_contrasena !== $confirmar_contrasena) {
            $mensaje = "Error: Las contraseñas nuevas no coinciden";
            $filaUsuario = $this->modelo->mostrarUsuarioPerfil($idUsuario);
            require __DIR__ . '/../vistas/modificarContrasenaUsuario.php';
            return false;
        }
        
        $resultado = $this->modelo->modificarContrasenaUsuario($idUsuario, $contrasena_actual, $nueva_contrasena, $mensaje);
        
        if($resultado) {
            $mensaje = "Contraseña cambiada correctamente";
            $filaUsuario = $this->modelo->mostrarUsuarioPerfil($idUsuario);
            require __DIR__ . '/../vistas/perfilUsuario.php';
        } else {
            $filaUsuario = $this->modelo->mostrarUsuarioPerfil($idUsuario);
            require __DIR__ . '/../vistas/modificarContrasenaUsuario.php';
        }
    }
    
    public function vistaEditarPerfil(){
        $idUsuario = $_SESSION['idUsuario'];
        $filaUsuario = $this->modelo->mostrarUsuarioPerfil($idUsuario);
        require __DIR__ . '/../vistas/editarPerfilUsuario.php';
    }
    
    public function procesarEditarPerfil(){
        $idUsuario = $_SESSION['idUsuario'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $mensaje = "";
        
        if(empty($nombre) || empty($apellido) || empty($email)) {
             $mensaje = "Error: Campos obligatorios vacíos";
             $this->vistaEditarPerfil();
             return;
        }

        $resultado = $this->modelo->modificarPerfilUsuario($idUsuario, $nombre, $apellido, $email, $telefono, $mensaje);
        
        if($resultado){
             $this->perfilUsuario();
        } else {
             $this->vistaEditarPerfil();
        }
    }

    public function vistaAcceso(){
        require __DIR__ . '/../vistas/acceso.php';
    }

}
?>