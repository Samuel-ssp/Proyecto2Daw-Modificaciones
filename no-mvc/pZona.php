<?php
    session_start();
    require_once __DIR__ . '/controladores/cZonas.php';
    $controlador = new CZonas();

    if(isset($_SESSION['idUsuario'])) {
        $idUsuario = $_SESSION['idUsuario'];
        $controlador->generarZonas($idUsuario);
    } else {
        // Si no está logueado, redirigir al login del MVC o mostrar error
        header("Location: ../php/index.php?c=Usuario&m=mostrarLogin");
        exit();
    }
?>