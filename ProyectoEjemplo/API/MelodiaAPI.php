<?php
//Definir que la respuesta a la peticición es un Json y no html o texto plano
header('Content-Type: application/json; charset=utf-8');

//Agregar la el codigo de la clase Melodia
include("../class/cancion.php");

//obtener el contenido de la petición
$postBody = file_get_contents("php://input");
//convertir a objeto 
if(isset($postBody)) $data = json_decode($postBody);
else $data = null;

switch($_SERVER['REQUEST_METHOD'])
{
    case 'POST':  //Create
        _post($data);
    break;
    case 'GET':   //Read
        _get();
    break;
    case 'PUT':   //Update
        _puts($data);
    break;
    case 'DELETE':   //Delete
        _delete($data);
    break;
    default:
        header('HTTP/1.1 405 Method not allowed');
        header('Allow: GET, PUT, DELETE, POST');
    break;  
}

//rutina para Create
function _post($datos)
{
    //indicar el valor de respuesta como 0 para indicar que no fue exitoso;
    $respuesta=0;
    //incluir el codigo para acceder a la base de datos por la rutina de conexión
    include("./conn/conexion.php");

    //Intentar Registrar renglon en tabla de melodia
    try{
        
        //Sentencia de insercion mediante prapare
        if($stmt = $mysqli->prepare("INSERT INTO melodias(titulo,artista,duracion,archivo,estado) VALUES(?,?,?,'./melodia3.mp3',1);"))
        {
            
            //definir los valores que tendran los valores ? definidos en la cadena preapare
            $stmt->bind_param("sss",$datos->titulo,$datos->artista,$datos->duracion);

            //invocar la ejecución de la sentencia
            $stmt->execute();

            //invocar cerrar la consulta
            $stmt->close();
            //cambiar el valor de respuesta a 1 para indicar exito
            $respuesta=1;
        }
        else
        {
            //No puedo realizarse la sentencia SQL, la sentencia puede contener errores. 
            //Al definir un echo que no pertenece a la estructura de Json se marca como un error
            echo "No disponible";
        }
    }catch (Exception $e) {
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
}




//rutina para Read
function _get()
{
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
}


//rutina para Update
function _puts($datos)
{
    //indicar el valor de respuesta como 0 para indicar que no fue exitoso;
    $respuesta=0;
    //verificar que los datos para editar estan completos 
    if( isset($datos->melodia) 
        && isset($datos->titulo) && isset($datos->artista) && isset($datos->duracion)){

        //incluir el codigo para acceder a la base de datos
        include("./conn/conexion.php");
        try{
            //Sentencia SQL para update
            if($stmt = $mysqli->prepare("UPDATE melodias SET titulo=?, artista=?, duracion=? WHERE id=?;"))
            {
                //definir los valores que tendran los valores ? definidos en la cadena preapare        
                $stmt->bind_param("sssi",$datos->titulo,$datos->artista,$datos->duracion,$datos->melodia);
                //invocar la ejecución de la sentencia
                $stmt->execute();

                //invocar cerrar la consulta
                $stmt->close();
                //cambiar el valor de respuesta a 1 para indicar exito
                $respuesta=1;
            }
            else
            {
                //No puedo realizarse la sentencia SQL, la sentencia puede contener errores. 
                echo "No disponible ::";
            }
        }catch (Exception $e) {
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
    }
    else
    {
        //echo "Sin datos";
         die("Error: Sin datos.");
    }
    echo json_encode($respuesta);
}

//rutina para Delete
function _delete($datos)
{
    //indicar el valor de respuesta como 0 para indicar que no fue exitoso;
    $respuesta=0;
    //verificar que los datos para editar estan completos 
    if(isset($datos->melodia)){

        //incluir el codigo para acceder a la base de datos
        include("./conn/conexion.php");
        try{
            //Sentencia SQL para update
            if($stmt = $mysqli->prepare("UPDATE melodias SET estado=0 WHERE id=?;"))
            {
                //definir los valores que tendran los valores ? definidos en la cadena preapare        
                $stmt->bind_param("i",$datos->melodia);
                //invocar la ejecución de la sentencia
                $stmt->execute();

                //invocar cerrar la consulta
                $stmt->close();
                //cambiar el valor de respuesta a 1 para indicar exito
                $respuesta=1;
            }
            else
            {
                //No puedo realizarse la sentencia SQL, la sentencia puede contener errores. 
                echo "No disponible ::";
            }
        }catch (Exception $e) {
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
    }
    else
    {
        //echo "Sin datos";
        die("Error: Sin datos.");
    }
    echo json_encode($respuesta);
}

?>
