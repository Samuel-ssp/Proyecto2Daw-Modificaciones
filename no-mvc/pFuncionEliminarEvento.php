<?php
require_once __DIR__ . '/controladores/cEventos.php';

session_start();
$Contrlador = new CEvento();
$Contrlador->procesarEliminarEvento();
?>
