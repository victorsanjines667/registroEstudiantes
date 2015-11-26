function setCombosFormularioInmuebles(){
    var url = "controladores/controlador.inmuebles.php";
    cargarCombo("opcion=tipoInmueble","divComboTipoInmueble",url);
    cargarCombo("opcion=entidades","divComboEntidad",url);
    cargarCombo("opcion=situacionActual","divSituacionActual",url);
    //cargarCombo("opcion=departamento","divDepartamento",url);
    cargarCombo("opcion=tipoDisposicion","divTipoDisp",url);
}
function setAccionChecksFormularioInmuebles(){
    $('#chkTipoInmueble').click(function() {
        if ($(this).is(':checked')) {
            $('#comboTipoInmueble').attr("disabled",false);
        } else {
            $('#comboTipoInmueble').attr("disabled",true);
        }
    });
    $('#chkEntidad').click(function() {
        if ($(this).is(':checked')) {
            $('#lstEntidades').attr("disabled",false);
        } else {
            $('#lstEntidades').attr("disabled",true);
        }
    });
    $('#chkSituacionActual').click(function() {
        if ($(this).is(':checked')) {
            $('#lstSituacionActual').attr("disabled",false);
        } else {
            $('#lstSituacionActual').attr("disabled",true);
        }
    });
    $('#chkMedidaSuperficie').click(function() {
        if ($(this).is(':checked')) {
            $('#comboMedidaSuperficie').attr("disabled",false);
        } else {
            $('#comboMedidaSuperficie').attr("disabled",true);
        }
    });
    $('#chkSupTerreno').click(function() {
        if ($(this).is(':checked')) {
            $('#comboOpcionTerreno').attr("disabled",false);
            $('#txtSupTerreno').attr("disabled",false);
        } else {
            $('#comboOpcionTerreno').attr("disabled",true);
            $('#txtSupTerreno').attr("disabled",true);
        }
    });
    $('#chkSupConstruida').click(function() {
        if ($(this).is(':checked')) {
            $('#comboOpcionConstruida').attr("disabled",false);
            $('#txtSupConstruida').attr("disabled",false);
        } else {
            $('#comboOpcionConstruida').attr("disabled",true);
            $('#txtSupConstruida').attr("disabled",true);
        }
    });
    $('#chkCertCastastral').click(function() {
        if ($(this).is(':checked')) {
            $('#txtCertCastastral').attr("disabled",false);
        } else {
            $('#txtCertCastastral').attr("disabled",true);
        }
    });
    $('#chkInmuebleMunicipal').click(function() {
        if ($(this).is(':checked')) {
            $('#txtInmuebleMunicipal').attr("disabled",false);
        } else {
            $('#txtInmuebleMunicipal').attr("disabled",true);
        }
    });
    $('#chkImpuestos').click(function() {
        if ($(this).is(':checked')) {
            $('#txtImpuestos').attr("disabled",false);
        } else {
            $('#txtImpuestos').attr("disabled",true);
        }
    });
    $('#chkAvaluador').click(function() {
        if ($(this).is(':checked')) {
            $('#txtAvaluador').attr("disabled",false);
        } else {
            $('#txtAvaluador').attr("disabled",true);
        }
    });
    $('#chkValorAvaluado').click(function() {
        if ($(this).is(':checked')) {
            $('#comboValorAvaluado').attr("disabled",false);
            $('#txtValorAvaluado').attr("disabled",false);
        } else {
            $('#comboValorAvaluado').attr("disabled",true);
            $('#txtValorAvaluado').attr("disabled",true);
        }
    });
    $('#chkFechaAvaluo').click(function() {
        if ($(this).is(':checked')) {
            $('#txtFechaAvaluo').attr("disabled",false);
        } else {
            $('#txtFechaAvaluo').attr("disabled",true);
        }
    });
    $('#chkDepartamento').click(function() {
        if ($(this).is(':checked')) {
            $('#lstDepartamento').attr("disabled",false);
        } else {
            $('#lstDepartamento').attr("disabled",true);
        }
    });
    $('#chkMunicipio').click(function() {
        if ($(this).is(':checked')) {
            $('#lstMunicipio').attr("disabled",false);
        } else {
            $('#lstMunicipio').attr("disabled",true);
        }
    });
    $('#chkZona').click(function() {
        if ($(this).is(':checked')) {
            $('#txtZona').attr("disabled",false);
        } else {
            $('#txtZona').attr("disabled",true);
        }
    });
    $('#chkDireccion').click(function() {
        if ($(this).is(':checked')) {
            $('#txtDireccion').attr("disabled",false);
        } else {
            $('#txtDireccion').attr("disabled",true);
        }
    });
    $('#chkModalidadDisp').click(function() {
        if ($(this).is(':checked')) {
            $('#comboModalidad').attr("disabled",false);
        } else {
            $('#comboModalidad').attr("disabled",true);
        }
    });
    $('#chkTipoDisp').click(function() {
        if ($(this).is(':checked')) {
            $('#comboTipoDisposicion').attr("disabled",false);
        } else {
            $('#comboTipoDisposicion').attr("disabled",true);
        }
    });
    $('#chkNormativaDisp').click(function() {
        if ($(this).is(':checked')) {
            $('#txtNormativaDisp').attr("disabled",false);
        } else {
            $('#txtNormativaDisp').attr("disabled",true);
        }
    });
}
function setAccionTagsFormulario(){
    $('#comboModalidad').on('change', function (e) {
        alert("hola mundo");
    });
    $(document).on("change","#lstDepartamento",function(){
        var valor = $('#lstDepartamento').val();
        cargarComboGet("opcion=municipio&iddepartamento="+valor,"divMunicipio","controladores/controlador.inmuebles.php");
    });
}
function cargarComboGet(opcion,combo,url){
    $.ajax({
        type:"GET",
        data:opcion,
        url:url,
        success:function(data){
            $("#"+combo).html(data);
        }
    });
}
function cargarCombo(opcion,combo,url){
    $.ajax({
        type:"GET",
        data:opcion,
        url:url,
        success:function(data){
            $("#"+combo).html(data);
        }
    });
}


