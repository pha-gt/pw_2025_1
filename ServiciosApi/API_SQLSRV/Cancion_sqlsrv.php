<?php
//Definir que la respuesta a la peticición es un Json y no html o texto plano
header('Content-Type: application/json; charset=utf-8');

//Agregar la el codigo de la clase Melodia
include("./class/Cancion.php");

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
        _put($data);
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

    if($datos==null || (!isset($datos->titulo) ||  !isset($datos->artista) || !isset($datos->duracion)))
    {
        echo "SIN DATOS";
        return;
    }
    //incluir el codigo para acceder a la base de datos por la rutina de conexión
    include("./conexion_sqlsrv.php");

    //Intentar Registrar renglon en tabla de melodia
    try{
        

        $cadena_sql = "INSERT INTO musica.dbo.melodias
        (titulo, artista, duracion, archivo, estado)
        VALUES(?, ?, ?, './melodia3.mp3', 1);";

        //Sentencia de insercion mediante prapare
        $stmt = sqlsrv_prepare( $conn, $cadena_sql, array($datos->titulo, $datos->artista,$datos->duracion));

        //Verificar se realizo la preparacion de la consulta
        if( !$stmt ) {
            //die( print_r( sqlsrv_errors(), true));
            echo "Error en la preparacion de la consulta";
        }
        else
        {
            //Ejecutar la sentencia
            if( sqlsrv_execute( $stmt ) === false ) {
                //die( print_r( sqlsrv_errors(), true));
                echo "Error en la ejecucion de la consulta";
            }
            else
            {
                $respuesta=1;
            }
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
            sqlsrv_close ($conn );  
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
    include("./conexion_sqlsrv.php");
    
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
            $cadena_sql = "SELECT id, titulo, artista, duracion, archivo, estado
                            FROM musica.dbo.melodias WHERE id = ?  AND estado = 1;";
            //sentencia mediante query
            $stmt = sqlsrv_query( $conn, $cadena_sql, array($_GET["melodia"]));

        }
        else
        {

            //consultar todos los registros
            $cadena_sql = "SELECT id, titulo, artista, duracion, archivo, estado
            FROM musica.dbo.melodias WHERE estado = 1";

            //sentencia mediante query
            $stmt = sqlsrv_query( $conn, $cadena_sql );
        }



        //Si el valor de statement se actualizo a una consulta
        if( !$stmt ) {
            //die( print_r( sqlsrv_errors(), true));
            echo "Error en la preparacion de la consulta";
        }
        else
        {
            //mientras fetch permita segir obteniedo valores
            while($resultados = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_NUMERIC)) {

                //mapear los datos con variables locales
                $registro_melodia = new Melodia($resultados[0],utf8_encode($resultados[1]),utf8_encode($resultados[2]),$resultados[3],$resultados[4]);
                /*
                $registro = (object) array(
                    "melodia"=>$resultados[0],
                    "titulo"=>utf8_encode($resultados[1]),
                    "artista"=>utf8_encode($resultados[2]),
                    "duracion"=>$resultados[3],
                    "archivo"=>$resultados[4],
                    "estado"=>$resultados[5],
                );*/

                //Agregar a respuesta 
                array_push($respuesta,$registro_melodia);
            }
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
        if(isset($stmt))
        {
            try{
                sqlsrv_free_stmt($stmt);
            }
            catch(Exception $ex2){}
        }

        if(isset($conn))
        {
            try{
                sqlsrv_close ($conn );
            }
            catch(Exception $ex2){}
        }
    }

    //imprimir respuesta codificada
    echo json_encode($respuesta);    
}


//rutina para Update
function _put($datos)
{
    //indicar el valor de respuesta como 0 para indicar que no fue exitoso;
    $respuesta=0;

    //verificar que los datos para editar estan completos 
    if( isset($datos->melodia) && isset($datos->titulo) && isset($datos->artista) && isset($datos->duracion) ){

        //incluir el codigo para acceder a la base de datos
        include("./conexion_sqlsrv.php");
        //Intentar actualizar renglon en tabla de melodia
        try{
            //Sentencia SQL para update

            $cadena_sql = 
            "UPDATE musica.dbo.melodias
            SET titulo=?, artista=?, duracion=?
            WHERE id=?";
            
            //Sentencia de insercion mediante prapare
            $stmt = sqlsrv_prepare( $conn, $cadena_sql, array($datos->titulo, $datos->artista, $datos->duracion, $datos->melodia ));

            if(!$stmt)
            {
                //die( print_r( sqlsrv_errors(), true));
                echo "Error en la preparacion de la consulta";
            }
            else
            {
                //Ejecutar la sentencia
                if( sqlsrv_execute( $stmt ) === false ) {
                    //die( print_r( sqlsrv_errors(), true));
                    echo "Error en la ejecucion de la consulta";
                }
                else
                {
                    $respuesta=1;
                }
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
                sqlsrv_close ($conn );  
            } catch (Exception $e) {
                //Error al cerrar la conexión. 
            }
        }
    }
    else
    {
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
        include("./conexion_sqlsrv.php");

        //Intentar actualizar renglon en tabla de melodia
        try{
            //Sentencia SQL para update

            $cadena_sql = 
            "UPDATE musica.dbo.melodias
            SET estado=0 
            WHERE id=?";            

            //Sentencia de insercion mediante prapare
            $stmt = sqlsrv_prepare( $conn, $cadena_sql, array( $datos->melodia ));

            if(!$stmt)
            {
                //die( print_r( sqlsrv_errors(), true));
                echo "Error en la preparacion de la consulta";
            }
            else
            {
                //Ejecutar la sentencia
                if( sqlsrv_execute( $stmt ) === false ) {
                    //die( print_r( sqlsrv_errors(), true));
                    echo "Error en la ejecucion de la consulta";
                }
                else
                {
                    $respuesta=1;
                }
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
                sqlsrv_close ($conn );  
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