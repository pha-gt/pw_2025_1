<?php

    $mysqli = new mysqli("192.168.100.69", "fabian", "12345", "Ejemplo");
    if (mysqli_connect_errno()) {
       printf("Connect failed: %s\n", mysqli_connect_error());
       exit();
    }

   

?>
