<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar perfil</title>
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
        <form class="formulario" method="POST" action="pFuncionEditarPerfilAdmin.php">
            <input type="hidden" name="idAdmin" value="<?php echo $idAdmin; ?>">
            <h1>Editar perfil</h1>
            <?php if(isset($mensaje) && !empty($mensaje)){
                echo '<div style="color: red; font-weight: bold; text-align: center;">'.$mensaje.'</div>';
            } ?>

            <label>Nombre de usuario</label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($filaAdmin['nombre']); ?>" />
            
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