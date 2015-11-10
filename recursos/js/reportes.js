

function generarReporteCaja41(){
    $('#btnReporte41').on('click',function(){
        var idcuenta=$('#cbCuentaContable').val();
        var fechaInicio=$('#fechainicio').val();
        var fechaFin = $('#fechafin').val();

        if(idcuenta == ''|| fechaInicio == '' || fechaFin == ''){
            alert('Debe seleccionar los datos para generar el Reporte');
        }else{
            window.open('reportes/reporte41.php?idcuenta='+idcuenta+'&fechainicio='+fechaInicio+'&fechafin='+fechaFin);
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
