<?php
require_once __DIR__ . "/conexion.php";

class MEvento extends Conexion
{

    public function obtenerEventos()
    {
        try {

            if (isset($_GET["idAntiguo"])) {

                $sql = "SELECT id_evento as id, nombre FROM eventos 
                    WHERE (id_zona = :zona AND esta_en_carta = 0) 
                    OR id_evento = :idAntiguo";
                $stmt = $this->conexion->prepare($sql);

                $stmt->execute([
                    ':zona' => $_GET["zona"],
                    ':idAntiguo' => $_GET["idAntiguo"]
                ]);

            } else {
                $sql = "SELECT id_evento as id, nombre FROM eventos 
                    WHERE id_zona = :zona AND esta_en_carta = 0";

                $stmt = $this->conexion->prepare($sql);

                $stmt->execute([
                    ':zona' => $_GET["zona"],

                ]);
            }
            ;

            return $stmt->fetchAll();

        } catch (PDOException $e) {
            //Si ocurre un error retorno el array vacío par el js
            return [];
        }
    }

    public function crearEventoId()
    {

        try {

            $sql = "INSERT INTO  eventos (nombre,descripcion,dano,turnos_duracion,id_zona,id_icono,esta_en_carta) 
                    VALUES (:nombre,:descripcion,:dano,:turnos_rondas,:id_zona,:id_icono,:esta_en_carta)";
            $stmt = $this->conexion->prepare($sql);

            $stmt->execute([
                ':nombre' => $_POST["nombreEvento"],
                ':descripcion' => $_POST["descripcionEvento"],
                ':dano' => $_POST["danoEvento"],
                ':turnos_rondas' => $_POST["rondasEvento"],
                ':id_zona' => $_POST["zona"],
                ':id_icono' => $_POST["emoticonoEvento"],
                ':esta_en_carta' => 1
            ]);

            return $this->conexion->lastInsertID();

        } catch (PDOException $e) {

            echo "Error: " . $e->getMessage();
        }
    }

    public function modificarEstado($id)
    {
        //Cambiamos el estado de la carta  ejemplos: estado:1 -> 1 - 1 = 0 / estado:0 -> 1 - 0 = 1
        //Siempre cambia el estado
        $sql = "UPDATE eventos 
                SET esta_en_carta = 1 - esta_en_carta
                WHERE id_evento = :id_evento";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ':id_evento' => $id
        ]);
    }

    public function obtenerEventosJuego()
    {
        try {
            $id_zona = isset($_GET["zona"]) ? $_GET["zona"] : 0;

            // Consulta unificada: Siempre traemos el fondo específico
            $sql = "SELECT e.*, i.codigo as codigo_icono, z.imagenEventos as fondo_evento 
                    FROM eventos e 
                    LEFT JOIN iconos i ON e.id_icono = i.id_icono
                    LEFT JOIN zonas z ON e.id_zona = z.id_zona";

            if ($id_zona != 0) {
                $sql .= " WHERE e.id_zona = :id_zona";
            }

            $stmt = $this->conexion->prepare($sql);

            if ($id_zona != 0) {
                $stmt->bindParam(':id_zona', $id_zona);
            }

            $stmt->execute();

            $eventos = $stmt->fetchAll();

            header("Content-Type: application/json");
            // 3. Envía el JSON limpio
            echo json_encode($eventos);
            // Para la ejecucion tras enviar la información para js
            exit();

        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

}
?>