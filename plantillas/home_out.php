<?php
session_start();
unset($_SESSION["USER_NAME"]);
echo "Fin de sesion";
 
//header('Location: '.$_SERVER['HTTP_REFERER']);

header('Location: '.'./home.php');
?>