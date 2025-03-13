<?php
class Marca {
    public $Nombre;
    public $Pais;
    public function __construct($_nombre, $_pais)
    {
        $this->Nombre = $_nombre;
        $this->Pais = $_pais;

    }
}

class Motor{
    public $Nombre;
    public $Cilindros;
    public $Capacidad;
    public function __construct($_nombre,$_cilindros, $_capacidad)
    {
        $this->Nombre = $_nombre;
        $this->Cilindros = $_cilindros;
        $this->Capacidad = $_capacidad;
    }
}


class Vehiculo{
    public $Modelo;
    public $Anio;
    public $Marca;
    public $Motor;
    public function __construct($_modelo, $_anio, $_marca= null, $_motor = null)
    {
        $this->Modelo= $_modelo;
        $this->Anio = $_anio;
        $this->Marca = $_marca;
        $this->Motor = $_motor;
    }

}

///Ejemplo de objeto 

$motor_sky = new Motor("Skyactive g", 4, 1.5);
$marca_mazda = new Marca("Mazda", "Japon");
$auto1= new Vehiculo("2","2020",$marca_mazda,$motor_sky);
$auto2= new Vehiculo("3","2020",$marca_mazda,$motor_sky);

$lista = array($auto1, $auto2);
//print_r($auto1);
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
echo json_encode($lista);



?>