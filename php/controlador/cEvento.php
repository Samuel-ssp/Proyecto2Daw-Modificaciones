<?php 
require_once __DIR__ . "/../modelo/mEvento.php";

class CEvento{
    
    private $evento;

    public function __construct()
    {
        $this->evento = new MEvento();
    }

    
    public function obtenerEventos(){


        $eventos = $this->evento->obtenerEventos();


        header("Content-Type: application/json");
        
        // 3. Envía el JSON limpio
        echo json_encode($eventos);
        
        // Para la ejecucion tras enviar la información para js evitando este error SyntaxError: Unexpected non-whitespace character after JSON
        exit(); 
    }  

    //JUEGO- EVENTOS
    public function obtenerEventosJuego(){

        $this->evento->obtenerEventosJuego();

        exit(); 
    } 
}
?>