var idBien;
var idDocumento;
var idTipoDocumento;
var filaTablaDocumento;
         
function PoblarTablaDocumentacionMaquinaria(){
    $("#tablaDocumentacionMaquinaria").dataTable({
        "bProcessing": true,
        "bServerSide": true,
        "bDestroy": true,
        "bFilter": false,
        "paging":false,
        "ordering": false,
        "info":     false,
        "bSort": true,
        "aaSorting": [[0, "desc"]],
        "aLengthMenu": [[100, -1], [100, "Todo"]],
        "iDisplayLength": 100,
        "sAjaxSource": "controladores/controlador.documentacionbien.php?accion=listado&idbien="+idBien,
        "aoColumns": [
            {"mData": "id", "sClass": "left", "sTitle": "Id","sWith":"5px"},
            {"mData": "descripcion", "sClass": "left", "sTitle": "Tipo documento"},
            {"mData": "nrodocumento", "sClass": "left", "sTitle": "Nro Documento"},
            {"mData": "gestion", "sClass": "left", "sTitle": "Gestión Registro"},
            {"mData": "val", "sClass": "left", "sTitle": "Estado Validación"}
        ],
        "oLanguage": {
                "sUrl": "recursos/idioma/Spanish.json"
         },
		 "fnRowCallback": function( nRow, aData ) {
            if (aData.val == "Validado"){
                $('td', nRow).css({'background-color': '#D9EDF7'});
            }
            return nRow;
        }
    });
}
  
function OnClickFilaTablaDocumentacion(){
    $('#tablaDocumentacionMaquinaria').on('click', 'tbody tr', PintaFilaTablaDocumentacionMaquinaria);   
}



function PintaFilaTablaDocumentacionMaquinaria()
{
   if(filaTablaDocumento){
      $("td:first", filaTablaDocumento).parent().children().each(function(){$(this).removeClass('markrow');});
   }
   filaTablaDocumento = this;
   $("td:first", this).parent().children().each(function(){$(this).addClass('markrow');}); 
   var a = $("td:first", this).text(); 
   var b = $("td:eq(2)", this).text();

    var url = "controladores/controlador.maquinaria.php";
    $.ajax({
        type: "GET",
        url: url,
        data: "operacion=getDatosDocumento&iddocumento=" + a,
        success: function(data) {
            datos = $.parseJSON(data);
            idTipoDocumento = datos.idtipodocumento;
		    $("#txtTipoDocumentoMaquinaria").val(idTipoDocumento);
			 $("#txtIdBienMaquinaria").val(idBien);
			//alert(idTipoDocumento);
        }
    });
   idDocumento = a;	
   verificarSiTieneValidacionMaquinaria(a);
   $('#txtIdDocumentoMaquinaria').val(idDocumento);

   $('#txtNroDocumentoMaquinaria').val(b);
   $('#txtNroDocumentoMaquinariaProv').val(b);
   $('#txtTipoDocumento').val($("td:eq(1)", this).text());
   $('#txtTipoDocumento').val($("td:eq(0)", this).text());
   //$('#cbAdjuntaMaquinaria').val('');
   //$('#cbCorrespondeMaquinaria').val('');
   //$('#cbLegibleMaquinaria').val('');   
   $('#cbEstadoDocumentacionMaquinaria').val('');   
   $('.linkResetCb').val('-1');
   
   $('#divCondicionesValidacionMaquinaria').show();
   $('#divDatosValidacionMaquinaria').hide();
   $('#divDatosValidacionDocMaquinariaProvisional').hide();
   $('#divObservacionesMaquinaria').hide();
}

function getDatosDocumento(idDocumento){    
    var url = "controladores/controlador.inmuebles.php";
    $.ajax({
        type: "GET",
        url : url,
        data: "accion=getDatosDocumento&iddocumento="+idDocumento,
        success: function (data) {
            datos = $.parseJSON(data);            
            $('#txtTipoDocumento').val(datos.idtipodocumento);
            $('#txtTipoDocumento').val(datos.id);
        }
    });
}