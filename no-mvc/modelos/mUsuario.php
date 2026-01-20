<?php
require_once __DIR__ . '/conexion.php';

class MUsuarios extends Conexion {
    
    public function listarUsuarios(){
        $sql = 'SELECT * FROM usuarios';
        try{
            $resultado = $this->conexion->query($sql);
            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e){
            throw $e;
        }
    }

    public function obtenerUsuarioPorId($usuario_id){
        $sql = 'SELECT * FROM usuarios WHERE id = ?';
        try{
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([$usuario_id]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch(PDOException $e){
            throw $e;
        }
    }

    public function modificarUsuario($id, $nombre, $email, $password = null){
        if ($password) {
            $sql = 'UPDATE usuarios SET nombre = ?, email = ?, password = ? WHERE id = ?';
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $parametros = [$nombre, $email, $hash, $id];
        } else {
            $sql = 'UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?';
            $parametros = [$nombre, $email, $id];
        }
        
        try{
            $stmt = $this->conexion->prepare($sql);
            $resultado = $stmt->execute($parametros);
            return $resultado;
        } catch(PDOException $e){
            throw $e;
        }
    }

    public function eliminarUsuario($usuario_id){
        $sql = 'DELETE FROM usuarios WHERE id = ?';
        try{
            $stmt = $this->conexion->prepare($sql);
            $resultado = $stmt->execute([$usuario_id]);
            return $resultado;
        } catch(PDOException $e){
            throw $e;
        }
    }
    
    public function crearUsuario($nombre, $email, $password){
        $sql = 'INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)';
        try{
            $stmt = $this->conexion->prepare($sql);
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $parametros = [$nombre, $email, $hash];
            $resultado = $stmt->execute($parametros);
            return $resultado;
        } catch(PDOException $e){
            throw $e;
        }
    }

    public function mostrarUsuarioPerfil($idUsuario){
        $sql = 'SELECT nombre, email,puntuacion FROM usuarios WHERE id_Usuario = :id';
        try{
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $idUsuario);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        } catch(PDOException $e){
            return false;
        }
    }

    public function modificarContrasenaUsuario($usuario_id, $contrasena_actual, $nueva_contrasena, &$mensaje = ""){
        try{

            $sql_verificar = 'SELECT contrasena FROM usuarios WHERE id_Usuario = :id';
            $stmt = $this->conexion->prepare($sql_verificar);
            $stmt->bindParam(':id', $usuario_id);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if(!$usuario) {
                $mensaje = "Usuario no encontrado";
                return false;
            }
            
           if(!password_verify($contrasena_actual, $usuario['contrasena'])) {
                $mensaje = "Error: Contraseña actual incorrecta";
                return false;
            } 
            
            $nueva_contrasena_hash = password_hash($nueva_contrasena, PASSWORD_DEFAULT);
            
            $sql_modificar = 'UPDATE usuarios SET contrasena = :nueva WHERE id_Usuario = :id';
            $stmt2 = $this->conexion->prepare($sql_modificar);
            $stmt2->bindParam(':nueva', $nueva_contrasena_hash);
            $stmt2->bindParam(':id', $usuario_id);
            
            if($stmt2->execute()){
                return true;
            } else {
                $mensaje = "Error al actualizar en la base de datos";
                return false;
            }
            
        } catch(PDOException $e){
            $mensaje = "Error en la base de datos: " . $e->getMessage();
            return false;
        }
    }

    public function modificarPerfilUsuario($usuario_id, $nombre, &$mensaje = ""){
        try{
            $sql_modificar = 'UPDATE usuarios SET nombre = :nombre WHERE id_Usuario = :id';
            $stmt = $this->conexion->prepare($sql_modificar);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':id', $usuario_id);
            
            if($stmt->execute()){
                return true;
            } else {
                $mensaje = "Error al actualizar el perfil";
                return false;
            }
            
        } catch(PDOException $e){
            $mensaje = "Error en la base de datos: " . $e->getMessage();
            return false;
        }
    }
}
?>