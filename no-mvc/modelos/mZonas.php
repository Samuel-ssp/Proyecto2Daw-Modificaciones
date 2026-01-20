<?php
    require_once 'conexion.php';

    class MZonas extends Conexion {

        public function listar() {
            try{
                $sql="SELECT * FROM zonas";
                $stmt = $this->conexion->query($sql);
                return $stmt->fetchAll();
            }catch(PDOException $e){
                echo "Error: ".$e->getMessage();
                return false;
            }
        }
    }

?>