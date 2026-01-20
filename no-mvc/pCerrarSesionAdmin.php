<?php
    session_start();
    session_destroy();
    header("Location: pAcceso.php");
    exit();
?>
