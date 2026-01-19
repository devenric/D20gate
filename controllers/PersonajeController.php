<?php
class PersonajeController {
    private $gestor;

    public function __construct() {
        $this->gestor = new Gestor();
    }

    public function index() {
        $personajes = $this->gestor->listar();
        include "views/listar.php";
    }

    public function crear() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $nivel = $_POST['nivel'];
        $clase = $_POST['clase'] ?? 'mago';
        
        // Crear el personaje según la clase
        switch (strtolower($clase)) {
            case 'mago':
                $personaje = new Mago($id, $nombre, $nivel, $clase);
                break;
            case 'guerrero':
                $personaje = new Guerrero($id, $nombre, $nivel, $clase);
                break;
            case 'clerigo':
                $personaje = new Clerigo($id, $nombre, $nivel, $clase);
                break;
            default:
                $personaje = new Mago($id, $nombre, $nivel, $clase); // Por defecto Mago
                break;
        }
        
        $this->gestor->crear($personaje);  
        header("Location: index.php");
        exit;
    }
    $personaje = null;
    include "views/crear.php";
}
    public function editar(){
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "No se han encontrado personajes";
            exit;
        }
        $personaje = $this->gestor->buscar($id);
        if (!$personaje) {
            echo "No se han encontrado personajes";
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $clase = $_POST['clase'];
            $this->gestor->editar($id,$nombre, $clase);
            header("Location: index.php");
            exit;
        }
        include "views/editar.php";
    }
    public function eliminar(){
        $id = $_GET['id'] ?? null;
        $this->gestor->eliminar($id);
        header("Location: index.php");
        }
    }

