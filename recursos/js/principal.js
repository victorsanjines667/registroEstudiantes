var idEntidad;
var filaTblEntidad;
var filatablaMaquinariaGeneral;
var filatablaMaquinariaPesada;
var filatablaDocumentacionMaquinariaGeneral;

function OperacionesPanelPrincipal(){
    $(".menu_superior button").on("click",function(){
        var pantalla = $(this).val();
        abrirPantalla(pantalla);
    });
}

function abrirPantalla(pantalla){
    $.ajax({
            type:'POST',
            url:"controladores/controlador.pantallas.php",
            data:{pantalla:pantalla},
            success:function(data){
                $("#contenido").html(data);
            }
        });
}

$.fn.cargando = function(){
    this.html("<img src='recursos/imagenes/cargando_ajax.gif' alt='' />");
}

function cargarPantalla(nombreDivCarga, nombrePantalla){
    $("#"+nombreDivCarga).cargando();
    $.ajax({
        type:'POST',
        url:'controladores/controlador.pantallas.php',
        data:{pantalla:nombrePantalla},
        success:function(data){
            $("#"+nombreDivCarga).html(data);
        }
    });
}

function btnCerrar(){
$("#btnCerrarSesion").on("click",function(event){
        event.preventDefault();
		
        cerrarSesion();
    })
}

function cerrarSesion(){
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
}

function fechas(){
 $("#fechainicio").datepicker({
    //format: "dd/mm/yyyy",
    format: "yyyy-mm-dd",
	orientation: "top left",
    language: "es"
 });
	 
 $("#fechafin").datepicker({
    //format: "dd/mm/yyyy",
    format: "yyyy-mm-dd",
	orientation: "top left",
    language: "es"
 });
	 
}

function abrirDialogoContrasenia(){
    $('#cambiaContrasenia').on('click',function(){
        $('#ModalCambiaContrasenia').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#ModalCambiaContrasenia').modal('show');
    });
}

function botonesDialogoContrasenia(){
    $('#btnGuardarCambio').on('click',function(){
        guardarCambio();
    });
    $('#btnCancelarCambio').on('click',function(){
        $('#ModalCambiaContrasenia').modal('hide');
    });
}

function guardarCambio(){
        $('#accionUsuario').val('guardaCambios');
        var url = "controladores/controlador.usuario.php";
        var datos = $('#formularioContrasenia').serialize();
        $.ajax({
            type: "GET",
            url: url,
            data: datos,
            success: function(data) {
                if(data>0){
                    alert("La contrasenia fue cambiada exitosamente ");
                    $('#txtNuevaContrasenia').val('');
                    $('#txtAnteriorContrasenia').val('');
                    $('#txtAnteriorContrasenia2').val('');
                    $('#ModalCambiaContrasenia').modal('hide');
                }else if (data == -1){
                          alert("debe repetir la contrasenia correctamente");
                      }
                      else {
                        alert("Se produjo un error al validar el documento, favor comunicarse con soporte técnico "+data);
                    }
            }
        });
}