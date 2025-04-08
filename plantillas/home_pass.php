<?php
session_start();


if(isset($_POST["usuario"]) && isset($_POST["pass"]))
{
    if($_POST["pass"] == "123")
    {
        $_SESSION["USER_NAME"] = "FABIAN GONZALEZ";
        echo "Bienvenido";
    }
    else
    {
        echo "Credenciales no validas";
    }
}
else 
{
    echo "No fue posible iniciar sesion";
}

header('Location: '.'./home.php');

?>