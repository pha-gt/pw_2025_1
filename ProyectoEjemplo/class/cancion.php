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

    public function imprimir()
    {

        echo '<div class="card m-2" style="width: 18rem;">
            <div class="card-body">
            <h5 class="card-title">'.$this->titulo.'</h5>
            <p class="card-text">'.$this->artista.'</p>
            <p class="card-text">Duracion:'.$this->duracion.'</p>
            </div>
            <audio src="./melodia3.mp3" controls  type="audio/mpeg" style="width:90%; margin:auto;"></audio>
            </div>';
    }
}

?>