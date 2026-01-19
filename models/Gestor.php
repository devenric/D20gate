<?php
class Gestor{
    public function __construct(){
        if (!isset($_SESSION['personajes'])) {
            $_SESSION['personajes'] = [];
        }
    }
    //Ahora quedaría solamente los métodos CRUD
    public function listar(){
        return $_SESSION['personajes'];
    }
    public function crear(Personaje $personaje){
        $_SESSION['personajes'][] = $personaje;
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