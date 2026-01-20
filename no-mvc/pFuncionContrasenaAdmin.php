<?php
require_once __DIR__ . '/controladores/cPerfilAdmin.php';

$controlador = new CAdmin();
session_start();
if(isset($_SESSION['idAdmin'])) {
    $controlador->procesarCambioContrasena();
} else {
    header("Location: pLoginAdmin.php");
    exit();
}
?>