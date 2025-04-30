<script>


    function mostrar_alerta_mensaje_cargando(texto="")
    {
        $("#modal_mensaje_alerta_footer_boton").html("");
        $("#modal_mensaje_alerta_footer_cancelar").html("<button type='button' class='btn btn-secondary' data-bs-dismiss='modal' disabled>"+ 
            "<span class='spinner-border spinner-border-sm' aria-hidden='true'></span>"+
            "<span role='status'>Loading...</span></button>");

        if(texto=="") $("#modal_mensaje_alerta_body").html("Cargando...");
        else $("#modal_mensaje_alerta_body").html(texto);

        $("#modal_mensaje_alerta").modal("show");

    }

    function mostrar_alerta_mensaje(texto,boton_alterno= "",boton_cancelar="")
    {
        $("#modal_mensaje_alerta_footer_boton").html(boton_alterno);
        if(boton_cancelar=="")
        {
            $("#modal_mensaje_alerta_footer_cancelar").html("<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>");
        }
        else
        {
            $("#modal_mensaje_alerta_footer_cancelar").html(boton_cancelar);
        }
        
        $("#modal_mensaje_alerta_body").html(texto);
        $("#modal_mensaje_alerta").modal("show");

    }


    function quitar_alerta_mensaje(){
        $("#modal_mensaje_alerta_footer_boton").html("");
        $("#modal_mensaje_alerta_body").html("");
        $("#modal_mensaje_alerta").modal("hide");
    }

</script>


<!-- Modal Mensajes -->
<div class="modal fade" id="modal_mensaje_alerta" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="10" aria-labelledby="modal_alerta_mensajeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_mensaje_alerta_Label">Orli Toldiva</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal_mensaje_alerta_body">
            
            </div>
            <div class="modal-footer">
                <div id="modal_mensaje_alerta_footer_boton"></div>
                <div id="modal_mensaje_alerta_footer_cancelar"></div>
            </div>
        </div>
    </div>
</div>


