<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    </head>
<body>
    <h1>HOLA TABLA</h1>

    <?php

    /******  INVOCAR UN SERVICIO *****/
    $url = "http://localhost/pw_2025_1/ServiciosApi/API/Auto.php";
    // Inicializa cURL
    $ch = curl_init($url);
    // Configura las opciones de cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Para recibir la respuesta como string
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json' //, // Tipo de contenido
        //'Authorization: Bearer tu_token_aqui' // Si es necesario, agrega un token de autorización
    ]);

    // Ejecuta la solicitud
    $response = curl_exec($ch);
    // Maneja errores
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    // Cierra la sesión de cURL
    curl_close($ch);

    // Procesa la respuesta
    $lista_vehiculos = json_decode($response);
    /*****   FIN DE INVOCA UN SERVICIO *******/


    //print_r($lista_vehiculos); // Muestra la respuesta
    ?>

    
    <table class="table">
    <thead>
        <tr>
        <th scope="col">Marca</th>
        <th scope="col">Pais</th>
        <th scope="col">Modelo</th>
        <th scope="col">Año</th>
        <th scope="col">Motor</th>
        <th scope="col">Cilintros</th>
        <th scope="col">Capacidad</th>
        </tr>
    </thead>
    <tbody>

    <?php

    foreach($lista_vehiculos as $vehiculo)
    {
        echo "<tr>
        <th scope='row'>".$vehiculo->Marca->Nombre."</th>
        <td>".$vehiculo->Marca->Pais."</td>
        <td>Otto</td>
        <td>@mdo</td>
        </tr>";
    }

   

    ?>
        



    </tbody>
    </table>

   


    
    
</body>
</html>