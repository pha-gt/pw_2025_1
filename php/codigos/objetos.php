<?php

class Coordenada{
    public $x;
    public $y;

    public function __construct($_x =0, $_y = 0)
    {
        $this->x=$_x;
        $this->y=$_y;

    }
}


//-----

$objeto_coordenada = new Coordenada(1000,1000);
$objeto_coordenada->x  = 30;
//$objeto_coordenada->y = 20;

echo "(".$objeto_coordenada->x.",".$objeto_coordenada->y.")";

echo "<br>";

$objeto_coordenada_2 = new Coordenada(1,2);

echo "(".$objeto_coordenada_2->x.",".$objeto_coordenada_2->y.")";


echo "<br>";
var_dump($objeto_coordenada);

echo "<br>";
print_r($objeto_coordenada);

echo "<br>";
echo json_encode($objeto_coordenada);
echo "<br>e";

$ubicacion_plaza_galerias = '{"x":450,"y":777}';
$coordenada_plaza_galerias = json_decode($ubicacion_plaza_galerias);

print_r($coordenada_plaza_galerias);
$coordenada_plaza_galerias->x = $coordenada_plaza_galerias->x+10;
echo "(".$coordenada_plaza_galerias->x.",".$coordenada_plaza_galerias->y.")";



?>