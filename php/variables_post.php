<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
</head>
<body>
    <?php

    $nombre=(isset($_POST['n'])?  $_POST['n']  : "Invitado");
    $n_control=(isset($_POST['c'])?  $_POST['c']  : "");
    $domicilio=(isset($_POST['d'])?  $_POST['d']  : "");

    ?>



    <h1>Nombre:  <?php echo $nombre; ?> </h1>
    <h2>No. Contro:<?php echo $n_control; ?></h2> 
    <h2>Domicilio: <?php echo $domicilio; ?> </h2>
</body>
</html>