<?php
//Definir que la respuesta a la peticición es un Json y no html o texto plano
header('Content-Type: application/json; charset=utf-8');

//obtener el contenido de la petición
$postBody = file_get_contents("php://input");

//definir la función a realizar segun su metodo
switch($_SERVER['REQUEST_METHOD'])
{
    case 'POST':  //Create
        _post($postBody);
    break;
    case 'GET':   //Read
        _get();
    break;
    case 'PUT':   //Update
        _puts($postBody);
    break;
    case 'DELETE':   //Delete
        _delete($postBody);
    break;
    default:    //otro metodo no definido
        // Definir una respuesta de error e informar los metodos permitidos
        header('HTTP/1.1 405 Method not allowed');
        header('Allow: GET, PUT, DELETE, POST');
    break;    
}

//rutina para Create
function _post($datos)
{
}

//rutina para Read
function _get()
{
}

//rutina para Update
function _puts($datos)
{
}

//rutina para Delete
function _delete($datos)
{
}

?>
