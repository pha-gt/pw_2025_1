<?php require("./componentes/encabezado.php"); ?>
<script>
    var producto_id_seleccionado = null;
    var lista_productos= null;
    var lista_productos_filtrados= null;

    window.addEventListener('load', function() {
        //obtener_musica();
        cargar_uso_tarima();
        cargar_estado_calidad();
        cargar_lista_productos();
    });



    function cargar_uso_tarima(){
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
                //Guardar en lista de usos de tarima
                let lista_uso_tarima = JSON.parse(respuesta);
                //Generar la cadena html
                let html_code = "";
                lista_uso_tarima.forEach(element => {
                    html_code = html_code + "<option value='"+element.id+"'>"+element.nombre+"</option>"
                });
                //Sustituir el texto del componente
                $("#select_uso_tarima").html(html_code);
            } else {
                //Si la conexión falla
                console.log('Error en la petición!');
                alert("Fracaso");
                return;
            }
        }
        //Por el primer parametro enviamos el tipo de petición (GET, POST, PUT, DELETE)
        //Por el segundo parametro la url de la API
        xhr.open('GET', "./API/cayp/UsoTarima.php");
        //Se envía la petición
        xhr.send();
    }


    

    function cargar_estado_calidad(){
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
                //Guardar en lista de estados de calidad
                let lista_estado_calidad = JSON.parse(respuesta);
                //Generar la cadena html
                let html_code = "";
                lista_estado_calidad.forEach(element => {
                    html_code = html_code + "<option value='"+element.id+"'>"+element.nombre+"</option>"
                });
                //Sustituir el texto del componente
                $("#select_estado_calidad").html(html_code);
            } else {
                //Si la conexión falla
                console.log('Error en la petición!');
                alert("Fracaso");
                return;
            }
        }
        //Por el primer parametro enviamos el tipo de petición (GET, POST, PUT, DELETE)
        //Por el segundo parametro la url de la API
        xhr.open('GET', "./API/cayp/EstadoCalidad.php");
        //Se envía la petición
        xhr.send();
    }

    function cargar_lista_productos(){
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
                //Guardar en lista de producto
                lista_productos  = JSON.parse(respuesta);
                
            } else {
                //Si la conexión falla
                console.log('Error en la petición de lista!');
                alert("Fracaso");
                return;
            }
        }
        //Por el primer parametro enviamos el tipo de petición (GET, POST, PUT, DELETE)
        //Por el segundo parametro la url de la API
        xhr.open('GET', "./API/cayp/Producto.php");
        //Se envía la petición
        xhr.send();
    }

    function mostrar_modal_producto()
    {
        $('#moda_producto').modal('show');
        if($('#input_buscar_producto').val() !="")
        {
            let palabra_filtro_producto = $('#input_buscar_producto').val();
            $('#input_filtro_producto').val(palabra_filtro_producto);
            actualizar_select_productos();
        }
        else
        {
            $('#input_filtro_producto').val("");
            $("#select_producto").html("");

        }


    }

    function actualizar_select_productos(){

        if($('#input_filtro_producto').val() !="")
        {
            buscarPorPatron(lista_productos,$('#input_filtro_producto').val())
        }
        else
        {
            lista_productos_filtrados = lista_productos;
        }
       
        let html_code = "";
        lista_productos_filtrados.forEach(element => {
            html_code = html_code + "<option value='"+element.id+"'>"+element.nombre+"</option>"
        });
        //Sustituir el texto del componente
        $("#select_producto").html(html_code);

    }

    function establecer_producto_seleccionado()
    {
        //guardar valor
        producto_id_seleccionado =  $("#select_producto").val();

        //copiar el texto del compoente encontrado
        let descripcion_seleccionada = $("#select_producto :selected" ).text();
        $("#textarea_produto").val(descripcion_seleccionada);

        //limpiar componente
        $('#input_filtro_producto').val("");
        $("#select_producto").html("");

        //ocultar modal
        $('#moda_producto').modal('hide');

    }

    function buscarPorPatron(lista, patron) {
        //eliminar espacios extras en el patron
        patron = patron.replace(/\s+/g, " ").trim();

        //Agregar espacios a los extremos para palabras a mitad
        patron = " "+patron+" "

        if(lista_productos != null && lista_productos.length > 0)
        {
            // Convertir el patrón con % en una expresión regular
               // const regex = new RegExp(`^${patron.replace(/%/g, '.*')}$`, 'i');
                const regex = new RegExp(`^${patron.replace(/ /g, '.*')}$`, 'i');

            // Filtrar los objetos cuyo atributo "nombre" coincida con el patrón
            lista_productos_filtrados = lista_productos.filter(obj => regex.test(obj.nombre));
            //return lista_productos_filtrados;
        }
        else lista_productos_filtrados = null;
        //else return null;

    }

    function registrar_tarimas()
    {
        let datos = {
            producto_id:producto_id_seleccionado,
            tipo_tarima_id:$("#select_uso_tarima").val(),
        };
        var jqxhr = $.post( "./API/cayp/Tarimas.php", datos)
        .done(function (data) {
            $('#modal_contenido').html('Registrado correctamente.');
            modal_solo_cerrar();
            setTimeout(function(){
                window.location.reload();
            }, 1000);
        }).fail(function (msg) {
            $('#modal_contenido').html('No fue posible registrar.' +msg.responseText);
            console.dir(msg)
        }).always(function (msg) {
        });

    }

        




    




