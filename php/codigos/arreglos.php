<?php
echo "Arreglos <br>";
$coleccion = array("Hola", "mi", "arreglo");
echo "<br>primer valor:".$coleccion[0];
echo "<br>segundo valor:".$coleccion[1];
echo "<br>";
var_dump($coleccion);
echo "<br>";
print_r($coleccion);

echo "<h2>Arreglos con mi clave</h2>";

$arreglo_llaves = array(
    "nombre"=>"Fabian",
    "apellido"=>"Gonzalez",
    "nc"=>81231,
    1 =>"rojo"
);

echo "<br>Nombre:". $arreglo_llaves["nombre"];
echo "<br>Numero de control:". $arreglo_llaves["nc"];
echo "<br>1:". $arreglo_llaves[1];


echo "<h2>Arreglos Lista</h2>";

$lista = array();

echo "<br> cuenta ".count($lista);

array_push($lista, 3.14);
echo "<br> cuenta ".count($lista);
echo "<br>";
var_dump($lista);

array_push($lista, "valor");
echo "<br> cuenta ".count($lista);
echo "<br>";
var_dump($lista);

array_push($lista, 51);
echo "<br> cuenta ".count($lista);
echo "<br>";
var_dump($lista);

unset($lista[1]);
echo "<br> cuenta ".count($lista);
echo "<br>";
var_dump($lista);


echo "<h2>Lista Productos</h2>";

$lista_productos = array("Jabon", "Arroz", "Frijol", "Crema", "Papel", "chocolate", "leche");


foreach($lista_productos as $p)
{
    echo "<input type='submit' value='".$p."' >";
}



?>