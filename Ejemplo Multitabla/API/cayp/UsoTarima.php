<?php
header('Content-Type: application/json; charset=utf-8');

switch($_SERVER['REQUEST_METHOD']){
    case 'PUT':
        $postBody = file_get_contents("php://input");
        $data = json_decode($postBody,true);
        _put($data);
        break;
    case 'DELETE':
        $postBody = file_get_contents("php://input");
        $data = json_decode($postBody,true);
        _delete($data);
        break;
    case 'GET':
        _get();
        break;
    case 'POST':
        $postBody = file_get_contents("php://input");
        $data = json_decode($postBody,true);
        _post($data);
        break;
    default:
        header('HTTP/1.1 405 Method not allowed');
        header('Allow: GET, PUT, DELETE');
        break;
}


function _get()
{
  $stmt = null;
  try
  {

    include("../conexion/conexion_sqlserver.php");

    $lista_uso_tarima = array();

    $consulta="SELECT Id, Nombre FROM UsoTarima WHERE Activo =1";


    $stmt = sqlsrv_query( $conn, $consulta, array());

    while($resultados = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_NUMERIC)) {
        $uso_tarima= (object) [
            "id"=>$resultados[0],
            "nombre"=>utf8_encode($resultados[1]),
        ];
        array_push($lista_uso_tarima,$uso_tarima);

    }


    }
    catch (Exception $e) {
        echo "Exception ::";
        echo $e->getMessage();

    }
    finally {
        try{
            sqlsrv_free_stmt($stmt);
            sqlsrv_close ($conn );
        }
        catch(Exception $ex2){}
    }
      echo json_encode($lista_uso_tarima);


}
?>
