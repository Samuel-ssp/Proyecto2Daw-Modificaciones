<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Zona</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>

    <h2>¿Seguro que deseas eliminar la zona?</h2>

    <p><strong><?php echo $datos['nombre']; ?></strong></p>

    <a class="btn btn-eliminar" href="index.php?c=Zona&m=eliminar&id_zona=<?php echo $datos['id_zona']; ?>">
        Eliminar
    </a>

    <a class="btn btn-editar" href="index.php?c=Zona&m=listar">
        Cancelar
    </a>

</body>

</html>