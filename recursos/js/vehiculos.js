/**
 * Created by VICOSANJINES on 4/12/14.
 */
function calendarios(){
    //$('#datetimepicker2').datetimepicker();
}
function cargarFormularioVehiculo(){
    // alert (idEntidad + "siiiii");
    var url = "controladores/controlador.vehiculos.php";
    $("#accionVehiculo").val("listas");
    $.ajax({
        type: "POST",
        url: url,
        data: "accionVehiculo=listas",
        success: function(data) {
            datos = $.parseJSON(data);
            $("#comboEntidad").html(datos.comboEntidad);
            $("#comboSituacionActual").html(datos.comboSitActual);
            $("#comboClaseVehiculo").html(datos.comboClase);
            $("#comboEstadoFisico").html(datos.comboEstadoFisico);
            $("#comboFuncionario").html(datos.comboPersona);
            $("#comboEstadoActivo").html(datos.comboEstadoActivo);
            $("#comboMarca").html(datos.comboMarca);
            $("#comboFuenteAdquisicion").html(datos.comboFuenteAdquisicion);
        }
    });
}
function accionBotonVehiculo(){
    $("#btnAceptar").on("click",function(){
       //alert("prueba");
        $("#accionVehiculo").val("generarReporte");
        var url='controladores/controlador.vehiculos.php';
        $.ajax({
            type: "POST",
            url: url,
            data: $("#formReporteVehiculos").serialize(),
            success: function(data) {
               // alert(data);
                window.open('reportes/reporte.vehiculos.php?datos='+data,'_blank');

            }
        });
        $('#formReporteVehiculos').each (function(){
            this.reset();
        });
    });
}

function accionComboGrupo(){
    $('#chkModelo').click(function() {
        if ($(this).is(':checked')) {
            $('#comboAnio').attr("disabled",false);
            $('#txtModeloVehiculo').attr("disabled",false);
        } else {
            $('#comboAnio').attr("disabled",true);
            $('#txtModeloVehiculo').attr("disabled",true);
        }
    });
    $('#checkValorUsd').click(function() {
        if ($(this).is(':checked')) {
            $('#comboMontoSus').attr("disabled",false);
            $('#txtValorUsd').attr("disabled",false);
        } else {
            $('#comboMontoSus').attr("disabled",true);
            $('#txtValorUsd').attr("disabled",true);
        }
    });
    $('#checkValorBs').click(function() {
        if ($(this).is(':checked')) {
            $('#comboMontoBs').attr("disabled",false);
            $('#txtValorBs').attr("disabled",false);
        } else {
            $('#comboMontoBs').attr("disabled",true);
            $('#txtValorBs').attr("disabled",true);
        }
    });
}