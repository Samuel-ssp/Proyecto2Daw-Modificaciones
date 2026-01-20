class VistaJuego {
    constructor() {
        // Referencias al HTML 
        this.contenedorMano = document.querySelector('.mano');
        this.contenedorEventos = document.querySelector('.problemas');
        this.contenedorInfo = document.querySelector('.info-carta');
        this.barraVida = document.querySelector('.vida-restante');
        this.textoVida = document.getElementById('vida-numero');
        this.textoRonda = document.getElementById('texto-ronda');
        this.textoTurno = document.getElementById('texto-turno');

        // Contenedor principal
        this.contenedorPrincipal = document.querySelector('.contenedor');

        // Cartas selecionadas
        this.cartasSeleccionadas = [];

        // Datos de la zona (se llenará al inicio)
        this.zonaObj = null;

        // Eventos actuales
        this.catalogoEventosActual = [];
    }

    /**
     * Dibuja todo el estado del juego en la pantalla
     */
    actualizarInterfaz(estado, catalogoEventos) {
        // Guardamos catálogo
        this.catalogoEventosActual = catalogoEventos;

        // Fondo de zona
        if (estado.zonaObj) {
            this.zonaObj = estado.zonaObj;
            if (estado.zonaObj) {
                this.zonaObj = estado.zonaObj;

                let rutaFondo = this.zonaObj.fondoZona || this.zonaObj.imagenZona;


                if (rutaFondo) {
                    this.contenedorPrincipal.style.backgroundImage = `url('${rutaFondo}')`;
                }
            }
        }

        // 1. Actualizar Vida
        this.actualizarVida(estado.vidaPlaneta);

        // 2. Actualizar Textos
        // Calcular Ronda (Cada 3 turnos es una ronda)
        let ronda = Math.ceil(estado.turnoTotal / 3);
        // Calcular Turno dentro de la ronda (1, 2 o 3)
        let turnoDeRonda = (estado.turnoTotal - 1) % 3 + 1;
        this.textoRonda.innerText = "Ronda: " + ronda;
        this.textoTurno.innerText = "Turno: " + turnoDeRonda + "/3";

        // 3. Dibujar Mano
        this.contenedorMano.innerHTML = '';
        estado.mano.forEach(carta => {
            this.crearElementoCarta(carta);
        });

        // 4. Dibujar Eventos Activos
        this.contenedorEventos.innerHTML = '';
        estado.eventosActivos.forEach(evento => {
            this.crearElementoEvento(evento);
        });

        // 5. Refrescar panel de info
        this.actualizarPanelInfo();
    }

    actualizarVida(valor) {
        let ancho = valor;
        if (ancho < 0) ancho = 0;
        if (ancho > 100) ancho = 100;

        this.barraVida.style.height = ancho + '%';
        this.textoVida.innerText = valor + '%';

        if (valor < 30) this.barraVida.style.backgroundColor = '#e74c3c'; // Rojo
        else if (valor < 60) this.barraVida.style.backgroundColor = '#f1c40f'; // Amarillo
        else this.barraVida.style.backgroundColor = '#4CAF50'; // Verde
    }

    crearElementoCarta(carta) {
        const cartaDiv = document.createElement('div');
        cartaDiv.classList.add('carta', 'carta-mano');

        // Aplicar fondo dinámico
        let fondo = carta.fondo_carta;
        if (!fondo && this.zonaObj && this.zonaObj.imagenCartas) {
            fondo = this.zonaObj.imagenCartas;
        }

        if (fondo) {

            cartaDiv.style.backgroundImage = `url('${fondo}')`;
        }

        // Mantener visualmente seleccionada si ya lo estaba
        const yaEstabaSeleccionada = this.cartasSeleccionadas.some(c => c.id_carta === carta.id_carta);
        if (yaEstabaSeleccionada) {
            cartaDiv.classList.add('carta-levantada');
        }

        // Si viene del join, si no usa el id
        const iconoMostrar = carta.codigo_icono || carta.id_icono;

        cartaDiv.innerHTML = `
            <p class="titulo-carta">${carta.nombre}</p>
            <p class="icono-carta">${iconoMostrar}</p> 
            
            </p>
            <div class="contenedor-valor-carta">
                <span class="valor-carta valor-carta-positivo">+${carta.curacion}❤️</span>
            </div>
        `;

        // Evento Click
        cartaDiv.addEventListener('click', () => {

            // Comprobamos si ya esta en la lista
            const indice = this.cartasSeleccionadas.findIndex(c => c.id_carta === carta.id_carta);

            if (indice !== -1) {
                // Si ya está, la quitamos
                this.cartasSeleccionadas.splice(indice, 1);
                cartaDiv.classList.remove('carta-levantada');
            } else {
                // Si no está, la añadimos
                this.cartasSeleccionadas.push(carta);
                cartaDiv.classList.add('carta-levantada');
            }

            // Actualizamos panel derecha
            this.actualizarPanelInfo();
        });

        this.contenedorMano.appendChild(cartaDiv);
    }

    crearElementoEvento(evento) {
        const eventoDiv = document.createElement('div');
        eventoDiv.classList.add('carta', 'problema');

        // Aplicar fondo dinámico
        let fondoEvento = evento.fondo_evento;
        if (!fondoEvento && this.zonaObj && this.zonaObj.imagenEventos) {
            fondoEvento = this.zonaObj.imagenEventos;
        }

        if (fondoEvento) {
            eventoDiv.style.backgroundImage = `url('${fondoEvento}')`;
        }

        const iconoMostrar = evento.codigo_icono || evento.codigo;

        eventoDiv.innerHTML = `
            <p class="titulo-carta" style="font-size: 14px;">${evento.nombre}</p>
            <p class="icono-carta">${iconoMostrar}</p>
            <div class="contenedor-valor-carta">
                <span class="valor-carta valor-carta-negativo">-${evento.dano} ❤️</span>
            </div>
        `;

        // Mouse Over: Mostrar info del evento
        eventoDiv.addEventListener('mouseover', () => {
            this.contenedorInfo.innerHTML = `
                <div class="info-evento-detalle">
                    <p><b>! ${evento.nombre}</b></p>
                    <p>${evento.descripcion}</p>
                    <hr>
                    <p>Daño por turno: <b>${evento.dano}</b></p>
                    <p>Turnos restantes: ${evento.turnos_duracion}</p>
                </div>
            `;
        });

        // Mouse Out
        eventoDiv.addEventListener('mouseout', () => {
            this.actualizarPanelInfo();
        });

        this.contenedorEventos.appendChild(eventoDiv);
    }

    actualizarPanelInfo() {
        // Si no hay cartas seleccionadas
        if (this.cartasSeleccionadas.length === 0) {
            this.contenedorInfo.innerHTML = `
                <div>
                    <p><b>Info</b></p>
                    <p>Selecciona cartas para ver su información detallada o pasa el ratón sobre un problema.</p>
                </div>`;
            return;
        }

        // Variable para acumular el HTML
        let html = "";

        // Recorremos las cartas seleccionadas
        this.cartasSeleccionadas.forEach(carta => {

            let textoNeutraliza = "Nada";

            if (carta.elimina_id_evento) {
                // Buscamos en el catálogo usando el id correcto de la bd
                const eventoEncontrado = this.catalogoEventosActual.find(e => e.id_evento == carta.elimina_id_evento);

                if (eventoEncontrado) {
                    textoNeutraliza = eventoEncontrado.nombre;
                }
            }

            html += `
                <div class="info-carta-item">
                    <p><b>${carta.nombre}</b></p>
                    <p style="font-size: 0.9em;">${carta.descripcion}</p>
                    <hr>
                    <p style="color: blue;"> Elimina: <b>${textoNeutraliza}</b></p>
                </div>
            `;
        });

        this.contenedorInfo.innerHTML = html;
    }

    obtenerCartasSeleccionadas() {
        return this.cartasSeleccionadas;
    }

    limpiarSeleccion() {
        this.cartasSeleccionadas = [];
        this.contenedorInfo.innerHTML = "<p>Acción realizada.</p>";
    }

    /**
     * Muestra el overlay de resultado (Victoria o Derrota)
     * @param {string} titulo - "VICTORIA" o "GAME OVER"
     * @param {string} mensaje - Mensaje descriptivo
     * @param {boolean} esVictoria - true para mostrar trofeo, false para calavera/triste
     */
    mostrarGameOver(titulo, mensaje, esVictoria, puntuacion = null) {
        const overlay = document.getElementById('overlay-resultado');
        const tituloEl = document.getElementById('titulo-resultado');
        const mensajeEl = document.getElementById('mensaje-resultado');
        const iconoEl = document.getElementById('icono-resultado');
        const puntuacionEl = document.getElementById('puntuacion-resultado');

        tituloEl.innerText = titulo;
        mensajeEl.innerText = mensaje;

        // Icono según resultado
        iconoEl.innerText = esVictoria ? '🏆' : '💀';

        // Color del título
        tituloEl.style.color = esVictoria ? '#2ecc71' : '#e74c3c';

        // Mostrar puntuación si existe
        if (puntuacion !== null) {
            puntuacionEl.innerText = `✨ Puntuación: ${puntuacion} ✨`;
            puntuacionEl.style.display = 'block';
        } else {
            puntuacionEl.style.display = 'none';
        }

        // Mostrar con flex
        overlay.style.display = 'flex';
    }
}