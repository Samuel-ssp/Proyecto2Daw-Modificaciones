<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear icono</title>
    <link rel="stylesheet" href="./css/estiloAdmin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="barra-superior-admin">
        <ul>
            <li><a class="enlace-volver-atras" href="plIconos.php?id=<?php echo $idAdmin; ?>"> ⬅ </a></li>
            <li class="titulo-dashboard"><a href="pMostrarDashboard.php?id=<?php echo $idAdmin; ?>">Dashboard</a></li>
            <li class="perfil-admin">
                <a href="pPerfilAdministrador.php?id=<?php echo $idAdmin; ?>">Hola <?php echo $_SESSION['nombreAdmin']; ?></a>
            </li>
        </ul>
    </nav>

    <main class="mainEstrecho">
        
        <form action="pProcesarCrearIcono.php" method="POST" class="formulario">
            <input type="hidden" name="idAdmin" value="<?php echo $idAdmin; ?>">
            <h1>Crear icono</h1>     
            <label for="">Nombre</label>
            <input type="text" name="nombre" placeholder="Árbol" required>
            
            <label for="">Codigo</label>
            <input type="text" name="codigo" placeholder="🌳" required>

            <div class="seccionBotones">
                <a href="plIconos.php?id=<?php echo $idAdmin; ?>"><button type="button" id="cancelar">Cancelar</button></a>
                <input type="submit" id="modificar" value="Crear"/>
            </div>
        </form>
    </main>

<!-- <script src="jsEvento.js"> -->
<!-- </script> -->
</body>
</html>