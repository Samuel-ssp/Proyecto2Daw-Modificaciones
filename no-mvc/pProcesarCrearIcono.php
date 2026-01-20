<?php
    require_once __DIR__ . '/controladores/cIcono.php';

    session_start();
    $controlador = new cIcono();
    $controlador->crearIcono();

?>