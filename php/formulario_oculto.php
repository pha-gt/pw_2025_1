<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if(isset($_GET['n']))
{
?>

HOLA <?php echo $_GET['n']?>
<?php
}
else
{
?>
<form method="GET" >
    <input type="text" name = 'n'>
    <input type="submit">
</form>



<?php
}
?>
    
</body>
</html>