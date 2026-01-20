<?php
require_once __DIR__ . '/conexion.php';

class MEvento extends Conexion {
    
   public function listarEventos(){
        // mostramos nombre, nombre icono, nombre zona, daño, turnos
        $sql = "SELECT eventos.id_evento, eventos.nombre, eventos.dano, eventos.turnos_duracion, 
                       zonas.nombre as nombre_zona, iconos.codigo as codigo_icono
                FROM eventos
                LEFT JOIN zonas ON eventos.id_zona = zonas.id_Zona
                LEFT JOIN iconos ON eventos.id_icono = iconos.id_icono";
        try{
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); 
        } catch(PDOException $e){
            return [];
        }
    }

    public function obtenerEvento($idEvento){
        $sql = "SELECT * FROM eventos WHERE id_evento = :id";
        try{
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $idEvento);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e){
            return false;
        }
    }

    public function obtenerZonas(){
         $sql = "SELECT id_Zona, nombre FROM zonas";
         try{
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e){
            return [];
        }
    }

    public function obtenerIconos(){
         $sql = "SELECT id_icono, codigo FROM iconos";
         try{
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e){
            return [];
        }
    }

    public function modificarEvento($idEvento, $nombre, $descripcion, $dano, $turnos_duracion, $id_zona, $id_icono, &$mensaje){
        try{
            $sql = "UPDATE eventos SET nombre = :nombre, descripcion = :descripcion, 
                    dano = :dano, turnos_duracion = :turnos_duracion, 
                    id_zona = :id_zona, id_icono = :id_icono 
                    WHERE id_evento = :id";
            
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':dano', $dano);
            $stmt->bindParam(':turnos_duracion', $turnos_duracion);
            $stmt->bindParam(':id_zona', $id_zona);
            $stmt->bindParam(':id_icono', $id_icono);
            $stmt->bindParam(':id', $idEvento);
            
            if($stmt->execute()){
                return true;
            } else {
                $mensaje = "Error al actualizar evento.";
                return false;
            }

        } catch(PDOException $e){
             $mensaje = "Error BD: " . $e->getMessage();
             return false;
        }
    }
    public function eliminarEvento($idEvento){
        try{
            $sql = "DELETE FROM eventos WHERE id_evento = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $idEvento);
            
            if($stmt->execute()){
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e){
             return false;
        }
    }
    public function crearEvento($nombre, $descripcion, $dano, $turnos_duracion, $id_zona, $id_icono, &$mensaje){
        try{
            $sql = "INSERT INTO eventos (nombre, descripcion, dano, turnos_duracion, id_zona, id_icono) 
                    VALUES (:nombre, :descripcion, :dano, :turnos_duracion, :id_zona, :id_icono)";
            
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':dano', $dano);
            $stmt->bindParam(':turnos_duracion', $turnos_duracion);
            $stmt->bindParam(':id_zona', $id_zona);
            $stmt->bindParam(':id_icono', $id_icono);
            
            if($stmt->execute()){
                return true;
            } else {
                $mensaje = "Error al crear el evento.";
                return false;
            }

        } catch(PDOException $e){
             $mensaje = "Error BD: " . $e->getMessage();
             return false;
        }
    }
}
?>