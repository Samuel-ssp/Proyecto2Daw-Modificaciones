<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de administrador</title>
    <link rel="stylesheet" href="./css/estiloAdmin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>

    <nav class="barra-superior-admin">

        <ul>

            <li class="titulo-dashboard">  
                <a href="pMostrarDashboard.php">Dashboard</a>
            </li>
            <li class="perfil-admin">Hola <?php echo htmlspecialchars($filaAdmin['nombre']); ?></li>
        </ul>
    </nav>
    
    <main class="mainEstrecho">
        <div class="formulario">
            <h1>Perfil de administrador</h1>
            <?php if(isset($mensaje) && !empty($mensaje)): ?>
                <div style="color: red; font-weight: bold; text-align: center;">
                    <?php echo $mensaje; ?>
                </div>
            <?php endif; ?>

            <label>Nombre de usuario</label>
            <input readonly type="text" name="nombre" value="<?php echo htmlspecialchars($filaAdmin['nombre']); ?>" />
            
            <label>Correo electrónico</label>
            <input readonly type="email" name="email" value="<?php echo htmlspecialchars($filaAdmin['email']); ?>" />
            
            <div class="seccionBotones">
                <a href="pVeditarPerfilAdmin.php">
                    <button type="button" id="cancelar">Modificar nombre</button>
                </a>
                
                <a href="pVcontrasenaAdmin.php">
                    <button type="button" id="modificar">Modificar contraseña</button>
                </a>
            </div>
        </div>
    </main>
</body>
</html>