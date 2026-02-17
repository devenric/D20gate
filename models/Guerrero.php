<?php
class Guerrero extends Personaje {
    private $hechizo;

    public function __construct($id, $nombre, $nivel, $clase,$hechizo) {
        parent::__construct($id, $nombre, $nivel,$clase);
        $this->hechizo = $hechizo;
    }
    public function getHechizo() { return $this->hechizo; }
    public static function getHechizos() {
return ["Colapso de Supernova", "Palabra de Poder: Muerte", "Bucle de Cronos", "Infierno de Fuego Azul", "Singularidad de Agujero Negro"];
        // Aquí puedes rellenar hasta los 100 nombres.
    }
    
}