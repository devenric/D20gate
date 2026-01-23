<?php
class Gestor{
    public function __construct(){
        if (!isset($_SESSION['personajes'])) {
            $_SESSION['personajes'] = [];
        }
    }
    //Ahora quedaría solamente los métodos CRUD
    public function listar(){
           // Validar que todos los elementos son objetos
        $personajes = $_SESSION['personajes'];
        foreach ($personajes as $key => $p) {
            if (!is_object($p)) {
                unset($personajes[$key]); // Eliminar arrays si existen
            }
        }
        return array_values($personajes); // Reindexar el array
    }
   public function crear(Personaje $personaje){
        if (session_status() === PHP_SESSION_NONE) {
    session_start();}
        if (!isset($_SESSION['personajes'])) {
            $_SESSION['personajes'] = [];
        }
        $_SESSION['personajes'][$personaje->getId()] = $personaje;
        session_write_close();
    }
    public function buscar($id){
        foreach ($_SESSION['personajes'] as $p) {
            if ($p->getId() == $id) {
                return $p;
            }
        }
        return null;
    }
    public function editar($id,$nombre, $clase){
        foreach ($_SESSION['personajes'] as $p) {
            if ($p->getId() == $id) {
                $p->setNombre($nombre);
                $p->setClase($clase);
                return true;
            }
        }
        return false;
    }
    public function eliminar($id){
        foreach ($_SESSION['personajes'] as $i => $p) {
            if ($p->getId() == $id) {
                unset($_SESSION['personajes'][$i]);
                $_SESSION['personajes'] = array_values($_SESSION['personajes']);
                return true;
            }
        }
        return false;
    }
}