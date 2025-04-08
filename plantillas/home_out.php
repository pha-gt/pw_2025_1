<?php
session_start();
unset($_SESSION["USER_NAME"]);
 
//header('Location: '.$_SERVER['HTTP_REFERER']);
header('Location: '.'./home.php');
?>