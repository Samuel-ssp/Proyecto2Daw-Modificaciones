<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Modificar Zona</title>
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
        <form class="formulario" action="index.php?c=Zona&m=editar&id_zona=<?php echo $datos['id_zona']; ?>"
            method="POST" enctype="multipart/form-data">

            <h1>MODIFICAR ZONA</h1>

            <label for="nombre">Nombre:</label>
            <input id="nombre" type="text" name="nombre" value="<?php echo $datos['nombre']; ?>" required>
            <br>

            <!-- Imagen Zona -->
            <label>Imagen de la Zona:</label>
            <?php
            if (!empty($datos['imagenZona'])) {
                echo '<div style="text-align:center; margin-bottom:10px;"><img src="data:image/jpeg;base64,' . base64_encode($datos['imagenZona']) . '" width="150" style="border-radius:10px;"></div>';
            } else {
                echo "<p style='text-align:center'>(Sin imagen)</p>";
            }
            ?>
            <input type="file" name="imagenZona">
            <br>

            <!-- Fondo Zona -->
            <label>Fondo de la Zona:</label>
            <?php
            if (!empty($datos['fondoZona'])) {
                echo '<div style="text-align:center; margin-bottom:10px;"><img src="data:image/jpeg;base64,' . base64_encode($datos['fondoZona']) . '" width="150" style="border-radius:10px;"></div>';
                echo '<label><input type="checkbox" name="borrarFondo" value="1" style="display:inline; width:auto;"> Eliminar fondo</label>';
            } else {
                echo "<p style='text-align:center'>(Sin fondo)</p>";
            }
            ?>
            <input type="file" name="fondoZona">
            <br>


            <!-- Carta -->
            <label>Imagen de Carta:</label>
            <?php
            if (!empty($datos['imagenCartas'])) {
                echo '<div style="text-align:center; margin-bottom:10px;"><img src="' . $datos['imagenCartas'] . '" width="150" style="border-radius:10px;"></div>';
            } else {
                echo "<p style='text-align:center'>(Sin imagen)</p>";
            }
            ?>
            <label><input type="checkbox" name="borrarCarta" value="1" style="display:inline; width:auto;"> Eliminar
                imagen de carta</label>
            <input type="file" name="imagenCarta">
            <br>

            <!-- Evento -->
            <label>Imagen de Evento:</label>
            <?php
            if (!empty($datos['imagenEventos'])) {
                echo '<div style="text-align:center; margin-bottom:10px;"><img src="' . $datos['imagenEventos'] . '" width="150" style="border-radius:10px;"></div>';
            } else {
                echo "<p style='text-align:center'>(Sin imagen)</p>";
            }
            ?>
            <label><input type="checkbox" name="borrarEvento" value="1" style="display:inline; width:auto;"> Eliminar
                imagen de evento</label>
            <input type="file" name="imagenEvento">
            <br>

            <div class="seccionBotones">
                <a href="index.php?c=Zona&m=listar"><button type="button" id="cancelar">Cancelar</button></a>
                <input type="submit" id="modificar" value="Actualizar">
            </div>

        </form>
    </main>

</body>

</html>