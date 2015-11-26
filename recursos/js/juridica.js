/**
 * Created by VICOSANJINES on 13/02/15.
 */
var hlr;
var idfunc;

function cargaTablaCertificado(idFuncionario) {
    alert ("si entro es aquiii");
    idfunc = idFuncionario;
    $("#TablaCertificado").dataTable({
        "sPaginationType": "simple_numbers",
        "bProcessing": true,
        "bServerSide": true,
        "bDestroy": true,
        "bFilter": true,
        "bSort": true,
        "aaSorting": [[0, "asc"]],
        "aLengthMenu": [[100, -1], [100, "Todo"]],
        "iDisplayLength": 100,
        "sAjaxSource": "controladores/controlador.prestamo.php?accionPrestamo=tablaprestamo&identidad=" + idEnt,
        "aoColumns": [
            {"mData": "idprestamo", "sClass": "left", "sTitle": "Id","with":"1px"},
            {"mData": "numerocredito", "sClass": "left", "sTitle": "N. Credito"},
            {"mData": "entidad", "sClass": "left", "sTitle": "Entidad"},
            {"mData": "distrital", "sClass": "left", "sTitle": "Distrital"},
            {"mData": "regional", "sClass": "left", "sTitle": "Regional"},
            {"mData": "nombres", "sClass": "left", "sTitle": "Persona"},
            {"mData": "ci", "sClass": "left", "sTitle": "CI"},
            {"mData": "fechadesembolso", "sClass": "left", "sTitle": "Fecha Desembolso"},
            {"mData": "montooriginal", "sClass": "left", "sTitle": "Monto"},
            {"mData": "saldocapital", "sClass": "left", "sTitle": "Saldo Capital"},
            {"mData": "cambioinicial", "sClass": "left", "sTitle": "Tipo de Cambio"},
            {"mData": "tipomoneda", "sClass": "left", "sTitle": "Moneda Cambio"},
            {"mData": "estadoprestamo", "sClass": "left", "sTitle": "Estado"},
            {"mData": "tipogarantia", "sClass": "left", "sTitle": "Tipo Garantia"},
            {"mData": "claseprestamo", "sClass": "left", "sTitle": "Clase Préstamo"},
            {"mData": "kardex", "sClass": "left", "sTitle": "Kardex"}
        ],
        "fnRowCallback": function( nRow, aData ) {
            if(aData.establecido=='t'){
                $('td', nRow).css({'background-color': '#FCF8E3'});
            }else{
                if(aData.establecido=='f'){
                    $('td', nRow).css({'background-color': '#DFF0D8'});
                }else{

                }
            }
            if(aData.castigo=='t'){
                $('td', nRow).css({'background-color': '#C4695E'});
            }
            return nRow;
        },
        "oLanguage": {
            "sUrl": "recursos/idioma/Spanish.json"
        }
    });
}

function guardaDatos(){
    $("#guardaCertificadoJuridico").on("click", function() {
    //alert("prueba");
        $.ajax({
            type: "POST",
             url: "controladores/controlador.certificado.php",
			 data: $("#frmCertificadoJuridico").serialize(),
            success: function(data) {
                //alert(data);
			$('#frmCertificadoJuridico')[0].reset();
            $('#myModal').modal('hide');
            $("#tblListaCertificados").dataTable().fnDraw();
            }
        });
    });

}

function editaDatos(){
	 $("#editarCertificadoJuridico").on("click", function() {
    //alert("prueba");
		$("#accion").val('editaCertificadoJuridica');
		var auxiliar = $("#idCertificado").val();
		$("#idCerti").val(auxiliar);
        $.ajax({
            type: "POST",
             url: "controladores/controlador.certificado.php",
			 data: $("#frmCertificadoJuridico").serialize(),
            success: function(data) {
				if (data == 1){
					 alert("Se edito correctamente ");
					 $('#myModal').modal('hide');
            		 $("#tblListaCertificados").dataTable().fnDraw();
					 $("#idCertificado").val('');
				}
               
				else{
					alert("ocurrio un error llame a sistemas " + data);
					$("#idCertificado").val('');
				}
				
            }
        });
    });
}

function cargarFondoComplementarios(){

    $.ajax({
        type: "GET",
        url: "controladores/controlador.listas.php?accion=getListaFondoComplementario",
        success: function(data) {
            $('#cbEntidad').html('');
            $('#cbEntidad').html(data);
        }
    });
}

function operacionesFormulario(){
 $("#cbExistencia").on("change", function () {
        var valor = $(this).val();
        if (valor == 1) {
            $(".contControlesNoExiste").prop("disabled", false);
        }
        if (valor == 2) {
            $(".contControlesNoExiste").prop("disabled", true);
        }
    });
}
function dialogoNuevoJuridico(){
$("#btnJuridica").on("click", function() {
    $('#modalFormularioJuridico').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#modalFormularioJuridico').modal('show');
});
   
}

