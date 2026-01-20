class MotorJuego {

    constructor(datosDelJuego) {
        // Cargamos todos los datos (el catálogo completo)
        this.catalogoCartas = datosDelJuego.cartas;
        this.catalogoEventos = datosDelJuego.eventos;

        // Zona actual (para saber de qué lista sacar cartas)
        this.zonaActual = datosDelJuego.zonaInicial; // "ciudad" o ID
        this.zonaObj = datosDelJuego.zonaObj; // Objeto con imagenes de la zona

        // Configuración
        this.config = {
            vidaMaxima: 100,
            cartasManoMax: 5,
            turnosParaRobar: 1,  // Cada 1 turno se roba
            turnosEvento: 2,      // Cada 2 turnos sale evento
            limiteRondas: 4,      // Límite para ganar en modo normal
            turnosParaAumentarDificultad: 5, // Configuración dificultad infinita: Frecuencia
            cantidadAumentoDano: 5  // Configuración dificultad infinita: Cantidad de daño extra
        };

        // Detectar Modo Infinito
        // La zona 0 o el ID "0" activa el modo infinito
        this.esInfinito = (this.zonaActual == 0 || this.zonaActual == "0");
        this.danoExtra = 0; // Aumentará en modo infinito

        // Estado dinámico
        this.turnoTotal = 1;     // Contador global de turnos
        this.vidaPlaneta = this.config.vidaMaxima;
        this.mano = [];          // Tus cartas actuales
        this.eventosActivos = []; // Los problemas actuales en pantalla
        this.eventosSuperados = 0; // Contador de problemas resueltos (puntuacion)

        // Búfer de curación del turno
        this.curacionTurno = 0;
    }

    avanzarTurno() {
        this.turnoTotal++;

        // CALCULO DE RONDA (Cada 3 turnos = 1 ronda)
        const ronda = Math.ceil(this.turnoTotal / 3);

        // 0. COMPROBAR VICTORIA (Solo modo normal)
        if (!this.esInfinito && ronda > this.config.limiteRondas) {
            return {
                victoria: true,
                mensaje: "¡Has completado todas las rondas! El planeta está a salvo."
            };
        }

        // MODO INFINITO: Aumentar dificultad cada X turnos
        if (this.esInfinito) {
            // Cada 5 turnos, +5 de daño extra a los nuevos eventos
            // Aumentar daño cada X turnos (Configurable)
            if (this.turnoTotal % this.config.turnosParaAumentarDificultad === 0) {
                this.danoExtra += this.config.cantidadAumentoDano;
                console.log(`[INFINITO] ¡La dificultad aumenta! Daño extra: +${this.danoExtra}`);
            }
        }

        // 1. APLICAR DAÑOS DE EVENTOS (De los eventos que YA estaban)
        this.aplicarDaños();

        // 2. GENERAR EVENTO (Cada X turnos)
        // Lo hacemos DESPUES del daño para que el nuevo evento no te ataque en el mismo turno que sale
        if (this.turnoTotal % this.config.turnosEvento === 0) {
            this.generarEvento();
        }

        // 3. ROBAR CARTA (Cada X turnos)
        if (this.turnoTotal % this.config.turnosParaRobar === 0) {
            this.robarCarta();
        }

        // 4. REDUCIR DURACIÓN DE EVENTOS
        // (Opcional: Si quieres que los eventos se vayan solos tras X turnos)
        this.eventosActivos.forEach(evento => {
            evento.duracionTurnos--;
        });
        // Filtramos los que ya no tienen duración
        this.eventosActivos = this.eventosActivos.filter(e => e.duracionTurnos > 0);

        return {
            turno: this.turnoTotal,
            vida: this.vidaPlaneta,
            eventos: this.eventosActivos.length,
            esInfinito: this.esInfinito,
            danoExtra: this.danoExtra
        };
    }

    // [Rest of methods start here...]
    robarCarta() {
        if (this.mano.length < this.config.cartasManoMax) {
            // 1. Obtenemos la lista de cartas posibles de la zona actual
            const listaPosible = this.catalogoCartas[this.zonaActual];

            // 2. Elegimos una al azar
            const cartaAleatoria = listaPosible[Math.floor(Math.random() * listaPosible.length)];

            // Logica recursiva del usuario para evitar duplicados
            if (!this.mano.find(carta => carta.id_carta === cartaAleatoria.id_carta)) {
                // 3. La añadimos a la mano
                this.mano.push({ ...cartaAleatoria });
                console.log(`[+] Has robado: ${cartaAleatoria.nombre}`);
            } else {
                // Si la carta ya la tengo, intentamos robar otra
                this.robarCarta();
            }
        }
    }

    // --- FUNCIÓN PARA JUGAR CARTAS ---
    usarCarta(carta) {
        console.log(`[DEBUG] --- USAR CARTA: ${carta.nombre} ---`);
        console.log(`[DEBUG] Vida antes de curar: ${this.vidaPlaneta}`);

        // 1. Acumular Curación (No aplicar directament)
        let puntosCura = parseInt(carta.curacion) || 0;
        console.log(`[DEBUG] Puntos de curación añadidos al acumulado: ${puntosCura}`);

        this.curacionTurno += puntosCura;
        console.log(`[DEBUG] Curación acumulada turno: ${this.curacionTurno}`);

        // Eliminar evento si existe
        const idEventoAEliminar = carta.elimina_id_evento || carta.efecto;

        if (idEventoAEliminar) {
            // Buscamos si existe el evento que esta carta destruye (usando id_evento o id)
            const indiceEvento = this.eventosActivos.findIndex(e => (e.id_evento || e.id) == idEventoAEliminar);

            if (indiceEvento !== -1) {
                console.log(`[DEBUG] ¡Evento eliminado! ID: ${idEventoAEliminar}`);
                // Si existe, se elimina del array
                this.eventosActivos.splice(indiceEvento, 1);

                // Puntuación: Aumentamos contador de eventos superados
                this.eventosSuperados++;

            } else {
                console.log(`[DEBUG] No se encontró el evento activo con ID: ${idEventoAEliminar}`);
            }
        }

        // Quitar la carta de la mano
        // Filtrar para quedarnos con todas MENOS la que acabamos de jugar
        // IMPORTANTE: Usar id_carta o id según lo que llegue
        this.mano = this.mano.filter(c => (c.id_carta || c.id) !== (carta.id_carta || carta.id));
    }

    generarEvento() {
        // 1. Obtenemos lista de eventos de la zona
        const listaEventos = this.catalogoEventos[this.zonaActual];

        // 2. Elegimos uno al azar
        const eventoAleatorio = listaEventos[Math.floor(Math.random() * listaEventos.length)];

        // 3. Comprobar duplicados en la lista de eventos activos
        // Usamos id_evento (o id si viene del json directo)
        const yaExiste = this.eventosActivos.some(e =>
            (e.id_evento || e.id) === (eventoAleatorio.id_evento || eventoAleatorio.id)
        );

        if (!yaExiste) {
            // 4. Si no existe, lo añadimos
            let danoFinal = parseInt(eventoAleatorio.dano) + (this.danoExtra || 0);

            this.eventosActivos.push({
                ...eventoAleatorio,
                duracionTurnos: parseInt(eventoAleatorio.turnos_duracion),
                daño: danoFinal
            });

            console.log(`[!] Nuevo evento: ${eventoAleatorio.nombre} (Daño: ${danoFinal})`);
        } else {
            // Comprobar que el mismo numero de eventos distintos de los que existe y genere un bucle infinito
            if (this.eventosActivos.length < listaEventos.length) {
                console.log(`[Generar otro evento] Evento repetido (${eventoAleatorio.nombre}), buscando otro...`);
                this.generarEvento();
            } else {
                console.log("[Info] Todos los eventos de esta zona ya están activos.");
            }
        }
    }

    aplicarDaños() {
        let dañoTotalTurno = 0;

        // Snapshot de los eventos al inicio de la fase de daño
        // Esto asegura que si se genera un evento nuevo durante este proceso, no se cuente
        const eventosParaCalculo = [...this.eventosActivos];

        eventosParaCalculo.forEach(evento => {
            console.log(`[DEBUG] Evento: ${evento.nombre}, DB_dano: ${evento.dano}, Internal_daño: ${evento.daño}`);

            if (isNaN(evento.daño)) {
                evento.daño = parseInt(evento.dano) || 0;
            }
            dañoTotalTurno += evento.daño;
        });
        console.log(`[DEBUG] Daño Total Bruto: ${dañoTotalTurno}`);
        console.log(`[DEBUG] Curación Acumulada: ${this.curacionTurno}`);

        // LÓGICA DE ESCUDO / BALANCE
        // Restamos el daño de la curación acumulada
        // Si hay mas curación que daño, curamos la diferencia
        // Si hay mas daño que curación, restamos vida

        // Calculamos el balance neto
        // Positivo = Cartas = Curamos | Eventos = Daño
        let balance = this.curacionTurno - dañoTotalTurno;

        if (balance > 0) {
            // Sobró curación -> Curamos al planeta
            this.vidaPlaneta += balance;
            console.log(`[Turno] Balance POSITIVO. Se cura ${balance} puntos.`);
        } else {
            // Faltó curación (o fue 0) -> El balance es negativo o 0, lo sumamos (como resta)
            // balance es -30, vida += -30
            this.vidaPlaneta += balance;
            console.log(`[Turno] Balance NEGATIVO. Se recibe ${Math.abs(balance)} puntos de daño.`);
        }

        // Resetear acumulado
        this.curacionTurno = 0;

        // Limites de Vida
        if (this.vidaPlaneta > this.config.vidaMaxima) {
            this.vidaPlaneta = this.config.vidaMaxima;
        }
        if (this.vidaPlaneta < 0) {
            this.vidaPlaneta = 0;
        }

        console.log(`[Fin Turno] Vida Planeta: ${this.vidaPlaneta}`);
    }

    /**
     * Calcula la puntuación final con aleatoriedad para que no sean numeros iguales
     * Fórmula base: (Turnos x 10) + (Eventos x 50)
     */
    calcularPuntuacionFinal() {
        // Randomizar valores para que no sea exacto
        // Turnos: Entre 8 y 12 puntos (Base 10)
        const valorTurno = Math.floor(Math.random() * 5) + 8;

        // Eventos: Entre 45 y 55 puntos (Base 50)
        const valorEvento = Math.floor(Math.random() * 11) + 45;

        const puntosTurnos = this.turnoTotal * valorTurno;
        const puntosEventos = this.eventosSuperados * valorEvento;

        const total = puntosTurnos + puntosEventos;

        console.log(`[Puntuacion] Turnos: ${this.turnoTotal} x ${valorTurno} = ${puntosTurnos}`);
        console.log(`[Puntuacion] Eventos: ${this.eventosSuperados} x ${valorEvento} = ${puntosEventos}`);
        console.log(`[Puntuacion] Total: ${total}`);

        return total;
    }
};