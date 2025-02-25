<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    if(  isset($_GET['nombre'])  )
    {
        $mi_nombre = $_GET['nombre'];
    }
    else
    {
        $mi_nombre = "Invitado";
    }

    if( isset($_GET['c']))
    {
        $color=$_GET['c'];
    }
    else
    {
        $color='blue';
    }

    if(isset($_GET['n']))
    {
        $num = $_GET['n'];
    }
    else
    {
        $num = 1;
    }

    for($i =0;$i<$num;$i++)
    {
        echo "<h1 style='color:".$color.";' >Hola ".$mi_nombre."</h1>";
    }

   



    
    ?>
    


    
</body>
</html>