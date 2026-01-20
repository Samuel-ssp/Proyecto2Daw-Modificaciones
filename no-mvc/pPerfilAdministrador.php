<?php
require_once __DIR__ . '/controladores/cPerfilAdmin.php';

$controlador = new CAdmin();

session_start();

if(isset($_SESSION['idAdmin'])) {
    $controlador->perfilAdministrador();
} else {
    header("Location: pLoginAdmin.php");
    exit();
}
?>