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

        $lista_tarimas = array();

        $consulta="SELECT TOP 1000 t.Id, t.ClaveId, t.ProductoId, t.UsoTarimaId, t.LocalidadId, t.DocumentoEntrada, t.EstadoCalidadId,
                    t.Cantidad,t.FechaCreacion, t.UsuarioId, 
                p.Id,p.ProductoClaveId ,p.Descripcion, p.UnidadProductoId ,p.TipoProductoId,p.Ancho, p.ProductoId,
                up.Id, up.Descripcion,
                tp.Id,tp.Nombre,
                l.Id, l.ClaveId, l.AlmacenId,
                u.Id, u.nombre, u.ApellidoPaterno ,u.ApellidoMaterno, 
                ec.Id, ec.Nombre,
                ut.Id, ut.Nombre
                FROM [CAYP_V1.0].dbo.Tarima t 
                JOIN Producto p on t.ProductoId = p.id and t.Activo = 1
                JOIN UnidadProducto up on p.UnidadProductoId = up.Id 
                JOIN TipoProducto tp on p.TipoProductoId =tp.Id 
                JOIN Localidad l on t.LocalidadId = l.Id 
                JOIN Almacen a ON l.AlmacenId =a.Id
                JOIN Usuario u On t.UsuarioId = u.Id
                JOIN EstadoCalidad ec ON t.estadoCalidadID = ec.Id
                JOIN UsoTarima ut ON t.UsoTarimaId = ut.id ";


        $stmt = sqlsrv_query( $conn, $consulta, array());

        while($resultados = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_NUMERIC)) {
            $tarima= (object) [
                "id"=>$resultados[0],
                "clave_id"=>$resultados[1],
                "producto_id"=>$resultados[2],
                "uso_tarima_id"=>$resultados[3],
                "localidad_id"=>$resultados[4],
                "documento_entrada"=>$resultados[5],
                "estado_calidad_id"=>$resultados[6],
                "cantidad"=>$resultados[7],
                "fecha_creacion"=>(($resultados[8] instanceof DateTime ) ?$resultados[8]->format('Y-m-d'):null),
                "usuario_id"=>$resultados[9],
                "producto" => (object) [
                                "id"=>$resultados[10],
                                "clave_id"=>$resultados[11],
                                "descripcion"=>mb_convert_encoding($resultados[12], "UTF-8", "Windows-1252"),
                                "unidad_producto_id" => $resultados[13],
                                "tipo_producto_id" => $resultados[14],
                                "ancho" => $resultados[15],
                                "Productoid" => $resultados[16],
                                "unidad_producto" =>(object) [
                                    "id" => $resultados[17],
                                    "-descripcion"=>mb_convert_encoding($resultados[18], "UTF-8", "Windows-1252")
                                ],
                                "tipo_producto" =>(object) [
                                    "id" => $resultados[19],
                                    "descripcion"=>mb_convert_encoding($resultados[20], "UTF-8", "Windows-1252")
                                ],
                ],
                "localidad"=> (object) [
                                "id"=>$resultados[21],
                                "clave_id"=>$resultados[22],
                                "almacen_id"=>$resultados[23],
                ],
                "usuario"=> (object) [
                                "id"=>$resultados[24],
                                "nombre"=>mb_convert_encoding($resultados[25], "UTF-8", "Windows-1252"),
                                "apellido_paterno"=>$resultados[26],
                                "apellido_materno"=>$resultados[27],
                ],
                "estado_calidad" =>(object) [
                    "id"=>$resultados[28],
                    "nombre"=>mb_convert_encoding($resultados[29], "UTF-8", "Windows-1252")
                ],
                "uso_tarima" =>(object) [
                    "id"=>$resultados[30],
                    "nombre"=>mb_convert_encoding($resultados[31], "UTF-8", "Windows-1252")
                ]

            
            ];
            array_push($lista_tarimas,$tarima);

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
    echo json_encode($lista_tarimas);
}



function _post($datos)
{
    $respuesta = (object) array(
        'codigo' =>0,
        'error'=>"",
    );

    if(isset($datos->productoId) && isset($datos->cantidad) && isset($datos->unidades))
    {

        include("../conexion/conexion_sqlserver.php");

        $consulta = "INSERT INTO [CAYP_V1.0].dbo.Tarima
        (Id, ClaveId, OrigenId, ProductoId, TipoTarimaId, UsoTarimaId, LocalidadId, PuntoAccesoId, AlmacenId, DocumentoEntrada, DetalleDocumentoEntradaId, TipoEntradaId, EstadoCalidadId, LoteInterno, LoteProveedor, LoteFabricante, FechaCaducidad, FechaReanalisis, CajaPorTarima, UnidadesPorCaja, Cantidad, CostoPromedioTarima, TarimaAcarreo, TipoMovimientoTarimaId, PosicionLocalidad, FechaCreacion, UsuarioId, Activo)
        VALUES(0, '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', '', '', '', '', 0, 0, 0, 0, '', 0, 0, '', 0, 1)";

                    /*
        $consulta = "INSERT INTO [dbo].[ProductoVolumetrico] ([Id] ,[ProductoId],[UnidadMedida],[Alto],[Largo],[Ancho],[PesoBase] ,[UnidadesPesadas]
           ,[Peso],[Tarifa] ,[VolumenCalculado] ,[SinValidar])
        VALUES
            ((Select MAX(id)+1 from dbo.ProductoVolumetrico),?,?,?,?,?,?,?,?,?
            ,<ProductoId, int,>
            ,<UnidadMedida, varchar(50),>
            ,<Alto, numeric(12,4),>
            ,<Largo, numeric(12,4),>
            ,<Ancho, numeric(12,4),>
            ,<PesoBase, numeric(12,4),>
            ,<UnidadesPesadas, numeric(12,4),>
            ,<Peso, numeric(12,4),>
            ,<Tarifa, varchar(50),>
            ,<VolumenCalculado, tinyint,>
            ,<SinValidar, int,>)"

            $stmt = sqlsrv_query( $conn, $consulta, array("%".$filtro."%"));
*/

    }
    else
    {
        //echo "Sin datos";
        $respuesta->error = "Error: Sin datos";
    }
    echo json_encode($respuesta);
}


function _post2()
{
    $respuesta = (object) array(
        'duplicados' => array(),
        'cantidad_exito' =>0,
        'error'=>"",
    );

    if((isset($data->productoId) && isset($data->pass)) || isset($data->codigo_barras))
    {
        echo "Registrando";
    }



/*INSERT INTO [CAYP_V1.0].dbo.Tarima
(Id, ClaveId, OrigenId, ProductoId, TipoTarimaId, UsoTarimaId, LocalidadId, PuntoAccesoId, AlmacenId, DocumentoEntrada, DetalleDocumentoEntradaId, TipoEntradaId, EstadoCalidadId, LoteInterno, LoteProveedor, LoteFabricante, FechaCaducidad, FechaReanalisis, CajaPorTarima, UnidadesPorCaja, Cantidad, CostoPromedioTarima, TarimaAcarreo, TipoMovimientoTarimaId, PosicionLocalidad, FechaCreacion, UsuarioId, Activo)
VALUES(0, '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', '', '', '', '', 0, 0, 0, 0, '', 0, 0, '', 0, 1);
*/


}



?>