function editarCertificadoJuridica(){
	$('#btnEditarJuridica').click(function(){
    var idCertificado = $('#idCertificado').val();
    var variableAccion = "getCertificadoJuridica";
    alert(idCertificado);
	cargarContenidoEditarDialogoJuridica("editarJuridica","Editar Certificado Juridico",variableAccion,idCertificado);
    //despliegaDialogoCertificado();
	});
    
}
function despliegaDialogoCertificado(){
    $('#myModal').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#myModal').modal('show');
}
function cargarContenidoDialogoEdicionJuridica(nombreContenido,titulo){
    $("#myModalLabel").text(titulo);
    $.ajax({
        url:'controladores/controlador.pantallas.php',
        type:'POST',
        data:{pantalla:nombreContenido},
        success:function(data){
            var idCertificado = $('#idCertificado').val();
            if(idCertificado != ''){
				$.ajax({
					type:'POST',
					url:'controladores/controlador.certificado.php',
					data:{accion:'getCertificadoJuridica',id:idCertificado},
					success:function(data){
						console.log(data);
						$("#editarCertificadoJuridico").show();
						$("#guardaCertificadoJuridico").hide();
						$("#fechaModificacionJuridica").show();
						var resultado = $.parseJSON(data);
						if(resultado.idtipocertificado == 3){
							$('#txtNombreCompletoJuridica').val(resultado.nombrecompleto);
							$('#txtCiJuridica').val(resultado.ci);
							$('#txtMontoJuridica').val(resultado.monto);
							$('#txtNotaCargoJuridica').val(resultado.notacargo);
							$('#txtHojaRutaJuridica').val(resultado.hojaruta);
							$('#txtRadicadoJuridica').val(resultado.lugarradicado);
							$('#txtSolicitanteJuridica').val(resultado.nombresolicitante);
							$('#txtFechaEmisionJuridica').val(resultado.fechacertificado);
							if(resultado.conproceso == "t"){
								$("#cbExistencia option[value=1]").attr("selected", true);
								$(".contControlesNoExiste").prop("disabled", false);
							}	
							else{
								$("#cbExistencia option[value=2]").attr("selected", true);
								$(".contControlesNoExiste").prop("disabled", true);
								
							}
							$("#cbGeneroJuridica option[value='" + resultado.articulo + "']").attr("selected", true);
							$('#cbEntidad option[value="' + resultado.idfondocomplementario + '"]').attr("selected", true);
							//$('#cbEntidad option[value="3"]').attr("selected", true);
						}
						else {
							alert("no corresponde a la categoria");
							$('#myModal').modal('hide');
							}
							
						}
					});
				}
				else{
				  alert("debe seleccionar un registro para editar");
				  $('#myModal').modal('hide');
				}
            $("#contenidoModal").html(data);
        }
    });
}


function cargarContenidoEditarDialogoJuridica(nombreContenido,titulo,variableAccion,idCertificado){
    /*$("#myModalLabel").text(titulo);
    $.ajax({
        url:'controladores/controlador.pantallas.php',
        type:'POST',
        data:{pantalla:nombreContenido},
        success:function(data){
            $("#contenidoModal").html(data);*/
            $.ajax({
                url:'controladores/controlador.certificado.php',
                type:'POST',
                data:{accion:variableAccion,id:idCertificado},
                success:function(data){
                    var resultado = $.parseJSON(data);
                    $('#txtNombreCompletoJuridica').val(resultado.nombrecompleto);
                    $('#txtCiJuridica').val(resultado.ci);
					$('#txtMontoJuridica').val(resultado.monto);
					//$('#txtNotaCargoJuridica').
                    //$("#cbCuentaContableCartera option[value=" + resultado.idcuentacontable + "]").attr("selected", true);
                    //$('#txtMontoLiteralCartera').val(resultado.monto);
                    //$("#cbTipoPrestamoCartera option[value=" + resultado.idtipoprestamo + "]").attr("selected", true);
                    //$('#cbFondoComplementarioCartera').val(resultado.idfondocomplementario);
                    //$('#txtHojaRutaCartera').val(resultado.hojaruta);
                    //$('#txtNombreSolicitanteCartera').val(resultado.nombresolicitante);
                    //$('#txtFechaEmisionCartera').val(resultado.fecha);
                }
            });
       /* }
    });*/
}
function cancelar(){
	 $('#cancelarCertificadoJuridico').click(function(){ 
    $('#frmCertificadoJuridico')[0].reset();
    $('#myModal').modal('hide');
	});
}


