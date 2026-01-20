<?php
require_once __DIR__ . '/controladores/cZonas.php';

    $controlador = new CZonas();

    session_start();
    if(isset($_SESSION['idUsuario'])) {
        $idUsuario = $_SESSION['idUsuario'];
        $controlador->vistaZonas($idUsuario);
    }
    else {
        $controlador->vistaZonas('invitado');
    }
?>