<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Zonas</title>
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
            <li><a class="enlace-volver-atras" href="../no-mvc/pMostrarDashboard.php"> ⬅ </a></li>
            <li class="titulo-dashboard"><a href="../no-mvc/pMostrarDashboard.php">Dashboard</a></li>
            <li class="perfil-admin"><a href="../no-mvc/pPerfilAdministrador.php">Hola <?php echo $_SESSION['nombreAdmin']; ?></a></li>
        </ul>
    </nav>

    <h1 class="titulo">Gestión de Zonas</h1>

    <div class="contenedor-crear"
        style="width: 85%; max-width: 900px; margin: 0 auto 20px auto; background: none; padding: 0;">
        <a href="index.php?c=Zona&m=mostrarCrear">
            <button class="btn-crear">Crear Zona</button>
        </a>
    </div>

    <main class="contenedor-tabla">
        <table class="tabla">
            <thead>
                <tr>
                    <th>Nombre Zona</th>
                    <th>Imagen Zona</th>
                    <th>Fondo Zona</th>
                    <th>Imagen Carta</th>
                    <th>Imagen Evento</th>
                    <th>Eliminar</th>
                    <th>Modificar</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($datos)) {
                    foreach ($datos as $fila) { ?>
                        <tr>
                            <td><?php echo $fila['nombre']; ?></td>

                            <td>
                                <?php
                                if (!empty($fila['imagenZona'])) {
                                    // Es una ruta, no base64
                                    echo '<img src="' . $fila['imagenZona'] . '" width="50" style="border-radius: 5px;">';
                                } else {
                                    echo "Sin imagen";
                                }
                                ?>
                            </td>

                            <td>
                                <?php
                                if (!empty($fila['fondoZona'])) {
                                    
                                    echo '<img src="' . $fila['fondoZona'] . '" width="50" style="border-radius: 5px;">';
                                } else {
                                    echo "Sin fondo";
                                }
                                ?>
                            </td>

                            <td>
                                <?php
                                if (!empty($fila['imagenCartas'])) {
                                    echo '<img src="' . $fila['imagenCartas'] . '" width="50" style="border-radius: 5px;">';
                                } else {
                                    echo "Sin imagen";
                                }
                                ?>
                            </td>

                            <td>
                                <?php
                                if (!empty($fila['imagenEventos'])) {
                                    echo '<img src="' . $fila['imagenEventos'] . '" width="50" style="border-radius: 5px;">';
                                } else {
                                    echo "Sin imagen";
                                }
                                ?>
                            </td>

                            <td>
                                <a href="index.php?c=Zona&m=confirmarEliminar&id_zona=<?php echo $fila['id_zona']; ?>">
                                    <button class="btn-eliminar">Eliminar</button>
                                </a>
                            </td>
                            <td>
                                <a href="index.php?c=Zona&m=mostrarEditar&id_zona=<?php echo $fila['id_zona']; ?>">
                                    <button class="btn-modificar">Modificar</button>
                                </a>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="7">No hay zonas registradas</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

</body>

</html>