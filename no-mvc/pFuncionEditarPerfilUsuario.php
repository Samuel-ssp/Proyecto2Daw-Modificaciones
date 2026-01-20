<?php
require_once __DIR__ . '/controladores/cUsuario.php';

$controlador = new CUsuarios();

session_start();
if(isset($_SESSION['idUsuario'])) {
    $controlador->procesarEditarPerfil();
} else {
    echo "Error: No hay sesión activa";
}
?>
