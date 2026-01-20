<?php
require_once __DIR__ . '/controladores/cEventos.php';

session_start();
$Contrlador = new CEvento();
if(isset($_GET['idEvento']) && isset($_SESSION['idAdmin'])) {
    $idEvento = $_GET['idEvento'];
    $Contrlador->vistaModificarEvento($idEvento);
} else {
    header("Location: pLoginAdmin.php");
}
?>
