<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

    if(isset($_SESSION['USER_NAME']))
    {
        echo "<h1> Hola ".$_SESSION['USER_NAME']." </h1>";
        echo "<a href='./home_out.php'> Salir </a>";
    }
    else
    { 
        echo "<h1> Hola Inicia Sesion </h1>";

        echo '
           <form action="./home_pass.php" method="post">
                <input type="text" name="usuario" id="">
                <input type="password" name="pass" id="">
                <input type="submit" value="Iniciar sesion">
            </form>
        ';
    } 
?>

</body>
</html>

