<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Carta</title>
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

        <form action="index.php?c=Carta&m=crearCarta" method="POST" class="formulario">

            <h1>CREAR CARTAS</h1>
            <label for="">Zona</label>
            <select name="zona" id="zonaSelect" require>
                <option value="">Seleccionar zona</option>
                <?php
                foreach ($datos["zonas"] as $dato) {
                    echo '<option value="' . $dato["id"] . '">' . $dato["nombre"] . '</option>';
                }
                ?>
            </select>
            <input type="hidden" name="creandoEventoNuevo" id="creandoEventoNuevo" value="0" />
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
            <input type="text" name="nombre" require>

            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion" require>

            <label for="curacion">Curación</label>
            <input type="text" name="curacion" require>

            <label for="emoticono">Emoticono</label>
            <select name="emoticono">
                <option value="">Selecciona un emoticono</option>
                <?php
                foreach ($datos["iconos"] as $dato) {
                    echo '<option value="' . $dato["id"] . '">' . $dato["codigo"] . $dato["nombre"] . '</option>';
                }
                ?>
            </select>

            <div class="seccionBotones">
                <input id="eliminar" type="reset" value="Reiniciar" />
                <a href="index.php?c=Carta&m=listarCartas"><button type="button" id="cancelar">Cancelar</button></a>
                <input type="submit" id="modificar" value="Crear" />
            </div>

        </form>
    </main>
    <script src="../js/vista/crear_cartas.js"></script>
</body>
</html>