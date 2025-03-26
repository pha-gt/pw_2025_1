<?php
//CONSUMIR UN LA API GETGET
$url ='http://localhost:8080/pw_2024_2/ProyectoEjemplo/API/MelodiaAPI.php';
$json_resultado = file_get_contents($url);
$listada_canciones = json_decode($json_resultado);
//print_r($listada_canciones);



//incluir el codigo para acceder a la base de datos
include("./conn/conexion.php");

//inicializar el statement en null
$stmt = null;
//Definir la respuesta con un arreglo vacio
$respuesta = array();

//intentar consultar la tabla
try
{
    //identificar si la petición tiene definida en el gets el parametro melodia para buscar un registro 
    if(isset($_GET["melodia"]))
    {
        //consultar solo un registro
        if($stmt =  $mysqli->prepare("SELECT id,titulo,artista,duracion,archivo FROM melodias WHERE id = ? AND estado = 1;"))
        {
            $stmt->bind_param("i",$_GET['tela']);
            $stmt->execute();
        }
    }
    else
    {
        //consultar todos los registros
        if($stmt =  $mysqli->prepare( "SELECT id,titulo,artista,duracion,archivo FROM melodias WHERE estado = 1;"))
        {
            $stmt->execute();
        }
    }

    //Si el valor de statement se actualizo a una consulta
    if(isset($stmt))
    {
        //mapear los datos con variables locales
        $stmt->bind_result($id,$titulo,$artista,$duracion,$archivo);
        //mientras fetch permita segir obteniedo valores
        while ($stmt->fetch()) {
            //crear un objeto de melodia con los datos mapeados
            $registro_melodia = new Melodia($id,$titulo,$artista,$duracion,$archivo);
            array_push($respuesta,$registro_melodia);   
        }
        //limpiar los datos obtenidos de la consulta
        $stmt->free_result();
        //invocar cerrar la consulta
        $stmt->close();
    }
    else
    {
        //No puedo realizarse la sentencia SQL, la sentencia puede contener errores.
        echo "No disponible ::";
    }
}
catch (Exception $e) {
    //Codigo para realizar en caso de exepcion
    echo "Exception ::".$e->getMessage();
}
finally
{
    //Se realiza al registrarse con exito o catch
    //Intentar cerrar la conexión. 
    try {
        //sentencia de cerrar conexión
        $mysqli->close();    
    } catch (Exception $e) {
        //Error al cerrar la conexión. 
    }
}

//imprimir respuesta codificada
echo json_encode($respuesta);  

listada_canciones =$respuesta;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <!--<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>-->

    
    

</head>
<body>

<div class="m-4">

    <table  class="display table" id="mi_tabla_datos">
    <thead>
        <tr>
        <th scope="col">Titulo</th>
        <th scope="col">Artista</th>
        <th scope="col">Duracion</th>
        <th scope="col">Operaciones</th>
        </tr>
    </thead>
    <tbody>
        
        
        <?php

        foreach($listada_canciones as $cancion)
        {
            echo "<tr>
                    <th scope='row'>".$cancion->titulo."</th>
                    <td>".$cancion->artista."</td>
                    <td>".$cancion->duracion."</td>
                    <td>@mdo</td>
                </tr>";
               
            echo "<tr>
                    <th scope='row'>".$cancion->titulo."</th>
                    <td>".$cancion->artista."</td>
                    <td>".$cancion->duracion."</td>
                    <td>@mdo</td>
                </tr>";
            echo "<tr>
                <th scope='row'>".$cancion->titulo."</th>
                <td>".$cancion->artista."</td>
                <td>".$cancion->duracion."</td>
                <td>@mdo</td>
            </tr>";
            echo "<tr>
                <th scope='row'>".$cancion->titulo."</th>
                <td>".$cancion->artista."</td>
                <td>".$cancion->duracion."</td>
                <td>@mdo</td>
            </tr>";
            echo "<tr>
                <th scope='row'>".$cancion->titulo."</th>
                <td>".$cancion->artista."</td>
                <td>".$cancion->duracion."</td>
                <td>@mdo</td>
            </tr>";
            echo "<tr>
                <th scope='row'>".$cancion->titulo."</th>
                <td>".$cancion->artista."</td>
                <td>".$cancion->duracion."</td>
                <td>@mdo</td>
            </tr>";

        }

        ?>
    </tbody>
    </table>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
  
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

<script>
    let table = new DataTable('#mi_tabla_datos');
</script>

    
</body>
</html>