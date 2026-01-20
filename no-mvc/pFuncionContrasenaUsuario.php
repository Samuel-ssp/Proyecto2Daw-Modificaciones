<?php
session_start();

require_once __DIR__ . '/controladores/cUsuario.php';

$controlador = new CUsuarios();

if(isset($_SESSION['idUsuario'])) {
    $controlador->procesarCambioContrasena();
} else {
    header("Location: ../php/index.php?c=Usuario&m=mostrarLogin");
    exit();
}
?>
