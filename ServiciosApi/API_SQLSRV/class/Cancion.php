<?php

class Melodia{
    public $id;
    public $titulo;
    public $artista;
    public $duracion;
    public $archivo;

    //constructor
    public function __construct($_id, $_titulo,$_artista,$_duracion, $_archivo){
        $this->id= $_id;
        $this->titulo= $_titulo;
        $this->artista= $_artista;
        $this->duracion= $_duracion;
        $this->archivo="./melodia3.mp3";
    }
}
?>