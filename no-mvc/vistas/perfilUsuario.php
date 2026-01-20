<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Perfil de usuario</title>
        <link rel="stylesheet" href="./css/estilos.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    </head>
    <body id="bodyVega">
        <ul id="volverInicio">
            <li>
                <a href="pMostrarZonas.php?id=<?php echo $idUsuario; ?>">← Volver al inicio</a>
            </li>
        </ul>
        <main id="mainEstrecho">
            <form id="formVega" method="POST">
                <h1>Perfil de usuario</h1>
                <?php if(isset($mensaje) && !empty($mensaje)): ?>
                    <div style="color: red; font-weight: bold; text-align: center;">
                        <?php echo $mensaje; ?>
                    </div>
                <?php endif; ?>

                <label>Nombre de usuario</label>
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($filaUsuario['nombre'] ?? ''); ?>" readonly/>

                <label>Correo electrónico</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($filaUsuario['email'] ?? ''); ?>" readonly/>



                <label>Puntuación</label>
                <input type="text" value="<?php echo htmlspecialchars($filaUsuario['puntuacion'] ?? '0'); ?>" readonly/>

                <div id="seccionBotones">
                    <!-- Boton Izquierda: Editar Perfil (Nombre) -->
                    <a href="pVeditarPerfilUsuario.php">
                         <button type="button" id="cancelar">Editar perfil</button>
                    </a>
                    
                    <!-- Boton Derecha: Modificar Contraseña -->
                    <a href="pVcontrasenaUsuario.php">
                        <input id="modificar" type="button" value="Modificar contraseña" />
                    </a>
                </div>
            </form>
        </main>
    </body>
</html>