</script>




<main>
<div class="container-fluid px-4">
        <h3 class="mt-4">Recepci&oacute;n de producto</h3>
        
        <div class="card mb-4">

            <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Registro
            </div>
            <div class="card-body">
                <div class="container" >
                    <div class="row">
                            <div class="col-md-12 mb-2"> 
                                <label for="input_buscar_producto" class=" form-label form-label-sm ">Clave del producto:</label>
                                <div class="input-group input-group-sm mb-3 ">
                                    <input type="text" class="form-control" placeholder="Seleccionar" aria-label="Seleccionar" aria-describedby="btn_buscar_producto" id="input_buscar_producto">
                                    <button class="btn btn-warning" type="button" id="button-btn_buscar_producto" onclick="mostrar_modal_producto();" > <img src="./img/buscar.png" alt="">  </button>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2"> 
                                <label for="textarea_produto" class="form-label">Descripci&oacute;n:</label>
                                <textarea class="form-control form-control-sm" placeholder="Descripci&oacute;n" id="textarea_produto" rows="2" readonly ></textarea>
                            </div>
                            <div class="col-md-12 mb-2"> 
                                <label for="input_documento_referencia" class=" form-label form-label-sm ">Documento de Referencia:</label>
                                <input type="text" class="form-control form-control-sm"  name="" placeholder="Documento de referencia" id="input_documento_referencia" value="" > 
                            </div>
                            <div class="col-md-12 mb-2"> 
                                <label for="select_estado_calidad" class=" form-label form-label-sm ">Estado de calidad:</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="select_estado_calidad">
                                    <option ></option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select> 
                            </div>
                            <div class="col-md-12 mb-2"> 
                                <label for="select_uso_tarima" class=" form-label form-label-sm ">Tipo de contendor:</label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="select_uso_tarima">
                                    <option ></option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select> 
                            </div>
                            <div class="col-md-6 mb-2"> 
                                <label for="input_cantidad" class=" form-label form-label-sm ">Cantidad por contenedor: </label>
                                <input type="text" class="form-control form-control-sm"  name="" placeholder="Cantidad"  id="input_cantidad" value="" > 
                            </div>
                            <div class="col-md-6 mb-2"> 
                                <label for="input_contenedor" class=" form-label form-label-sm ">N&uacute;mero de contenedores:</label>
                                <input type="text" class="form-control form-control-sm"  name="" placeholder="Contenedores"  id="input_contenedor" value="" > 
                            </div>
                            <div class="col-md-12 mb-2"> 
                                <label for="input_localidad" class=" form-label form-label-sm ">Localidad(opcional):</label>
                                <div class="input-group input-group-sm mb-3 ">
                                    <input type="text" class="form-control" placeholder="Seleccionar" aria-label="Seleccionar" aria-describedby="btn_buscar_localidad" id="input_localidad">
                                    <button class="btn btn-warning" type="button" id="btn_buscar_localidad"> <img src="./img/buscar.png" alt=""></button>
                                </div> 
                            </div>
                            <div class="col-md-12 mb-2"> 
                                <div>
                                    <button class="btn btn-secondary float-end m-2" href="#" role="button" onclick=""> Limpiar </button>
                                    <button class="btn btn-success float-end m-2" href="#" role="button" onclick="verificar_formulario();"> Registrar </button>
                                </div>
                            </div>
                    </div>
                </div>
                    

            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="moda_producto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Buscar producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                <input type="text" class="form-control" placeholder="Seleccionar" aria-label="Seleccionar" onchange="actualizar_select_productos();" id="input_filtro_producto">
                    <select class="form-select" size="8" aria-label="Resultados" id="select_producto">

                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="establecer_producto_seleccionado();" >Registar</button>
                </div>
            </div>
		</div>
    </div>

</main>

<?php require("./componentes/pie.php"); ?>