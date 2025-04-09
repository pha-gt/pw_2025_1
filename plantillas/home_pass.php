<?php
session_start();


if(isset($_POST["usuario"]) && isset($_POST["pass"]))
{
    if($_POST["pass"] == "123")
    {
        $_SESSION["USER_NAME"] = "FABIAN GONZALEZ";
        echo "Bienvenido";
        header('Location: '.'./home.php');
    }
    else
    {
        echo "Credenciales no validas";
        $_SESSION["MSJ_SESION"] = "Credenciales no validas";
        header('Location: '.'./home.php');


    }
}
else 
{
    echo "No fue posible iniciar sesion";
}

//header('Location: '.'./home.php');

?>