class MCarta {

    async obtenerCartas(zona) {

        try {

            let response = await fetch(`index.php?c=Carta&m=obtenerCartasJuego&zona=${zona}`);


            let cartas = await response.json();


            return cartas;

        } catch (error) {
            console.log(error);
            return [];
        }
    }
}