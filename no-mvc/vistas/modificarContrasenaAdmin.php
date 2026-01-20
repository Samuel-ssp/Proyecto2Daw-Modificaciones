<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modificar contraseña</title>
        <link rel="stylesheet" href="./css/estiloAdmin.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    </head>
    <body>

        <nav class="barra-superior-admin">
            <ul>
                
                <li><a class="enlace-volver-atras" href="pPerfilAdministrador.php"> ⬅ </a></li>
                <li class="titulo-dashboard">
                    
                    <a href="pMostrarDashboard.php">Dashboard</a>
                </li>
                
                <a href="pPerfilAdministrador.php">
                    <li class="perfil-admin">ADMIN</li> <!--Cambiar css de aca y botones-->
                </a>
            </ul>
        </nav>
        <main class="mainEstrecho">
            <form class="formulario" action="pFuncionContrasenaAdmin.php" method="POST">
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

                <div class="seccionBotones">
                    <a href="pPerfilAdministrador.php">
                        <button type="button" id="cancelar">Cancelar</button>
                    </a>
                    <input id="modificar" type="submit" value="Modificar" name="modificar"/>
                </div>
            </form>
        </main>
    </body>
</html>