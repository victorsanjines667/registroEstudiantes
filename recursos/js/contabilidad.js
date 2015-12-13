function operacionesContabilidad() {
    $.ajax({
        type: "GET",
        url: "controladores/controlador.listas.php?accion=getListaFondoComplementario",
        success: function (data) {
            $('#contSelFondoComplementario').html(data);
        }
    });

    $.ajax({
        type: "GET",
        url: "controladores/controlador.listas.php?accion=getListaCuentaContable",
        success: function (data) {
            $('#contSelCuentaContable').html(data);
        }
    });

    $.ajax({
        type: "GET",
        url: "controladores/controlador.listas.php?accion=getListaTipoPrestamo",
        success: function (data) {
            $('#contSelTipoPrestamo').html(data);
        }
    });


    $("#contSelTipoCertificado").on("change", function () {
        var valor = $(this).val();
        if (valor == 1) {
            $(".contControlesDeuda").prop("disabled", true);
            $(".contControlesTrabajo").prop("disabled", false);
            $(".fechaInicio").hide();
            $(".fechaCertificado").show();
            $(".cargo").hide();
            $(".monto").show();
        }
        if (valor == 2) {
            $(".contControlesDeuda").prop("disabled", false);
            $(".contControlesTrabajo").prop("disabled", true);
            $(".fechaInicio").show();
            $(".fechaCertificado").hide();
            $(".cargo").show();
            $(".monto").hide();
        }
    });

    $("#btnContabilidadGuardar").on("click", function (event) {
        event.preventDefault();
        var tipo = $("#contSelTipoCertificado").val();
        var fondo = $("#contSelFondoComplementario").val();
        var cuentacontable = $("#contSelCuentaContable").val();
        if (tipo != 0) {
            if (tipo == 1) {
                if (cuentacontable > 0) {
                    //if (swFondos == 0) {
                    if (fondo > 0) {
                        insertarCertificado();
                    } else {
                        alert("Seleccione un fondo");
                    }
                    //} else {
                    //    insertarCertificado();
                    //}
                } else {
                    alert("Seleccione una cuenta contable");
                }
            } else {
                if (fondo > 0) {
                    insertarCertificado();
                } else {
                    alert("Seleccione un fondo");
                }

            }
        } else {
            alert("Seleccione el tipo de Certificado");
        }
        $("#tblListaCertificados").dataTable().fnDraw();
    });

    $(".txtCalendario").datepicker({
        format: 'dd/mm/yyyy',
        language: 'es'
    });

    $.fn.clearForm = function () {
        return this.each(function () {
            var type = this.type, tag = this.tagName.toLowerCase();
            if (tag == 'form')
                return $(':input', this).clearForm();
            if (type == 'text' || type == 'password' || tag == 'textarea')
                this.value = '';
            else if (type == 'checkbox' || type == 'radio')
                this.checked = false;
            else if (tag == 'select')
                this.selectedIndex = -1;
        });
    };
    
    actualizaRegistroContabilidad();
    
    $("#btnContabilidadCancelar").on("click",function(event){
        event.preventDefault();
        $('#frmContabilidad').clearForm();
        $('#myModal').modal("hide");
    });
}

function insertarCertificado() {
    $.ajax({
        url: "controladores/controlador.certificado.php",
        type: 'POST',
        data: $("#frmContabilidad").serialize(),
        success: function (data) {
            if (data != 0) {
                alert("Registro Insertado Satisfactoriamente ");
				
            } else {
                alert("Error al insertar el registro");
            }
			if($("#contSelTipoCertificado").val()==1){
				window.open("reportes/certiDeuda.php?idCertificado="+data);
			} else if ($("#contSelTipoCertificado").val()==2){
				window.open("reportes/certiTrabajo.php?idCertificado="+data);
			}
            $('#frmContabilidad').clearForm();
            $('#myModal').modal("hide");
            $("#tblListaCertificados").dataTable().fnDraw();
			//$("#certiAux").attr("action", "reportes/certiDeuda.php");
            //$("#certiAux").submit();
			
        }
    });
}

