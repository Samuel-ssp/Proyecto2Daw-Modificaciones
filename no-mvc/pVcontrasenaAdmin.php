<?php
require_once __DIR__ . '/controladores/cPerfilAdmin.php';

$controlador = new CAdmin();

session_start();

if(isset($_SESSION['idAdmin'])) {
    $controlador->vistaModificarcontrasena();
} else {
    header("Location: pLoginAdmin.php");
    exit();
}
?>