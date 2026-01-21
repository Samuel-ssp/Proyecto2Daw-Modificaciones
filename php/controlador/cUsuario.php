<?php
require_once __DIR__ . '/../modelo/Musuario.php';
class CUsuario
{

    public $nombreVista;
    private $modelo;

    public function __construct()
    {
        $this->modelo = new Usuario();
    }
    public function mostrarAcceso()
    {
        header('Location: ../no-mvc/pAcceso.php');
        exit();
    }

    /* ======== MOSTRAR REGISTRO ======== */
    public function mostrarRegistro()
    {
        $this->nombreVista = "registro";
    }

    public function mostrarZonas()
    {
        header("Location: ../no-mvc/pMostrarZonas.php");
        exit();
    }


    public function obtenerPuntuaciones()
    {
        $this->nombreVista = "puntuaciones";
        return $resultado = $this->modelo->obtenerPuntuacion();
    }

    public function guardarPuntuacion()
    {
        // Solo para usuarios logueados
        if (!isset($_SESSION['idUsuario'])) {
            error_log("GUARDAR PUNTUACION: No autorizado. " . print_r($_SESSION, true)); // Comprueba que el usuario esta logueado
            echo json_encode(["error" => "No autorizado"]);
            exit;
        }

        $puntos = $_POST['puntos'] ?? 0;
        $id = $_SESSION['idUsuario'];

        $resultado = $this->modelo->actualizarPuntuacion($id, $puntos);

        echo json_encode(["status" => "ok", "actualizado" => $resultado]);
        exit;
    }
    /* ======== REGISTRAR USUARIO ======== */
    public function registrar()
    {

        // Validación básica de existencia
        if (!isset($_POST['usuario']) || !isset($_POST['email']) || !isset($_POST['password'])) {
            $this->nombreVista = "registro";
            return ["error" => "Faltan datos"];
        }

        $nombre = $_POST['usuario'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $pass2 = $_POST['password2'];

        // Validación 
        if (empty($nombre) || empty($email) || ($pass != $pass2)) {
            $this->nombreVista = "registro";
            return ["error" => "Los datos no son válidos"];
        }

        //Validar si el email ya existe
        $resultado = $this->modelo->login($email);

        if ($resultado) {
            $this->nombreVista = "registro";
            return ["error" => "El email ya está registrado."];
        }

        // Hash de contraseña
        //$passCifrada = password_hash($pass, PASSWORD_DEFAULT);


        // Insertar en BD
        //$this->modelo->insertar($nombre, $email, $passCifrada);
        $this->modelo->insertar($nombre, $email, $pass);
        

        // Cambiamos a vista login
        $this->nombreVista = "login";
        return ["mensaje" => "Usuario registrado correctamente"];
    }


    /* ======== MOSTRAR LOGIN ======== */
    public function mostrarLogin()
    {
        $this->nombreVista = "login";
    }

    /* ======== INICIO DE SESIÓN ======== */
    public function login()
    {

        if (!isset($_POST['email']) || !isset($_POST['password'])) {
            $this->nombreVista = "login";
            return ["error" => "Datos incompletos"];
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        // Buscar usuario
        $usuario = $this->modelo->login($email);

        if (empty($usuario)) {
            $this->nombreVista = "login";
            return ["error" => "Usuario no registrado"];
        }

        /*
        if (!password_verify($password, $usuario['contrasena'])) {
            $this->nombreVista = "login";
            return ["error" => "Contraseña incorrecta"];
        }
        */

        // COMPROBACION TEXTO PLANO
        if ($password !== $usuario['contrasena']) {
            $this->nombreVista = "login";
            return ["error" => "Contraseña incorrecta"];
        }

        $_SESSION['nombreUsuario'] = $usuario['nombre'];
        $_SESSION['idUsuario'] = $usuario['id_usuario']; 

        
        header("Location: ../no-mvc/pMostrarZonas.php");
        exit();
    }

    /* ======== CERRAR SESIÓN ======== */
    public function cerrarSesion()
    {
        session_destroy();
        header("Location: ../no-mvc/pAcceso.php");
        exit();
    }


}


?>