<?php
session_start(); // DEBE estar PRIMERO para recuperar la sesión del MVC

require_once __DIR__ . '/controladores/cUsuario.php';

$controlador = new CUsuarios();

// Obtener el ID de la Sesión (Seguro)
if(isset($_SESSION['idUsuario'])) {
    $idUsuario = $_SESSION['idUsuario'];
    $controlador->perfilUsuario($idUsuario);
} else {
    // Si no está logueado, redirigir al login del MVC o mostrar error
    header("Location: ../php/index.php?c=Usuario&m=mostrarLogin");
    exit();
}
?>
