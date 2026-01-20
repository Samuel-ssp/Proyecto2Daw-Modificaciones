<?php
    require_once __DIR__ . '/controladores/cIcono.php';
    session_start();
    $controlador = new CIcono();
    
    if(isset($_SESSION['idAdmin'])){
        $idAdmin = $_SESSION['idAdmin'];
        $controlador->vistaCrearIcono($idAdmin);
    } else {
        header("Location: pLoginAdmin.php");
    }
?>
