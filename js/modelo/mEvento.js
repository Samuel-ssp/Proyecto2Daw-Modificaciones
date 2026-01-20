class MEvento {


    async obtenerEventos(zona) {

        try {

            let response = await fetch(`index.php?c=Evento&m=obtenerEventosJuego&zona=${zona}`);


            let eventos = await response.json();


            return eventos;

        } catch (error) {
            console.log(error);
            return [];
        }
    }
}