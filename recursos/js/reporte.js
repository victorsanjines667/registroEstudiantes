

function cargaFormularioReporte(){
    var url = "controladores/controlador.archivo.php";
    $.ajax({
        type: "GET",
        url: url,
        data: "accion=datosCombosReporte",
        success: function(data) {
            datos = $.parseJSON(data);
            $("#cbCuentaContable").html(datos.comboCuenta);
        }
    });
}