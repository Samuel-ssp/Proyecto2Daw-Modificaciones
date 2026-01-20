<?php
require_once __DIR__ . '/../modelos/mAdministrador.php';

class CAdmin { 
    
    private $mAdmin;
    
    public function __construct(){
        $this->mAdmin = new MAdmin();
    }

    public function vistaDashboardAdmin(){
        require __DIR__ .'/../vistas/dashboardAdmin.php';
    }
    
    public function perfilAdministrador(){
        $filaAdmin = $this->mAdmin->mostrarAdministradorPerfil($_SESSION['idAdmin']);
        require __DIR__ . '/../vistas/perfilAdmin.php';
    }
    
    public function vistaModificarcontrasena(){
        $idAdmin = $_SESSION['idAdmin'];
        $filaAdmin = $this->mAdmin->mostrarAdministradorPerfil($idAdmin);
        require __DIR__ . '/../vistas/modificarContrasenaAdmin.php';
    }
    
    public function procesarCambioContrasena(){
        $idAdmin = $_SESSION['idAdmin'];
        
        $contrasena_actual = $_POST['contrasena_actual'];
        $nueva_contrasena = $_POST['nueva_contrasena'];
        $confirmar_contrasena = $_POST['confirmar_contrasena'];
        $mensaje = "";
        
        if(empty($contrasena_actual) || empty($nueva_contrasena) || empty($confirmar_contrasena)) {
            $mensaje = "Error: Todos los campos son obligatorios";
            $filaAdmin = $this->mAdmin->mostrarAdministradorPerfil($idAdmin);
            require __DIR__ . '/../vistas/modificarContrasenaAdmin.php';
            return false;
        }
        
        if($nueva_contrasena !== $confirmar_contrasena) {
            $mensaje = "Error: Las contraseñas nuevas no coinciden";
            $filaAdmin = $this->mAdmin->mostrarAdministradorPerfil($idAdmin);
            require __DIR__ . '/../vistas/modificarContrasenaAdmin.php';
            return false;
        }
        
        $resultado = $this->mAdmin->modificarContrasenaAdmin($idAdmin, $contrasena_actual, $nueva_contrasena, $mensaje);
        
        if($resultado) {
            $mensaje = "Contraseña cambiada correctamente";
            $filaAdmin = $this->mAdmin->mostrarAdministradorPerfil($idAdmin); 
            require __DIR__ . '/../vistas/perfilAdmin.php';
        } else {
            $filaAdmin = $this->mAdmin->mostrarAdministradorPerfil($idAdmin);
            require __DIR__ . '/../vistas/modificarContrasenaAdmin.php';
        }
        
    }

    public function vistaEditarPerfil(){
        $idAdmin = $_SESSION['idAdmin'];
        $filaAdmin = $this->mAdmin->mostrarAdministradorPerfil($idAdmin);
        require __DIR__ . '/../vistas/editarPerfilAdmin.php';
    }

    public function procesarEditarPerfil(){
        $idAdmin = $_SESSION['idAdmin'];
        
        $nombre = $_POST['nombre'];
        $mensaje = "";
        
        if(empty($nombre)){ 
            $mensaje = "Error: No se han rellenado los campos";
            $filaAdmin = $this->mAdmin->mostrarAdministradorPerfil($idAdmin);
            require __DIR__ . '/../vistas/editarPerfilAdmin.php';
            return false;
        }
        
        $resultado = $this->mAdmin->modificarPerfilAdmin($idAdmin, $nombre, $mensaje);
        
        if($resultado) {
            $mensaje = "Perfil actualizado correctamente";
            $filaAdmin = $this->mAdmin->mostrarAdministradorPerfil($idAdmin);
            require __DIR__ . '/../vistas/perfilAdmin.php';
        } else {
            if(empty($mensaje)) $mensaje = "Error al actualizar el perfil";
            $filaAdmin = $this->mAdmin->mostrarAdministradorPerfil($idAdmin);
            require __DIR__ . '/../vistas/editarPerfilAdmin.php';
        }
        
    }

    public function vistaLoginAdmin(){
        require __DIR__ . '/../vistas/admin_login.php';
    }

    public function procesarLoginAdmin(){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $mensaje = "";

        if(empty($email) || empty($password)){
            $mensaje = "Por favor, complete todos los campos";
            require __DIR__ . '/../vistas/admin_login.php';
            return;
        }

        $idAdmin = $this->mAdmin->verificarCredenciales($email, $password, $mensaje);

        if($idAdmin){
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['idAdmin'] = $idAdmin;
            
            // Obtener nombre del administrador para mostrarlo en el header
            $datosAdmin = $this->mAdmin->mostrarAdministradorPerfil($idAdmin);
            $_SESSION['nombreAdmin'] = $datosAdmin['nombre'];
            
            $this->vistaDashboardAdmin();
        } else {
            require __DIR__ . '/../vistas/admin_login.php';
        }
    }

}
?>