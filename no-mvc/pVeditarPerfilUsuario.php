<?php
require_once __DIR__ . '/controladores/cUsuario.php';

$controlador = new CUsuarios();

session_start();
if(isset($_SESSION['idUsuario'])) {
    $controlador->vistaEditarPerfil();
} else {
    header("Location: ../php/index.php?c=Usuario&m=mostrarLogin");
}
?>
