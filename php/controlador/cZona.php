<?php
require_once "modelo/zonasModelo.php";

class CZona
{
    public $nombreVista = "";
    private $modelo;
    public $datos = null;

    public function __construct()
    {

        $this->modelo = new Zona();
    }

    public function listar()
    {
        $this->verificarAdmin();
        $this->datos = $this->modelo->obtenerZonas();
        $this->nombreVista = "listarZonas";
        return $this->datos;
    }

    public function mostrarCrear()
    {
        $this->verificarAdmin();
        $this->nombreVista = "crearZonas";
    }

    public function crear()
    {
        $this->verificarAdmin();
        $nombre = $_POST['nombre'];

        $imagenZona = !empty($_FILES['imagenZona']['tmp_name']) ?
            addslashes(file_get_contents($_FILES['imagenZona']['tmp_name'])) : null;

        $fondoZona = !empty($_FILES['fondoZona']['tmp_name']) ?
            addslashes(file_get_contents($_FILES['fondoZona']['tmp_name'])) : null;

        $imagenCarta = !empty($_FILES['imagenCartas']['tmp_name']) ?
            'imagenes/cartas/' . $_FILES['imagenCartas']['name'] : null;

        if ($imagenCarta)
            move_uploaded_file($_FILES['imagenCartas']['tmp_name'], $imagenCarta);

        $imagenEvento = !empty($_FILES['imagenEventos']['tmp_name']) ?
            'imagenes/eventos/' . $_FILES['imagenEventos']['name'] : null;

        if ($imagenEvento)
            move_uploaded_file($_FILES['imagenEventos']['tmp_name'], $imagenEvento);

        $this->modelo->insertar($nombre, $imagenZona, $fondoZona, $imagenCarta, $imagenEvento);
        header("Location: index.php?c=Zona&m=listar");
        exit;
    }

    public function mostrarEditar()
    {
        $this->verificarAdmin();
        $idZona = $_GET['id_zona'];
        $this->datos = $this->modelo->obtenerZona($idZona);
        $this->nombreVista = "modificarZonas";
        return $this->datos;
    }

    public function editar()
    {
        $this->verificarAdmin();
        $idZona = $_GET['id_zona'];
        $nombre = $_POST['nombre'];

        $datosZona = $this->modelo->obtenerZona($idZona);

        // ZONA
        $imagenZona = !empty($_FILES['imagenZona']['tmp_name']) ?
            addslashes(file_get_contents($_FILES['imagenZona']['tmp_name'])) : null;

        // FONDO
        if (!empty($_POST['borrarFondo'])) {
            $fondoZona = "";
        } elseif (!empty($_FILES['fondoZona']['tmp_name'])) {
            $fondoZona = addslashes(file_get_contents($_FILES['fondoZona']['tmp_name']));
        } else {
            $fondoZona = null;
        }

        // CARTA
        if (!empty($_POST['borrarCarta'])) {
            if (!empty($datosZona['imagenCartas']) && file_exists($datosZona['imagenCartas']))
                unlink($datosZona['imagenCartas']);
            $imagenCarta = "";
        } elseif (!empty($_FILES['imagenCartas']['tmp_name'])) {
            $imagenCarta = 'imagenes/cartas/' . $_FILES['imagenCartas']['name'];
            move_uploaded_file($_FILES['imagenCartas']['tmp_name'], $imagenCarta);
        } else {
            $imagenCarta = null;
        }

        // EVENTO
        if (!empty($_POST['borrarEvento'])) {
            if (!empty($datosZona['imagenEventos']) && file_exists($datosZona['imagenEventos']))
                unlink($datosZona['imagenEventos']);
            $imagenEvento = "";
        } elseif (!empty($_FILES['imagenEventos']['tmp_name'])) {
            $imagenEvento = 'imagenes/eventos/' . $_FILES['imagenEventos']['name'];
            move_uploaded_file($_FILES['imagenEventos']['tmp_name'], $imagenEvento);
        } else {
            $imagenEvento = null;
        }

        $this->modelo->actualizar($idZona, $nombre, $imagenZona, $fondoZona, $imagenCarta, $imagenEvento);
        header("Location: index.php?c=Zona&m=listar");
        exit;
    }

    public function confirmarEliminar()
    {
        $this->verificarAdmin();
        $idZona = $_GET['id_zona'];
        $this->datos = $this->modelo->obtenerZona($idZona);
        $this->nombreVista = "confirmarEliminar";
        return $this->datos;
    }

    public function eliminar()
    {
        $this->verificarAdmin();
        $idZona = $_GET['id_zona'];
        $datosZona = $this->modelo->obtenerZona($idZona);

        if (!empty($datosZona['imagenCartas']) && file_exists($datosZona['imagenCartas']))
            unlink($datosZona['imagenCartas']);
        if (!empty($datosZona['imagenEventos']) && file_exists($datosZona['imagenEventos']))
            unlink($datosZona['imagenEventos']);

        $this->modelo->eliminar($idZona);
        header("Location: index.php?c=Zona&m=listar");
        exit;
    }
    ///SAMUEL 

    public function obtenerZonas()
    {

        $eventos = $this->modelo->obtenerZonasTodas();

        header("Content-Type: application/json");
        echo json_encode($eventos);

    }
    private function verificarAdmin()
    {
        if (!isset($_SESSION['idAdmin'])) {
            header("Location: ../no-mvc/pLoginAdmin.php");
            exit();
        }
    }
}