function cargarContenidoDialogoEdicionContabilidad(nombreContenido,titulo){
    $("#myModalLabel").text(titulo);
    $.ajax({
        url:'controladores/controlador.pantallas.php',
        type:'POST',
        data:{pantalla:nombreContenido},
        success:function(data){
            var idCertificado = $('#idCertificado').val();
            $("#contenidoModal").html(data);
            $.ajax({
                type:'POST',
                url:'controladores/controlador.certificado.php',
                data:{accion:'getCertificadoContabilidad',id:idCertificado},
                success:function(data){
//                    console.log(data);
                    /*
                     * "{"id":"40",
                    "tipocertificado":"1",
                    "nombrecompleto":"Vitoria (la choca) Sanjines",
                    "ci":"9856123",
                    "fondocomplementario":"2",
                    "fechainicio":"20/02/2015",                        
                    "monto":"Dos Quinientos",
                    "cargo":"null",
                    "fechafinal":"",
                    "cuentacontable":"2",                        
                    "hojaruta":"B-45-E",
                    "genero":"Sra",
                    "textonota":"del (la) interesado (a)"}"
                     */
                    var resultado = $.parseJSON(data);
                    $("#btnContabilidadGuardar").hide();
                    $("#btnContabilidadActualizar").show();
                    if (resultado.tipocertificado == 1) {
                        $(".contControlesDeuda").prop("disabled", true);
                        $(".contControlesTrabajo").prop("disabled", false);
                        $(".fechaInicio").hide();
                        $(".fechaCertificado").show();
                        $(".cargo").hide();
                        $(".monto").show();
                    }
                    if (resultado.tipocertificado == 2) {
                        $(".contControlesDeuda").prop("disabled", false);
                        $(".contControlesTrabajo").prop("disabled", true);
                        $(".fechaInicio").show();
                        $(".fechaCertificado").hide();
                        $(".cargo").show();
                        $(".monto").hide();
                    }
                    $("#contSelTipoCertificado option[value=" + resultado.tipocertificado + "]").attr("selected", true);
                    $("#contSelGenero option[value=" + resultado.genero + "]").attr("selected", true);
                    $('#contTxtNombrePersona').val(resultado.nombrecompleto);
                    $('#contTxtCI').val(resultado.ci);
                    if(resultado.cuentacontable!=""){
                        $("#contSelCuentaContable option[value=" + resultado.cuentacontable + "]").attr("selected", true);
                    }                   
                    if(resultado.cargo != 'null'){
                        $('#contTxtCargo').val(resultado.cargo);
                    }
                    if(resultado.monto != 'null'){
                        $("#contTxtMonto").val(resultado.monto);
                    }
                    $('#contTxtFechaInicio').val(resultado.fechainicio);
                    if(resultado.fechafinal!=""){
                        $('#contTxtFechaFinal').val(resultado.fechafinal);
                    }
                    $('#contTxtHojaRuta').val(resultado.hojaruta);
                    $("#contSelFondoComplementario option[value=" + resultado.fondocomplementario + "]").attr("selected", true);
                    $('#contTxtTextoNota').val(resultado.textonota);
                    $("#contTxtFechaEmision").val(resultado.fechaemision);
                }
            });
        }
    });
}

function actualizaRegistroContabilidad(){
    $("#btnContabilidadActualizar").on("click",function(event){
        event.preventDefault();
        var idCertificado = $('#idCertificado').val();
        $("#txtIdCertificadoContabilidad").val(idCertificado);
        $("#txtFormContabilidadAccion").val("actualizaRegistroContabilidad");
        $.ajax({
            type:'POST',
            url:'controladores/controlador.certificado.php',
            data:   $("#frmContabilidad").serialize(),
            success:function(data){
                $('#frmContabilidad').clearForm();
                $('#myModal').modal("hide");
                $("#tblListaCertificados").dataTable().fnDraw();
            }
        });
    });
}