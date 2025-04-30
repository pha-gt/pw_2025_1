<?php require("./componentes/encabezado.php"); ?>

<script>
    var lista_tarimas= [];
    window.addEventListener('load', function() {
        cargar_tarimas();

    });

    function cargar_tarimas(){
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
                lista_tarimas = JSON.parse(respuesta);
                //Generar la cadena html
                generar_tabla_tarimas();
            } else {
                //Si la conexión falla
                console.log('Error en la petición!');
                alert("Fracaso");
                return;
            }
        }
        //Por el primer parametro enviamos el tipo de petición (GET, POST, PUT, DELETE)
        //Por el segundo parametro la url de la API
        xhr.open('GET', "./API/cayp/Tarima.php");
        //Se envía la petición
        xhr.send();
    }


    function generar_tabla_tarimas()
    {
        html_tabla = `
            <table class="table table-striped" name="table" id="datatablesSimple">
                <thead>
                    <tr>
                        <th scope="col"> Clave</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Descripci&oacute;n</th>
                        <th scope="col">Est. Calidad</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Localidad</th>
                        <th scope="col">Cant.</th>
                        <th scope="col">Tipo</th>
                    </tr>
                </thead>
                <tbody>
                
                `;


                lista_tarimas.forEach(element => {
                    html_tabla = html_tabla +
                    `
                    <tr>
                    <td scope="row"> ${element.clave_id}</td>
                    <td scope="col"> ${element.producto.clave_id}</td>
                    <td scope="col"> ${element.producto.descripcion}</td>
                    <td scope="col"> ${element.estado_calidad.nombre}</td>
                    <td scope="col"> ${element.fecha_creacion}</td>
                    <td scope="col"> ${element.localidad.clave_id}</td>
                    <td scope="col"> ${element.cantidad}</td>
                    <td scope="col"> ${element.uso_tarima.nombre}</td>
                    </tr>
                    `;
                    
                });

                    
         html_tabla = html_tabla +
                `    
                </tbody>
            </table>
        `;
        $("#contenido").html(html_tabla);

        //let dataTable = new DataTable("#datatablesSimple");
        const datatablesSimple = document.getElementById('datatablesSimple');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
    }

</script>

<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">Administraci&oacute;n de Almac&eacute;n</h3>
        
        <div class="card mb-4">

            <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Rollos y Cajas
            </div>
            <div class="card-body">
                <div id= "contenido" >

                
                </div>
            </div>
        </div>
    </div>
</main>

<?php require("./componentes/pie_bd.php"); ?>