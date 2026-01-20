<?php

    require_once __DIR__ . '/../modelos/mZonas.php';

    class CZonas {
        private $modelo;

        public function __construct(){
            $this->modelo = new MZonas();
        }

        function vistaZonas($idUsuario){
            $zonas = $this->modelo->listar();
            $idSession = $idUsuario; // Ensure variable name matches view expectation
            include __DIR__ . "/../vistas/zonas.php";
        }
    }

?>