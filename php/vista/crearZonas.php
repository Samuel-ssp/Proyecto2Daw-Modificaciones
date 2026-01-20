<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Zona</title>
    <link rel="stylesheet" href="../css/estiloAdmin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
</head>

<body>
    <nav class="barra-superior-admin">
        <ul>
            <li><a class="enlace-volver-atras" href="index.php?c=Zona&m=listar"> ⬅ </a></li>
            <li class="titulo-dashboard"><a href="../no-mvc/pMostrarDashboard.php">Dashboard</a></li>
            <li class="perfil-admin"><a href="../no-mvc/pPerfilAdministrador.php">Hola <?php echo $_SESSION['nombreAdmin']; ?></a></li>
        </ul>
    </nav>

    <main class="mainEstrecho">
        <form class="formulario" action="index.php?c=Zona&m=crear" method="POST" enctype="multipart/form-data">

            <h1>CREAR ZONA</h1>

            <label for="nombre">Nombre:</label>
            <input id="nombre" type="text" name="nombre" required>
            <br>

            <label>Imagen Zona:</label>
            <input type="file" name="imagenZona">
            <br>

            <label>Fondo Zona:</label>
            <input type="file" name="fondoZona">
            <br>

            <label>Imagen Carta:</label>
            <input type="file" name="imagenCarta">
            <br>

            <label>Imagen Evento:</label>
            <input type="file" name="imagenEvento">
            <br>

            <div class="seccionBotones">
                <a href="index.php?c=Zona&m=listar"><button type="button" id="cancelar">Cancelar</button></a>
                <input type="submit" id="modificar" value="Guardar">
            </div>

        </form>
    </main>

</body>

</html>