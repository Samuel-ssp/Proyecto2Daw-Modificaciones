<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Carta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <li><a class="enlace-volver-atras" href="index.php?c=Carta&m=listarCartas"> ⬅ </a></li>
            <li class="titulo-dashboard"><a href="../no-mvc/pMostrarDashboard.php">Dashboard</a></li>
            <li class="perfil-admin"><a href="../no-mvc/pPerfilAdministrador.php">Hola <?php echo $_SESSION['nombreAdmin']; ?></a></li>
        </ul>
    </nav>

    <main class="mainEstrecho">

        <form action="index.php?c=Carta&m=modificarCarta&id=<?= $_GET["id"] ?>" method="POST" class="formulario">

            <h1>MODIFICAR CARTA</h1>
            <label for="">Zona</label>
            <select name="zona" id="zonaSelect" require>
                <option value="">Seleccionar zona</option>
                <?php
                // ID zona de la carta
                $id_zona_carta = $datos["carta"]["id_zona"];

                foreach ($datos["zonas"] as $dato) {
                    // Si el id coninciden se quedara seleccionado
                    $seleccionado = ($dato["id"] == $id_zona_carta) ? 'selected' : '';
                    echo '<option value="' . $dato["id"] . '"' . $seleccionado . '>' . $dato["nombre"] . '</option>';
                }
                ?>
            </select>
            <!-- Campos ocultos  -->
            <input type="hidden" name="creandoEventoNuevo" id="creandoEventoNuevo" value="0" />
            <input type="hidden" name="idEventoAntiguo" id="idEventoAntiguo"
                value="<?= $datos["carta"]["elimina_id_evento"] ?>" />
            <label for="">Evento</label>
            <div class="evento-selector">
                <select name="evento" id="eventoSelect">
                    <option value="">Seleccionar evento</option>
                </select>
                <!-- type button para que no lo confunda con submit -->
                <button type="button" class="btn-crear-evento" id="btnCrearEvento">Crear evento</button>
            </div>

            <!-- Formulario para crear un nuevo evento (oculto por defecto) -->
            <div id="formularioEventoNuevo">
                <h2>CREAR EVENTO</h2>
                <label for="nombreEvento">Nombre</label>
                <input type="text" name="nombreEvento" id="nombreEvento">

                <label for="descripcionEvento">Descripción</label>
                <input type="text" name="descripcionEvento" id="descripcionEvento">

                <label for="danoEvento">Daño</label>
                <input type="number" name="danoEvento" id="danoEvento">

                <label for="rondasEvento">Rondas</label>
                <input type="number" name="rondasEvento" id="rondasEvento">

                <label for="emoticonoEvento">Emoticono</label>
                <select name="emoticonoEvento" id="emoticonoEvento">
                    <option value="">Selecciona un emoticono</option>
                    <?php
                    foreach ($datos["iconos"] as $dato) {
                        echo '<option value="' . $dato["id"] . '">' . $dato["codigo"] . $dato["nombre"] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="<?= $datos["carta"]["nombre"] ?>" require>

            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion" value="<?= $datos["carta"]["descripcion"] ?>" require>

            <label for="curacion">Curación</label>
            <input type="text" name="curacion" value="<?= $datos["carta"]["curacion"] ?>" require>

            <label for="emoticono">Emoticono</label>
            <select name="emoticono">
                <option value="">Selecciona un emoticono</option>
                <?php
                // ID icono de la carta
                $id_icono_carta = $datos["carta"]["id_icono"];

                foreach ($datos["iconos"] as $dato) {
                    // Si el id coninciden se quedara seleccionado
                    $seleccionado = ($dato["id"] == $id_icono_carta) ? 'selected' : '';
                    echo '<option value="' . $dato["id"] . '"' . $seleccionado . '>' . $dato["codigo"] . $dato["nombre"] . '</option>';
                }
                ?>
            </select>

            <div class="seccionBotones">
                <input id="eliminar" type="button" value="Eliminar" />
                <a href="index.php?c=Carta&m=listarCartas"><button type="button" id="cancelar">Cancelar</button></a>
                <input type="submit" id="modificar" value="Modificar" />
            </div>

        </form>
    </main>
    <!-- MODAL CONFIRMACIÓN ELIMINAR -->
    <div id="modalConfirmacion" class="modal-overlay">
        <div class="modal-contenido">
            <h2>¿Quieres eliminar la carta <?= $datos["carta"]["nombre"] ?>?</h2>
            <p>Vas a eliminar esta carta permanentemente.</p>
            <div class="modal-botones">
                <button class="btn-cancelar" id="btnCancelarModal">Cancelar</button>
                <button class="btn-confirmar" id="btnConfirmarBorrado">Borrar</button>
            </div>
        </div>
    </div>
    <script src="../js/vista/modificar_cartas.js"></script>
    </script>
</body>

</html>