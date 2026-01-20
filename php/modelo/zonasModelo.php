<?php
require_once __DIR__ . "/conexion.php";

class Zona extends Conexion
{


    public function obtenerZona($id)
    {
        $sql = "SELECT * FROM zonas WHERE id_zona = $id";
        $resultado = $this->conexion->query($sql);
        return $resultado->fetch();
    }

    public function obtenerZonas()
    {
        $sql = "SELECT z.id_zona, z.nombre,
                       z.imagenZona, z.imagenCartas, z.imagenEventos, z.fondoZona,
                       COUNT(DISTINCT c.id_carta) AS NumCartas,
                       COUNT(DISTINCT e.id_evento) AS NumEventos
                FROM zonas z
                LEFT JOIN cartas c ON z.id_zona = c.id_zona
                LEFT JOIN eventos e ON z.id_zona = e.id_zona
                GROUP BY z.id_zona, z.nombre";
        $resultado = $this->conexion->query($sql);
        return $resultado->fetchAll();
    }

    public function insertar($nombre, $imagenZona, $fondoZona, $imagenCarta, $imagenEvento)
    {
        $sql = "INSERT INTO zonas (nombre, imagenZona, fondoZona, imagenCartas, imagenEventos)
                VALUES ('$nombre', '$imagenZona', '$fondoZona', '$imagenCarta', '$imagenEvento')";
        return $this->conexion->query($sql);
    }

    public function actualizar($id, $nombre, $imagenZona = null, $fondoZona = null, $imagenCarta = null, $imagenEvento = null)
    {
        $sql = "UPDATE zonas SET nombre = '$nombre'";

        if ($imagenZona !== null)
            $sql .= ", imagenZona = '$imagenZona'";
        if ($fondoZona !== null)
            $sql .= ", fondoZona = '$fondoZona'";
        if ($imagenCarta !== null)
            $sql .= ", imagenCarta = '$imagenCarta'";
        if ($imagenEvento !== null)
            $sql .= ", imagenEvento = '$imagenEvento'";

        $sql .= " WHERE id_zona = $id";
        return $this->conexion->query($sql);
    }

    public function eliminar($id)
    {
        $sql = "DELETE FROM zonas WHERE id_zona = $id";
        return $this->conexion->query($sql);
    }

    ///SAMUEL
    public function obtenerZonasTodas()
    {
        try {
            // 1. Insertar usuario  PDO
            $sql = "SELECT id_Zona as id, nombre, imagenZona, imagenCartas, imagenEventos, fondoZona FROM zonas";

            $stmt = $this->conexion->query($sql);

            return $stmt->fetchAll();

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;

        }
    }
}
