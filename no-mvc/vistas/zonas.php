<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Deckology</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilos.css">
</head>

<body id="zonas">
    <div class="contenedor-menu-zonas">
        <header id="encabezado">
            <h1 id="titulo-encabezado">Deckology</h1>
            <nav id="menu-navegacion">
                <a href="pPerfilUsuario.php">Perfil</a>
                <a href="../php/index.php?c=Usuario&m=obtenerPuntuaciones">Puntuaciones</a>
                <a id="boton-sesion"></a>
            </nav>
        </header>

        <main id="contenido-principal">
            <h2 id="titulo-seleccion">Selecciona un modo de juego</h2>
            <div id="boton-como-jugar">¿Cómo jugar?</div>

            <section id="contenedor-tarjetas">
                <?php
                foreach ($zonas as $zona) {
                    echo "<a href=" . "../php/index.php?c=Juego&m=mostrarJuego&id=" . $zona["id_zona"] . " class=" . "tarjeta" . ">";
                    echo "<img src=" . $zona["imagenZona"] . " alt=" . $zona["nombre"] . ">";
                    echo "<h3 class=" . "titulo-tarjeta" . ">" . $zona["nombre"] . "</h3>";
                    echo "</a>";
                }
                ?>
            </section>

            <!-- Estructura  Popup oculto -->
            <div id="popup-reglas">
                <div id="popup-contenido">
                    <p class="cerrar-popup">Cerrar</p>

                    <h2>¿Cómo se juega?</h2>

                    <p><strong>Objetivo:</strong> Mantener la salud del planeta.</p>

                    <h3>⚠️ Eventos</h3>
                    <p>
                        Los eventos <strong>restaran vida cada turno</strong>.<br>
                        Siguen activos hasta que los <strong>neutralices</strong> con la carta correcta.
                        Apareceran cada <strong>X</strong> turnos.
                    </p>

                    <h3>🃏Cartas</h3>
                    <p>
                        Las cartas sirven para <strong>eliminar eventos</strong> y para <strong>curar</strong>.<br>
                        Cada carta indica <strong>qué evento neutraliza</strong>.<br>
                        Aparte siempre curaran al planeta.<br>
                        Tienes un <strong>límite de cartas en la mano de 5</strong>.
                    </p>

                    <h3>🔄 Turnos y Rondas</h3>
                    <p>Cada <strong> ronda </strong> serán <strong> 3 turnos</strong>.</p>

                    <h3>💡Consejos</h3>
                    <p>
                        • Prioriza los eventos de mayor daño.<br>
                        • No mal gastes cartas que necesites para neutralizar.<br>
                        • Controla los turnos que faltan para la siguiente ronda.
                    </p>
                </div>

        </main>
        <footer>
            Creado por el Grupo 4
        </footer>
    </div>
    </div>
    <script>
        // Inject PHP session state into JS
        window.estaLogueado = <?php echo ($idSession !== 'invitado') ? 'true' : 'false'; ?>;
    </script>
    <script type="module" src="./scripts-js/comojugar.js"></script>
    <script type="module" src="./scripts-js/estalogueado.js"></script>
</body>

</html>