<?php 
abstract class Personaje{
    protected $id;
    protected $nombre;
    protected $nivel;
    private $foto;

    public function __construct($id, $nombre, $nivel) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->nivel = $nivel;
    }
    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getNivel() { return $this->nivel; }
    public function setNombre($nombre){$this->nombre = $nombre;}
    public function setNivel($nivel){$this->nivel = $nivel;}
    public function setClase($clase){$this->clase = $clase;}
    public function getFoto() {return $this->foto;}
public function setFoto($foto) {$this->foto = $foto;}
}
/*  protected $Fuerza;
    protected $Destreza;
    protected $Constitución;
    protected $Inteligencia;
    protected $Sabiduría;
    protected $Carisma; 
    protected $dadoGolpe;*/ //esto no va en el constructor, ya que se calcula a partir de determinados datos