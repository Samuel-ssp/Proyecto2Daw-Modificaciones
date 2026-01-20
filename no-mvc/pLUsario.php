<?php
require_once __DIR__ . '/controladores/cUsuario.php';

$controlador = new CUsuarios();

    session_start();
    if(isset($_SESSION['idAdmin'])){
        $idAdmin = $_SESSION['idAdmin'];
        $controlador->listarUsuarios();
    } else {
        header("Location: pLoginAdmin.php");
    }

?>