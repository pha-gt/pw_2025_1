<?php
//GET
$url ='http://localhost/fabrics/API/Telas.php';
$json = file_get_contents($url);
$respuesta = json_decode($json,true);
print_r($respuesta);



//POST/ PUT / DELETE




//datos para la solicitud
$nueva_tela=[
    "nombre"=>"FITOLACA",
    "pais"=>"Alemania"
];

//Configuracion de la peticion
$opts = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => json_encode($nueva_tela)
        )
);


//EJEPLO DE ELIMINAR
$optsEliminar = array('http' =>
        array(
            'method'  => 'DELETE',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => json_encode(["tela"=>6])
        )
);

?>