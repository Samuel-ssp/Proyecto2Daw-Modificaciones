<?php
    require_once __DIR__ . '/controladores/cUsuario.php';
    session_start();
    $controlador = new CUsuarios();
    if(isset($_GET['id']) && isset($_SESSION['idAdmin'])){
        $idTarget = $_GET['id'];
        $controlador->eliminarUsuario($idTarget);
    } else {
         header("Location: pLoginAdmin.php");
    }
?>