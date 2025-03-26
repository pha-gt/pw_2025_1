<?php
include("./componentes/encabezado.php");
?>
<script>
    //Evento para realizar la carga de cancional al terminar de cargar
    window.addEventListener('load', function() {
        //obtener_musica();
    });

    
    var lista_musica;
    var indice_edicion;


function obtener_musica(){
    //Declaramos una nueva instancia de XMLHttpRequest
    let xhr = new XMLHttpRequest();
    let respuesta;

    //Esta función se ejecutará tras la petición
    xhr.onload = function () {
        //Si la petición es exitosa
        if (xhr.status >= 200 && xhr.status < 300) {
            //Mostramos un mensaje de exito y el contenido de la respuesta
            //console.log( xhr.response);
            respuesta = xhr.response;
            //Guardar en lista musica la respuesta
            lista_musica = JSON.parse(respuesta);
            //invocamos generar la tabla
            crearTabla(lista_musica);

            console.dir(lista_musica);
        } else {
            //Si la conexión falla
            console.log('Error en la petición!');
            alert("Fracaso");
            return;
        }
    }
    //Por el primer parametro enviamos el tipo de petición (GET, POST, PUT, DELETE)
    //Por el segundo parametro la url de la API
    xhr.open('GET', "./API/MelodiaAPI.php");
    //Se envía la petición
    xhr.send();
}

function solicitar_agregar()
{
    //limpiar campos 
    //vanilla
    let input_titulo = document.getElementById('input_titulo');
    input_titulo.value= "";
    //jquery
    $("#input_artista").val("");
    $("#input_duracion").val("");

    //mostrar modal
    $("#modal_agregar").modal("show");
}

function solicitar_editar(indice)
{
    //guadar en variable globales el indice
    indice_edicion= indice;
    //obtener registro de lista
    let melodia_editar = lista_musica[indice_edicion];

    //cargar los valores actuales en la ventana de edicion
    //vanilla
    let input_titulo = document.getElementById('input_titulo_editar');
    input_titulo.value= melodia_editar.titulo;
    //jquery
    $("#input_artista_editar").val(melodia_editar.artista);
    $("#input_duracion_editar").val(melodia_editar.duracion);

    //mostrar modal
    $("#modal_editar").modal("show");

}

function registrar()
{
    //obtener los valores 
    //vanilla
    let input_titulo = document.getElementById('input_titulo');
    let nuevo_titulo = input_titulo.value;
    //jquery
    let nuevo_artista = $("#input_artista").val();
    let nuevo_duracion = $("#input_duracion").val();
    
    let nueva_melodia={
        "titulo":nuevo_titulo,
        "artista":nuevo_artista,
        "duracion":nuevo_duracion
    }

    //Declaramos una nueva instancia de XMLHttpRequest
    let xhr = new XMLHttpRequest();
    let respuesta;

    //Esta función se ejecutará tras la petición
    xhr.onload = function () {
        //Si la petición es exitosa
        if (xhr.status >= 200 && xhr.status < 300) {
            //Mostramos un mensaje de exito y el contenido de la respuesta
            //console.log( xhr.response);
            respuesta = xhr.response;
            //Guardar en lista musica la respuesta
            if(respuesta==1)
            {
                alert("Exito");
                //quitar modal
                $("#modal_agregar").modal("hide");
                //volver a cargar la lista de musica
                obtener_musica();
            }
            else
            {
                alert("No fue posible agregar");
            }
        } else {
            //Si la conexión falla
            console.log('Error en la petición!');
            alert("Fracaso");
            return;
        }
    }
    //Por el primer parametro enviamos el tipo de petición (GET, POST, PUT, DELETE)
    //Por el segundo parametro la url de la API
    xhr.open('POST', "./API/MelodiaAPI.php");
    //Se envía la petición con los datos
    xhr.send(JSON.stringify(nueva_melodia));
    
}

