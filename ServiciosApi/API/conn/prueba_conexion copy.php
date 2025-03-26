<?php
//Servidor, usuario, password, bd
$mysqli = new mysqli("127.0.0.1", "root", "12345678");
if(mysqli_connect_errno()){
    printf("Connect failed: %s\n", mysqli_connect_error());
}
else{
    printf("exito");
}
$mysqli->close();

?>
