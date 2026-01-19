<?php
class Mago extends Personaje {
    private $hechizo;

    public function __construct($id, $nombre, $nivel, $hechizo) {
        parent::__construct($id, $nombre, $nivel);
        $this->hechizo = $hechizo;
    }

    public function getHechizo() { return $this->hechizo; }
    public static function obtenerHechizos() {
return ["Colapso de Supernova", "Palabra de Poder: Muerte", "Bucle de Cronos", "Infierno de Fuego Azul", "Singularidad de Agujero Negro"];
        // Aquí puedes rellenar hasta los 100 nombres.
    }
}