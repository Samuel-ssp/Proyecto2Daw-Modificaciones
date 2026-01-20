<?php
    require_once __DIR__ . '/controladores/cIcono.php';
    $controlador = new cIcono();
    session_start();
    if(isset($_SESSION['idAdmin'])){
        $idAdmin = $_SESSION['idAdmin'];
        $controlador->eliminarIcono($idAdmin);
    } else {
        header("Location: pAcceso.php");
    }
?>