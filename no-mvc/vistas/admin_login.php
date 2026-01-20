<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Deckology - Acceso Administrador</title>
    <link rel="stylesheet" href="./css/estiloAdmin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>   
    <nav class="barra-superior-admin">
        <ul>
            <li><a class="enlace-volver-atras" href="pAcceso.php"> ⬅ </a></li>
            <li class="titulo-dashboard">Deckology</li>
            <li class="perfil-admin">ADMIN</li>
        </ul>
    </nav>

    <main class="mainEstrecho">
        <form class="formulario" action="pFuncionLoginAdmin.php" method="POST">

            <img src="./img/candado-admin-provisional.jpg" alt="Icono de Acceso Restringido" class="imagen-aviso-admin">
            <h1>Acceso Administrador</h1>

            <?php if(isset($mensaje) && !empty($mensaje)): ?>
                    <p style="color: red; font-weight: bold; text-align: center;">
                        <?php echo $mensaje; ?>
                    </p>
            <?php endif; ?>

            <p id="alerta">
                ⚠️ Área restringida - Solo personal autorizado
            </p>

            <label>Email:</label>
            <input type="email" name="email" />

            <label>Contraseña:</label>
            <input type="password" name="password"/>
            
            <input id="acceder" type="submit" value="Acceder al panel"/>
            
        </form>
    </main>
</body>
</html>