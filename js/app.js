// --- Variables globales ---
let juego;
let vista;

// --- Botones  ---
const btnJugar = document.querySelector('.jugar');
const btnPasar = document.querySelector('.pasar');

// Variable de zona
let zonaActualId = "ciudad";

/**
 * Función de arranque
 */
async function iniciarJuego() {

    // Coger el id de la url
    const parametrosURL = new URLSearchParams(window.location.search);
    zonaActualId = parametrosURL.get('id') || '0';

    // CARGAR DATOS 
    const response = await fetch(`index.php?c=Carta&m=obtenerCartasJuego&zona=${zonaActualId}`);
    const cartasData = await response.json();
    const eventosData = await api.obtenerEventos(zonaActualId);
    const zonasData = await api.obtenerZonas();

    // PREPARAR DATOS
    const zonaObj = zonasData.find(z => z.id == zonaActualId);
    const datosIniciales = {
        zonaInicial: zonaActualId,
        zonaObj: zonaObj, // Pasamos el objeto con las imagenes
        cartas: { [zonaActualId]: cartasData },
        eventos: { [zonaActualId]: eventosData }
    };

    // INICIAR CLASES
    juego = new MotorJuego(datosIniciales);
    vista = new VistaJuego();

    // SET UP INICIAL
    for (let i = 0; i < 5; i++) juego.robarCarta();
    juego.generarEvento();

    // Visualizar
    vista.actualizarInterfaz(juego, eventosData);
}

// ==========================================
// EVENTOS DE LOS BOTONES
// ==========================================

// --- BOTÓN: PASAR TURNO ---
btnPasar.addEventListener('click', () => {
    // Lógica del motor
    const estado = juego.avanzarTurno();

    // Actualizar vista
    vista.actualizarInterfaz(juego, juego.catalogoEventos[zonaActualId]);

    // Comprobar estado del juego
    verificarFinJuego(estado);
});

// --- BOTÓN: JUGAR CARTA ---
btnJugar.addEventListener('click', () => {
    //  Obtener cartas seleccionadas de la vista
    const cartasAJugar = vista.obtenerCartasSeleccionadas();

    cartasAJugar.forEach(carta => {
        juego.usarCarta(carta);
    });

    // Completar turno tras jugar carta
    if (cartasAJugar.length > 0) {
        const estado = juego.avanzarTurno();

        // Comprobar estado del juego
        verificarFinJuego(estado);
    }

    // Limpiar y actualizar vista
    vista.limpiarSeleccion();
    vista.actualizarInterfaz(juego, juego.catalogoEventos[zonaActualId]);
});

// --- Inicio una vez que se carga la página ---
document.addEventListener('DOMContentLoaded', iniciarJuego);

/**
 * Función auxiliar para verificar si el juego ha terminado
 */
function verificarFinJuego(estado) {
    // 1. Comprobar Derrota
    if (juego.vidaPlaneta <= 0) {
        let puntuacionFinal = null;
        if (juego.esInfinito) {
            puntuacionFinal = juego.calcularPuntuacionFinal();
            // Guardar puntuacion si es modo infinito
            api.guardarPuntuacion(puntuacionFinal)
                .then(res => {
                    console.log("Puntuación guardada correctamenmte", res);
                })
                .catch(err => {
                    console.error("Error al guardar puntuación", err);
                });
        }
        vista.mostrarGameOver("GAME OVER", "El ecosistema ha colapsado. ¡Inténtalo de nuevo!", false, puntuacionFinal);
        return;
    }

    // 2. Comprobar Victoria (Solo en modo normal)
    if (estado && estado.victoria) {
        vista.mostrarGameOver("¡VICTORIA!", estado.mensaje, true);
    }
}