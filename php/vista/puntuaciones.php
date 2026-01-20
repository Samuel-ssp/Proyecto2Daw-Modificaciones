<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla de Puntuaciones</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body id="bodyPuntuaciones">
    <ul id="volverInicio">
        <li><a href="index.php?c=Usuario&m=mostrarZonas">← Volver al inicio</a></li>
    </ul>
    <div id="divH1">
        <h1>Puntuaciones</h1>
    </div>
    <main id="mainVega">
        <table id="tablaPuntuaciones">
            <tr>
                <th>Nombre</th>
                <th>Puntuación</th>
                <th></th>
            </tr>
            <?php
            foreach ($datos as $fila) {
                echo "<tr>";
                echo "<td>" . $fila['nombre'] . "</td>";
                echo "<td>" . $fila['puntuacion'] . "</td>";
                echo "<td></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </main>
    <script src="../js/vista/puntuaciones.js"></script>
</body>
</html>