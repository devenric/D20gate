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
        $clase = $_POST['clase'] ?? 'Mago';
        $hechizo = $_POST['hechizo'] ?? null;

        if (!$hechizo) {
            echo "¡Selecciona un hechizo antes!";
            exit;
        }

        $fotoNombre = null;
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $rutaTemporal = $_FILES['foto']['tmp_name'];
            $hashNuevo = md5_file($rutaTemporal); // Genera la huella única del archivo
            $directorio = 'uploads/personajes/';
            $duplicada = false;

            // Buscamos si ya existe ese mismo contenido en la carpeta
            if (is_dir($directorio)) {
                $archivos = array_diff(scandir($directorio), array('.', '..'));
                foreach ($archivos as $archivo) {
                    if (md5_file($directorio . $archivo) === $hashNuevo) {
                        $duplicada = true;
                        $fotoNombre = $archivo; // Reutilizamos el nombre del archivo existente
                        break;
                    }
                }
            }

            // Si no existe, la guardamos como nueva
            if (!$duplicada) {
                $extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                $fotoNombre = uniqid('personaje_') . '.' . $extension;
                if (!is_dir($directorio)) mkdir($directorio, 0755, true);
                move_uploaded_file($rutaTemporal, $directorio . $fotoNombre);
            }
        }

        // Instanciamos según la clase
        if ($clase === "Mago") {
            $personaje = new Mago($id, $nombre, $nivel, $clase, $hechizo);
        } else if ($clase === "Guerrero") {
            $personaje = new Guerrero($id, $nombre, $nivel, $clase, $hechizo);
        } else if ($clase === "Barbaro") {
            $personaje = new Barbaro($id, $nombre, $nivel);
        } else {
            $personaje = new Personaje($id, $nombre, $nivel, $clase);
        }

        if ($fotoNombre) $personaje->setFoto($fotoNombre);

        $this->gestor->crear($personaje);  
        header("Location: index.php");
        exit;
    }
    include "views/crear.php";
}
    public function editar() {
    $id = $_GET['id'] ?? null;
    if (!$id) { header("Location: index.php"); exit; }

    $personajeActual = $this->gestor->buscar($id);
    if (!$personajeActual) { header("Location: index.php"); exit; }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $nivel = $_POST['nivel'];
        $clase = $_POST['clase'];
        $nuevoHechizo = $_POST['hechizo'] ?? null;
        $fotoGaleria = $_POST['previousPhoto'] ?? null;

        $fotoFinal = $personajeActual->getFoto(); // Por defecto la que ya tenía

        // Lógica de Foto Nueva con detección de duplicados
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $rutaTemporal = $_FILES['foto']['tmp_name'];
            $hashNuevo = md5_file($rutaTemporal);
            $directorio = 'uploads/personajes/';
            $duplicada = false;

            $archivos = array_diff(scandir($directorio), array('.', '..'));
            foreach ($archivos as $archivo) {
                if (md5_file($directorio . $archivo) === $hashNuevo) {
                    $duplicada = true;
                    $fotoFinal = $archivo; 
                    break;
                }
            }

            if (!$duplicada) {
                $extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                $fotoFinal = uniqid('personaje_') . '.' . $extension;
                move_uploaded_file($rutaTemporal, $directorio . $fotoFinal);
            }
        } 
        // Si no subió nada nuevo, comprobamos si eligió algo de la galería
        else if (!empty($fotoGaleria)) {
            $fotoFinal = $fotoGaleria;
        }

        // Re-instanciar para guardar cambios
        if ($clase === "Mago") {
            $personajeEditado = new Mago($id, $nombre, $nivel, $clase, $nuevoHechizo);
        } else if ($clase === "Guerrero") {
            $personajeEditado = new Guerrero($id, $nombre, $nivel);
        } else if ($clase === "Barbaro") {
            $personajeEditado = new Barbaro($id, $nombre, $nivel);
        } else {
            $personajeEditado = new Personaje($id, $nombre, $nivel, $clase);
        }

        $personajeEditado->setFoto($fotoFinal);
        $this->gestor->eliminar($id);
        $this->gestor->crear($personajeEditado);

        header("Location: index.php");
        exit;
    }

    $personaje = $personajeActual; // Preparamos la variable para el formulario
    include "views/editar.php";
}
    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->gestor->eliminar($id);
        }
        header("Location: index.php");
        exit;
    }
}