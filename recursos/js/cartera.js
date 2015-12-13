function initializeCartera(){
    cargarTipoPrestamo();
    cargarFondoComplementario();
    cargarCuentaContable();
    $("#btnGenerarCertificadoCartera").click(function(){
        guardar();
    });
    $('#btnCancelarCertificadoCartera').click(function(){
        cancelar();  
    });
    $('#txtFechaEmisionCartera').datepicker({format:"dd/mm/yyyy"});
    $('#txtFechaPrestamoCartera').datepicker({format:"dd/mm/yyyy"});
}
function cargarTipoPrestamo(){
    $.ajax({
        type: "GET",
        url: "controladores/controlador.listas.php?accion=getListaTipoPrestamo",
        success: function(data) {
            $('#cbTipoPrestamoCartera').html('');
            $('#cbTipoPrestamoCartera').html(data);
        }
    });
}
function cargarFondoComplementario(){
    $.ajax({
        type: "GET",
        url: "controladores/controlador.listas.php?accion=getListaFondoComplementario",
        success: function(data) {
            $('#cbFondoComplementarioCartera').html('');
            $('#cbFondoComplementarioCartera').html(data);
        }
    });
}
function cargarCuentaContable(){
    $.ajax({
        type: "GET",
        url: "controladores/controlador.listas.php?accion=getListaCuentaContable",
        success: function(data) {
            $('#cbCuentaContableCartera').html('');
            $('#cbCuentaContableCartera').html(data);
        }
    });
}
function guardar(){
    $.ajax({
        type: "POST",
        url: "controladores/controlador.certificado.php",
        data: $("#formCertificadoCartera").serialize(),
        success: function(data) {
            //alert(data);
	    window.open("reportes/certificadoCartera.php?idCertificado="+data);
            $('#formCertificadoCartera')[0].reset();
            $('#myModal').modal('hide');
            $("#tblListaCertificados").dataTable().fnDraw();
        }
    });
}
function cancelar(){
    $('#formCertificadoCartera')[0].reset();
    $('#myModal').modal('hide');
}
