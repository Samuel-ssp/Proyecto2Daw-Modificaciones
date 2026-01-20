<?php
require_once __DIR__ . "/conexion.php";

class Usuario extends Conexion
{


    public function insertar($nombre, $email, $pass)
    {
        $sql = "INSERT INTO usuarios (nombre, contrasena, email, rol,puntuacion)
                VALUES ('$nombre', '$pass', '$email',    'player', 0)";
        return $this->conexion->query($sql);
    }

    public function login($email)
    {
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado = $this->conexion->query($sql);
        return $resultado->fetch();
    }

    public function obtenerPuntuacion()
    {
        try {
            $sql = "SELECT nombre, puntuacion FROM usuarios WHERE puntuacion > 0 ORDER BY puntuacion DESC";
            $resultado = $this->conexion->query($sql);
            return $resultado->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function actualizarPuntuacion($id, $puntos)
    {
        try {
            // Solo actualizamos si la nueva puntuacion es MAYOR a la antigua
            $sql = "UPDATE usuarios SET puntuacion = :puntos WHERE id_usuario = :id AND puntuacion < :puntos";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':puntos', $puntos);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
