<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    </head>
<body>
    <?php

    /******  INVOCAR UN SERVICIO *****/
    $url = "http://localhost/pw_2025_1/php/codigos/objetos2.php";
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


    //print_r($data); // Muestra la respuesta
    ?>


    
    
</body>
</html>