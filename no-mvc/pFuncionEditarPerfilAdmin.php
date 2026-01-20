<?php
require_once __DIR__ . '/controladores/cPerfilAdmin.php';

session_start();

$controlador = new CAdmin();

if(isset($_SESSION['idAdmin'])) {
    $controlador->procesarEditarPerfil();
} else {
    header("Location: pLoginAdmin.php");
    exit();
}
?>