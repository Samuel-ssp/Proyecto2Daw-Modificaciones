<?php
require_once __DIR__ . "/conexion.php";

class MIcono extends Conexion
{

    public function obtenerIconos()
    {
        try {
            // 1. Insertar usuario  PDO
            $sql = "SELECT id_icono as id,nombre,codigo FROM iconos";

            $stmt = $this->conexion->query($sql);

            return $stmt->fetchAll();

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>