<?php
require_once __DIR__ . '/controladores/cEventos.php';

$Contrlador = new CEvento();
session_start();
if(isset($_SESSION['idAdmin'])) {
    $Contrlador->vistaCrearEvento();
} else {
    header("Location: pLoginAdmin.php");
}
?>
