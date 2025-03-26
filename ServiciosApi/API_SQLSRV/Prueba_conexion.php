<?php

$serverName = "192.168.10.69\\sqlexpress, 1443";
$connectionInfo = array( "Database"=>"musica", "UID"=>"sa", "PWD"=>'cayp2018N');
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
    echo "Connection established.<br />";
}else{
    echo "Connection could not be established.<br />";
    die( print_r( sqlsrv_errors(), true));
}	


try{
    sqlsrv_close ($conn );
}
catch(Exception $ex2){}

?>