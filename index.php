<?php
if (is_dir('install')) {
    header("Location: install/index.php");
    exit();
}
header("Location: php/index.php");
?>