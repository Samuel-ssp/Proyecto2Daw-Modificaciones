<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar icono</title>
    <link rel="stylesheet" href="./css/estiloAdmin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="barra-superior-admin">
        <ul>
            <li><a class="enlace-volver-atras" href="plIconos.php"> ⬅ </a></li>
            <li class="titulo-dashboard"><a href="pMostrarDashboard.php">Dashboard</a></li>
            <li class="perfil-admin">
                <a href="pPerfilAdministrador.php">Hola <?php echo $_SESSION['nombreAdmin']; ?></a>
            </li>
        </ul>
    </nav>

    <main class="mainEstrecho">
        
        <form action="pProcesarModificarIcono.php?id=<?=$_GET["id"]?>" method="POST" class="formulario">
            <h1>Modificar icono</h1>     
            <label for="">Nombre</label>
            <input type="text" name="nombre" value="<?= $icono["nombre"]?>" required>
            
            <label for="">Codigo</label>
            <input type="text" name="codigo" value="<?= $icono["codigo"]?>" required>

            <div class="seccionBotones">
                <a href="pEliminarIconos.php?id=<?=$_GET["id"]?>"><button type="button" class="btn-eliminar">Eliminar</button></a>
                <a href="plIconos.php"><button type="button" id="cancelar">Cancelar</button></a>
                <button type="submit" class="btn-modificar" id="modificar">Modificar</button>
            </div>
        </form>
    </main>

<script src="jsEvento.js">
</script>
</body>
</html>