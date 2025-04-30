<?php

	$serverName = "192.168.100.69\\sqlexpress, 1443";
	$connectionInfo = array( "Database"=>"Ejemplo", "UID"=>"sa", "PWD"=>'12345');
	$conn = sqlsrv_connect( $serverName, $connectionInfo);

	if( $conn ) {
     	//echo "Connection established.<br />";
	}else{
		echo "Connection could not be established.<br />";
		die( print_r( sqlsrv_errors(), true));
	}	
?>
