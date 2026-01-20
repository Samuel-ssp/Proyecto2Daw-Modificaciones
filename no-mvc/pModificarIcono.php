<?php
    require_once __DIR__ . '/controladores/cIcono.php';
    session_start();
    $controlador = new cIcono();
    if(isset($_GET["id"]) && isset($_SESSION["idAdmin"])){
        $id = $_GET["id"];
        $idAdmin = $_SESSION["idAdmin"];
        $controlador->mostrarModificarIcono($id, $idAdmin);
    } else {
        header("Location: pLoginAdmin.php");
    }
?>