function actualizar()
{
    //obtener los valores 
    //vanilla
    let input_titulo = document.getElementById('input_titulo_editar');
    let titulo_editar = input_titulo.value;
    //jquery
    let artista_editar = $("#input_artista_editar").val();
    let duracion_editar = $("#input_duracion_editar").val();
    
    //obtener id a editar
    let melodia_editar = lista_musica[indice_edicion];
    let id_editar= melodia_editar.id;

    let nueva_melodia={
        "melodia":id_editar,
        "titulo":titulo_editar,
        "artista":artista_editar,
        "duracion":duracion_editar
    }

    //Declaramos una nueva instancia de XMLHttpRequest
    let xhr = new XMLHttpRequest();
    let respuesta;

    //Esta función se ejecutará tras la petición
    xhr.onload = function () {
        //Si la petición es exitosa
        if (xhr.status >= 200 && xhr.status < 300) {
            //Mostramos un mensaje de exito y el contenido de la respuesta
            //console.log( xhr.response);
            respuesta = xhr.response;
            //Guardar en lista musica la respuesta
            if(respuesta==1)
            {
                alert("Exito");
                //quitar modal
                $("#modal_editar").modal("hide");
                //volver a cargar la lista de musica
                obtener_musica();
            }
            else
            {
                alert("No fue posible agregar");
            }
        } else {
            //Si la conexión falla
            console.log('Error en la petición!');
            alert("Fracaso");
            return;
        }
    }
    //Por el primer parametro enviamos el tipo de petición (GET, POST, PUT, DELETE)
    //Por el segundo parametro la url de la API
    xhr.open('PUT', "./API/MelodiaAPI.php");
    //Se envía la petición con los datos
    xhr.send(JSON.stringify(nueva_melodia));
    
}




function crearTabla(lista_musica){
    //definir las sentencias html para el inicio de la tabla
    let texto_html=
    `<table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">Titulo</th>
            <th scope="col">Artista</th>
            <th scope="col">Duraci&oacute;n</th>
            <th scope="col">Archivo</th>
            <th scope="col">Operaci&oacute;n</th>
            </tr>
        </thead>
        <tbody>`;
    
    //por cada elemento de la lista crear un reglo de tabla
    for(let i=0;i<lista_musica.length;i++)
    {
        texto_html = texto_html+
        "<tr>"+
        "<td>"+lista_musica[i].titulo+"</td>"+
        "<td>"+lista_musica[i].artista+"</td>"+
        "<td>"+lista_musica[i].duracion+"</td>"+
        "<td>"+lista_musica[i].archivo+"</td>"+
        "<td>"+
            "<button class='btn btn-sm btn-info mx-2' onclick='solicitar_editar("+i+");'> Editar</button>"+
            "<button class='btn btn-sm btn-danger mx-2'> Eliminar</button>"+
        "</td>"+
        "</tr>";

    }
   
    

    //definir las sentencias html para el inicio de la tabla
    texto_html=texto_html+
    `   </tbody>
    </table>`;

    //agregar html en el componente
    let espacio_tabla = document.getElementById('div_tabla');
    espacio_tabla.innerHTML= texto_html;

    //alternativa con jquery
    //$("#div_tabla").html(texto_html);


}



</script>


<h3>Melodias</h3>
<button class='btn btn-sm btn-primary mx-2' onclick="solicitar_agregar();"> Agregar</button>
<button class='btn btn-sm btn-primary mx-2' onclick="obtener_musica();"> Actualizar</button>

<div id="div_tabla">
</div>


<!-- Modal Agregar -->
<div class="modal fade" id="modal_agregar" tabindex="-1" aria-labelledby="modal_agregar_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Melodia</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="mb-3">
            <label for="input_titulo" class="form-label">Titulo</label>
            <input type="text" class="form-control form-control-sm" id="input_titulo" placeholder="">
        </div>
        <div class="mb-3">
            <label for="input_artista" class="form-label">Artista</label>
            <input type="text" class="form-control form-control-sm" id="input_artista" placeholder="">
        </div>
        <div class="mb-3">
            <label for="input_duracion" class="form-label">Duracion</label>
            <input type="text" class="form-control form-control-sm" id="input_duracion" placeholder="">
        </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" onclick="registrar();" >Guardar</button>
        </div>
    </div>
  </div>
</div>


<!-- Modal Agregar -->
<div class="modal fade" id="modal_editar" tabindex="-1" aria-labelledby="modal_editar_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modal_editar_label">Editar Melodia</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="mb-3">
            <label for="input_titulo" class="form-label">Titulo</label>
            <input type="text" class="form-control form-control-sm" id="input_titulo_editar" placeholder="">
        </div>
        <div class="mb-3">
            <label for="input_artista" class="form-label">Artista</label>
            <input type="text" class="form-control form-control-sm" id="input_artista_editar" placeholder="">
        </div>
        <div class="mb-3">
            <label for="input_duracion" class="form-label">Duracion</label>
            <input type="text" class="form-control form-control-sm" id="input_duracion_editar" placeholder="">
        </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" onclick="actualizar();" >Guardar</button>
        </div>
    </div>
  </div>
</div>













<?php
include("./componentes/pie.php");
?>