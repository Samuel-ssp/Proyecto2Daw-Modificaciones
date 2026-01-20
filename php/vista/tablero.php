<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoJuego</title>
    <link rel="stylesheet" href="../css/estiloTablero.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
</head>

<body id="tablero">
    <div class="contenedor">
        <img src="../imagenes/tierra.gif" alt="Planeta" class="mundo">
        <!-- Barra de vida -->
        <div class="barra-vida">
            <div class="vida-restante"></div>
            <div id="vida-numero"></div>
        </div>

        <!-- Problemas ambientales -->
        <div class="problemas">
            <div class="carta problema"></div>
            <div class="carta problema"></div>
        </div>

        <!-- Información de carta -->
        <div class="info-carta">
            <div>
                <p><b>Info</b></p>
                <p>Pasa el ratón sobre un Evento para ver su descripción, o selecciona una carta para ver su informacion
                    en detalle</p>
            </div>
        </div>

        <!-- Ronda y turno -->
        <div class="estado-ronda">
            <p id="texto-ronda"></p>
            <p id="texto-turno"></p>
        </div>

        <!-- Cartas del jugador -->
        <div class="mano">
            <div class="carta carta-mano"></div>
            <div class="carta carta-mano"></div>
            <div class="carta carta-mano"></div>
            <div class="carta carta-mano"></div>
            <div class="carta carta-mano"></div>
        </div>

        <!-- Botones de acción -->
        <div class="acciones">
            <button type="button" class="boton-tablero jugar">Jugar Carta</button>
            <button type="button" id="btn-pasar-turno" class="boton-tablero pasar">Pasar Turno</button>
            <a href="index.php?c=Usuario&m=mostrarZonas">
                <button class="boton-tablero Salir">Salir del juego</button>
            </a>
        </div>
    </div>

    <!-- Overlay para el final de partida (Victoria / Derrota) -->
    <div id="overlay-resultado" class="overlay-juego">
        <div class="mensaje-modal">
            <h2 id="titulo-resultado">RESULTADO</h2>
            <div id="icono-resultado" style="font-size: 80px; margin: 20px 0;">🏆</div>
            <p id="mensaje-resultado">Mensaje de resultado</p>
            <p id="puntuacion-resultado" style="font-size: 1.5em; font-weight: bold; color: #ffd700; display: none;">0
                Puntos</p>

            <div class="botones-modal">
                <button onclick="location.reload()" class="boton-tablero jugar">Volver a Jugar</button>
                <a href="index.php?c=Usuario&m=mostrarZonas" class="boton-tablero Salir">Salir al Menú</a>
            </div>
        </div>
    </div>
    <script src="../js/api.js"></script>
    <script src="../js/modelo/motor.js"></script>
    <script src="../js/vista/vJuego.js"></script>
    <script src="../js/app.js"></script>
</body>

</html>