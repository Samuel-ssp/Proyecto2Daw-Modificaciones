<?php
require_once __DIR__ . "/../modelo/mCarta.php";
require_once __DIR__ . "/../modelo/zonasModelo.php";
require_once __DIR__ . "/../modelo/mIcono.php";
require_once __DIR__ . "/../modelo/mEvento.php";

class CCarta
{
    //Modelos
    private $carta;
    private $zona;
    private $icono;
    private $evento;
    //variables auxiliares
    public $nombreVista;

    public function __construct()
    {


        $this->carta = new MCarta();
        $this->evento = new MEvento();
        $this->zona = new Zona();
        $this->icono = new MIcono();

    }

    public function mostrarCrearCarta()
    {
        $this->verificarAdmin();
        $zonas = $this->zona->obtenerZonasTodas();
        $iconos = $this->icono->obtenerIconos();
        $this->nombreVista = "crearCartas";
        return [
            "zonas" => $zonas,
            "iconos" => $iconos
        ];
    }

    public function mostrarModificarCarta()
    {
        $this->verificarAdmin();
        $zonas = $this->zona->obtenerZonasTodas();
        $iconos = $this->icono->obtenerIconos();
        $carta = $this->carta->buscarCarta();
        $this->nombreVista = "modificarCartas";
        return [
            "zonas" => $zonas,
            "iconos" => $iconos,
            "carta" => $carta
        ];
    }

    public function listarCartas()
    {
        $this->verificarAdmin();

        $this->nombreVista = "lCartas";
        return $this->carta->obtenerCartas();
    }

    public function crearCarta()
    {
        $this->verificarAdmin();

        // Comprobar datos de carta
        if (!$this->validarCarta()) {
            // FALLA
            header("Location:index.php?c=Carta&m=mostrarCrearCarta");
            return;
        }

        // Variable par el id evento
        $id = null;

        //Comprobar si se tiene que crear evento
        if ($_POST["creandoEventoNuevo"] === "1") {

            if ($this->validarEvento()) {
                //Se crea el evento y se devuelve id
                $id = $this->evento->crearEventoId();
            } else {
                // FALLA
                header("Location:index.php?c=Carta&m=mostrarCrearCarta");
                return;
            }
        } else {
            //USAR id del formulario
            $id = $_POST["evento"];
            $this->evento->modificarEstado($id);
        }
        //Despues de crear la carta cambiamos el estado del evento a 1 
        $this->carta->crearCarta($id);

        // Redirigir a listar
        $this->nombreVista = "lCartas";
        return $this->carta->obtenerCartas();
    }

    public function modificarCarta()
    {
        $this->verificarAdmin();

        // Variables
        $id_evento_antiguo = $_POST['idEventoAntiguo'] ?? null;
        $id_evento_nuevo = null;

        if (!$this->validarCarta()) {

            header('Location: index.php?c=Carta&m=mostrarModificarCarta&id=' . $_GET["id"]);
            return;
        }

        // Gestionar evento (Crear o Seleccionar existente)

        if ($_POST["creandoEventoNuevo"] === "1") {

            if ($this->validarEvento()) {
                // Se crea el evento en la DB y se obtiene el nuevo ID.
                $id_evento_nuevo = $this->evento->crearEventoId();
            } else {
                // FALLA 
                header('Location: index.php?c=Carta&m=mostrarModificarCarta&id=' . $_GET["id"]);
                return;
            }

        } else {
            // Usar el ID del evento seleccionado/existente 
            $id_evento_nuevo = $_POST["evento"] !== '' ? $_POST["evento"] : null;
        }


        // Solo cambiamos el estado del  evento antiguo si existía  Y si es diferente al evento que vamos a asignar
        if (!empty($id_evento_antiguo) && $id_evento_antiguo != $id_evento_nuevo) {
            // Marcamos el evento antiguo como DISPONIBLE 
            $this->evento->modificarEstado($id_evento_antiguo);
        }


        // Modificar carta
        $resultado = $this->carta->modificarCarta($id_evento_nuevo);

        // Si se asignó un nuevo ID de evento  nos aseguramos de que esté marcado 
        if (!empty($id_evento_nuevo)) {
            $this->evento->modificarEstado($id_evento_nuevo);
        }

        if ($resultado > 0) {

            $this->nombreVista = "listarCartas";
            return $this->carta->obtenerCartas();

        } else {

            // Redirigir 
            header('Location: index.php?c=Carta&m=mostrarModificarCarta&id=' . $_GET["id"]);
            return;
        }

    }

    public function eliminarCarta()
    {
        $this->verificarAdmin();
        $this->carta->eliminarCarta();
        header("Location: index.php?c=Carta&m=listarCartas");
    }

    //JUEGO -CARTAS
    public function obtenerCartasJuego()
    {

        $this->carta->obtenerCartasJuego();

        exit();
    }
    ////////////////////////////////////////////VALIDACIONES

    private function validarCarta()
    {

        $camposRequeridos = [
            'nombre',
            'descripcion',
            'curacion',
            'emoticono'
        ];
        $hayError = false;

        foreach ($camposRequeridos as $campo) {

            // Obtenemos el valor del campo sin trimearlo todavía, porque podría ser un array
            $valor = isset($_POST[$campo]) ? $_POST[$campo] : '';

            // Verificar si es un array
            if (is_array($valor)) {

                // Si es un array, solo comprobamos si está vacío (si no se seleccionó nada)
                if (empty($valor)) {
                    $hayError = true;
                }

            } else {

                // Aquí sí trimeamos (quitamos espacios) antes de verificar si está vacío
                if (empty(trim($valor))) {
                    $hayError = true;
                }
            }
        }

        return !$hayError;
    }

    private function validarEvento()
    {

        $camposRequeridos = [
            'nombreEvento',
            'descripcionEvento',
            'danoEvento',
            'emoticonoEvento'
        ];
        $hayError = false;

        foreach ($camposRequeridos as $campo) {

            // Obtenemos el valor del campo sin trimearlo todavía, porque podría ser un array
            $valor = isset($_POST[$campo]) ? $_POST[$campo] : '';

            // Verificar si es un array
            if (is_array($valor)) {

                // Si es un array, solo comprobamos si está vacío (si no se seleccionó nada)
                if (empty($valor)) {
                    $hayError = true;
                }

            } else {

                // Aquí sí trimeamos (quitamos espacios) antes de verificar si está vacío
                if (empty(trim($valor))) {
                    $hayError = true;
                }
            }
        }

        return !$hayError;
    }

    private function verificarAdmin()
    {
        if (!isset($_SESSION['idAdmin'])) {
            header("Location: ../no-mvc/pLoginAdmin.php");
            exit();
        }
    }

}