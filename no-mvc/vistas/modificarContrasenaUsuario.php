<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modificar contraseña</title>
        <link rel="stylesheet" href="./css/estilos.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    </head>
    <body id="bodyVega">
        <ul id="volverInicio">
            <li>
                <a href="pPerfilUsuario.php?id=<?php echo $idUsuario; ?>">← Volver al perfil</a>
            </li>
        </ul>
        <main id="mainEstrecho">
            <form id="formVega" action="pFuncionContrasenaUsuario.php?id=<?php echo $idUsuario; ?>" method="POST">
                <h1>Modificar contraseña</h1>
                <?php if(isset($mensaje) && !empty($mensaje)): ?>
                    <div style="color: red; font-weight: bold; text-align: center;">
                        <?php echo $mensaje; ?>
                    </div>
                <?php endif; ?>

                <label>Contraseña actual</label>
                <input type="password" name="contrasena_actual" />

                <label>Nueva contraseña</label>
                <input type="password" name="nueva_contrasena" />

                <label>Confirmar contraseña nueva</label>
                <input type="password" name="confirmar_contrasena" />

                <div id="seccionBotones">
                    <a href="pPerfilUsuario.php?id=<?php echo $idUsuario; ?>">
                        <button type="button" id="cancelar">Cancelar</button>
                    </a>
                    <input id="modificar" type="submit" value="Modificar" name="modificar"/>
                </div>
            </form>
        </main>
    </body>
</html>
