<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Cartas</title>
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

    <h1 class="titulo"> Listar Cartas</h1>

    <div
        style="width: 85%; max-width: 900px; margin: 0 auto 20px auto; display: flex; justify-content: space-between; align-items: center;">
        <a href="index.php?c=Carta&m=mostrarCrearCarta">
            <button class="btn-crear">Crear Carta</button>
        </a>
        <input type="text" id="filtroNombre" placeholder="Buscar carta..."
            style="padding: 10px; border-radius: 8px; border: 1px solid #ccc; width: 300px;">
    </div>

    <main class="contenedor-tabla">

        <table class="tabla" id="tablaCartas">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Zona</th>
                    <th>Curación</th>
                    <th>Efecto</th>
                    <th>Eliminar</th>
                    <th>Modificar</th>
                </tr>
            </thead>

            <tbody>
                <!-- Ejemplos de filas -->
                <?php
                foreach ($datos as $dato) {
                    echo '<tr>
                            <td>'
                        . $dato["icono"] . $dato['nombre'] .
                        '</td>
                            <td>'
                        . $dato['zona'] .
                        '</td>
                            <td>'
                        . $dato['curacion'] .
                        '</td>
                            <td>'
                        . $dato['evento'] .
                        '</td>
                            <td>
                                <button class="btn-eliminar" onclick="confirmarEliminar(\'' . htmlspecialchars($dato['nombre'], ENT_QUOTES) . '\', \'' . $dato['id_carta'] . '\')">Eliminar</button>
                            </td>
                            <td>
                                <a href="index.php?c=Carta&m=mostrarModificarCarta&id=' . $dato['id_carta'] . '">
                                    <button class="btn-modificar">Modificar</button>
                                </a>
                            </td>
                        </tr>';
                }
                ?>
            </tbody>
        </table>
    </main>

    <!-- Estructura del Modal -->
    <div id="modalConfirmacion" class="modal-overlay">
        <div class="modal-contenido">
            <h2>Confirmar eliminación</h2>
            <p>¿Quieres borrar la carta <strong id="nombreCartaBorrar"></strong>?</p>
            <div class="modal-botones">
                <button class="btn-cancelar" onclick="cerrarModal()">Cancelar</button>
                <button class="btn-confirmar" id="btnConfirmarBorrado">Borrar</button>
            </div>
        </div>
    </div>

    <!-- Estilos del Modal movidos a estiloAdmin.css -->

    <script src="../js/vista/lCartas.js"></script>
</body>

</html>