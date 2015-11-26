var hlr;
var aux;
function rutinasPanelPrincipal(){
    $(".opcionMenuHorizontal").on("click",function(event){
        event.preventDefault();
        var contenido = $(this).attr("cont");
        var titulo = $(this).attr("titulo");
        var id = $(this).attr("id")
        switch(id){
            case 'btnEditarContabilidad':
                cargarContenidoDialogoEdicionContabilidad(contenido,titulo);
                break;
            case 'btnEditarJuridica': 
                cargarContenidoDialogoEdicionJuridica(contenido,titulo);
                break;
            default:
                cargarContenidoDialogo(contenido,titulo);
                switch(id){
                    case 'btnNuevoContabilidad':
                        $("#btnContabilidadGuardar").show();
                        $("#btnContabilidadActualizar").hide();
                        break;
                    default:
                        break;
                }
                break;
        }
        despliegaDialogoCertificado();
    });
    $('#btnEditarCertCartera').click(function(){
        editarCertificadoCartera(); 
    });
    cargarTablaCertificados();
    cerrarSesion();
    imprimirCertificado();
}

function asignarClicTablaCertificado(){
    $('#tblListaCertificados tbody').on('click', 'tr', function(){
         var id = $('td', this).eq(0).text();
         if (hlr) {
            $("td:first", hlr).parent().children().each(function() {
                $(this).removeClass('markrow');
            });
            $('#idCertificado').val(0);
         }
         hlr = this;
         $("td:first", this).parent().children().each(function() {
            $(this).addClass('markrow');
         });
         $('#idCertificado').val(id);
		 aux = id;
     });
}

function despliegaDialogoCertificado(){
    $('#myModal').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#myModal').modal('show');
}

function cargarContenidoDialogo(nombreContenido,titulo){
    $("#myModalLabel").text(titulo);
    $.ajax({
        url:'controladores/controlador.pantallas.php',
        type:'POST',
        data:{pantalla:nombreContenido},
        success:function(data){
            $("#contenidoModal").html(data);
        }
    });
}
function cargarContenidoEditarDialogo(nombreContenido,titulo,variableAccion,idCertificado){
    $("#myModalLabel").text(titulo);
    $.ajax({
        url:'controladores/controlador.pantallas.php',
        type:'POST',
        data:{pantalla:nombreContenido},
        success:function(data){
            $("#contenidoModal").html(data);
            $.ajax({
                url:'controladores/controlador.certificado.php',
                type:'POST',
                data:{accion:variableAccion,id:idCertificado},
                success:function(data){
                    var resultado = $.parseJSON(data);
                    $('#txtNombreCompletoCartera').val(resultado.nombrecompleto);
                    $('#txtCiCartera').val(resultado.ci);
                    $("#cbCuentaContableCartera option[value=" + resultado.idcuentacontable + "]").attr("selected", true);
                    $('#txtMontoLiteralCartera').val(resultado.monto);
                    $("#cbTipoPrestamoCartera option[value=" + resultado.idtipoprestamo + "]").attr("selected", true);
                    $('#cbFondoComplementarioCartera').val(resultado.idfondocomplementario);
                    $('#txtHojaRutaCartera').val(resultado.hojaruta);
                    $('#txtNombreSolicitanteCartera').val(resultado.nombresolicitante);
                    $('#txtFechaPrestamoCartera').val(resultado.fecha);
                    $('#accion').val('editarCertificacionCartera');
                    $('#idCertificacionCartera').val(resultado.id);
                    $("#cbGeneroCartera option[value='"+resultado.articulo+"']").attr("selected", true);
                    $('#txtFechaEmisionCartera').val(resultado.fechaemision);
                    $("#cbProcedenciaCartera option[value='"+resultado.procedenciaci+"']").attr("selected", true);
                }
            });
        }
    });
}
function cargarTablaCertificados(){
    $("#tblListaCertificados").dataTable({
        "bProcessing": true,
        "bServerSide": true,
        "bFilter": true,
        "bDestroy" : true,
        "bSort": true,
        "aaSorting": [[0, "desc"]],
        "aLengthMenu": [[20, -1], [20,50,100, "Todo"]],
        "iDisplayLength": 20,
        "sAjaxSource": "controladores/controlador.certificado.php?accion=poblarCertificados",
        "aoColumns": [
            {"mData": "id", "sClass": "left", "sTitle": "Nro"},
            {"mData": "nombrecompleto", "sClass": "left", "sTitle": "Nombre Completo"},
            {"mData": "ci", "sClass": "left", "sTitle": "C.I."},
            {"mData": "cite", "sClass": "left", "sTitle": "Cite"},
            {"mData": "fechacertificado", "sClass": "left", "sTitle": "Fecha Creacion"},
            {"mData": "hojaruta", "sClass": "left", "sTitle": "Hoja de Ruta"},
            {"mData": "nombresolicitante", "sClass": "left", "sTitle": "Solicitante"},
			{"mData": "fondo", "sClass": "left", "sTitle": "Fondo Complementario"}
        ],
        "oLanguage": {
            "sUrl": "recursos/idioma/Spanish.json"
        }
    });
}
function editarCertificadoCartera(){
    var idCertificado = $('#idCertificado').val();
    if(idCertificado != ''){
        var idCertificado = $('#idCertificado').val();
        var variableAccion = "getCertificado";
        cargarContenidoEditarDialogo("editarCertCartera","Editar Certificado de Cartera",variableAccion,idCertificado);
        despliegaDialogoCertificado();
    }else{
        alert("Debe seleccionar un certificado para editar");
    }    
}

function cerrarSesion(){
      $("#btnCierraSesionCertificados").on("click",function(event){
        event.preventDefault();
        var dirurl = "index.php";
        $.ajax({
            type: "POST",
            url: dirurl,
            data: {cerrarsesion: 1},
            success: function(data) {
                //console.log(data);
                window.location.href = dirurl;
            }
        });
    })
}

function imprimirCertificado(){
    $("#btnImprimirContabilidad").on("click",function(event){
        var idCertificado = $('#idCertificado').val();
         if(idCertificado != ''){
            var url = 'controladores/controlador.certificado.php';
            $("#frmImprimeCertificado").attr("action",url);
            $("#txtImprimeCertificadoId").val(idCertificado);            
            $("#frmImprimeCertificado").submit();
         }else{
              alert("Debe seleccionar un certificado para imprimir");
         }
    });
}

