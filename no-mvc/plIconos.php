<?php
    require_once __DIR__ . '/controladores/cIcono.php';
    $controlador = new cIcono();
    session_start();
    if(isset($_SESSION['idAdmin'])){
        $idAdmin = $_SESSION['idAdmin'];
        $controlador->listarIconos($idAdmin);
    } else {
        header("Location: pLoginAdmin.php");
    }
?>