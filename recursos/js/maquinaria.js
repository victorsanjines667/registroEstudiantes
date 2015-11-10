var idBien;
var alertaValidacionMaquinaria="";
function PoblarTablaMaquinaria(){    
    $("#tablaMaquinariaGeneral").dataTable({
        "bProcessing": true,
        "bServerSide": true,
        "bFilter": true,
        "bDestroy" : true,
        "bSort": true,
        "aaSorting": [[0, "desc"]],
        "aLengthMenu": [[20, -1], [20,50,100, "Todo"]],
        "iDisplayLength": 20,
        "sAjaxSource": "controladores/controlador.maquinaria.php?operacion=listar",
        "aoColumns": [
            {"mData": "idbien", "sClass": "left", "sTitle": "Id Bien"},
            {"mData": "descripcion", "sClass": "left", "sTitle": "Descripcion"},
            {"mData": "tipobien", "sClass": "left", "sTitle": "Tipo Bien"},
            {"mData": "marca", "sClass": "left", "sTitle": "Marca"},
            {"mData": "modelo", "sClass": "left", "sTitle": "Modelo"},
            {"mData": "nroserie", "sClass": "left", "sTitle": "nro: Serie"},
            {"mData": "estadobien", "sClass": "left", "sTitle": "Estado"},
            {"mData": "uso", "sClass": "left", "sTitle": "Uso"},
            {"mData": "boton", "sClass": "left", "sTitle": ""}
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
    //$aColumns = array('idbien', 'descripcion', 'tipobien', 'marca', 'modelo', 'nroserie', 'estadobien', 'uso', 'lnkvalidacion');
}

function OnClickTablaFilaMaquinariaLinkValidar(idbien) {    
    //$(document).on("click",".linkValidacionMaquinaria",function(event){
   //   $(document).on("click","#btnValidarMaquinaria",function(event){
	 //   event.preventDefault();        
       idBien = idbien;
	   if(idBien==null){
            alert("Debe seleccionar un bien a validar");
		}
	else{
		
        $('#ModalMaquinariaValidar').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#ModalMaquinariaValidar').modal('show');
        $('#divDatosValidacionMaquinaria').hide();
        $('#divCondicionesValidacionMaquinaria').hide();
        PoblarTablaDocumentacionMaquinaria();        
        OnClickFilaTablaDocumentacion();
        VerificarSeleccionMaquinaria();
		getDatosObservaciones();
		 $('#divDatosValidacionDocMaquinariaProvisional').hide();
		 $('#cbNroDocumentoOpcionMaquinariaProv option[value=-1]').prop('selected','selected');
   		 $('#txtNroDocumentoMaquinariaObservadoProv').val('');
        //OnClickbtnGuardarValidacionMaquinaria();
		getDatosParaValidarMaquinaria(idBien);
    //});
		}    
}

function OnClickFilaTablaMaquinaria(){
    $('#tablaMaquinariaGeneral tbody').delegate("tr", "click", PintaFilaTablaMaquinaria);   
}

function PintaFilaTablaMaquinaria()
{
   if(filatablaMaquinariaGeneral){
      $("td:first", filatablaMaquinariaGeneral).parent().children().each(function(){$(this).removeClass('markrow');});
   }
   filatablaMaquinariaGeneral = this;
   $("td:first", this).parent().children().each(function(){$(this).addClass('markrow');}); 
   var a = $("td:first", this).text();
   idBien = a;
}

function VerificarSeleccionMaquinaria(){
    $('#cbAdjuntaMaquinaria').change(function() {
        mostrarDatosValidacionMaquinaria();        
    }); 
    $('#cbCorrespondeMaquinaria').change(function() {
        mostrarDatosValidacionMaquinaria();        
    }); 
    $('#cbLegibleMaquinaria').change(function() {
        mostrarDatosValidacionMaquinaria();        
    }); 
}

function mostrarDatosValidacionMaquinaria(){
   var adjunto = $('#cbAdjuntaMaquinaria').val();
   var corresponde = $('#cbCorrespondeMaquinaria').val();
   var legible = $('#cbLegibleMaquinaria').val();
   var tipoDocumento = $('#txtTipoDocumentoMaquinaria').val();
   
   if(tipoDocumento==8){
       $('#cbEstadoDocumentacionMaquinaria').val(1);
   }else{
       $('#cbEstadoDocumentacionMaquinaria').val(2);   
   } 
    
   if(adjunto=='t' && corresponde==1 && legible=='t'){
	    if(tipoDocumento==8)
        	$('#divDatosValidacionMaquinaria').show();
		else
			$('#divDatosValidacionDocMaquinariaProvisional').show();        
        getDatosParaValidarMaquinaria(idBien);
        eventosCombosValidacionMaquinaria();
   }else{
       $('#divDatosValidacionMaquinaria').hide();
	   $('#divDatosValidacionDocMaquinariaProvisional').hide();
   }  
}

function getDatosParaValidarMaquinaria(idbien){       
    $.ajax({
        type: "GET",
        url: "controladores/controlador.maquinaria.php",
        data: "operacion=getDatosMaquinaria&idbien=" + idbien,
        success: function(data) {
            datos = $.parseJSON(data);
            $('#txtEquipoMaquinaria').val(datos.descripcion);
            $('#txtMarcaMaquinaria').val(datos.marca);
            $('#txtModeloMaquinaria').val(datos.modelo);
            $('#txtSerieMaquinaria').val(datos.nroserie);
			$('#txtMensajeCabeceraMa').val('IdBien: '+idbien+', Equipo: '+datos.descripcion+', Marca: '+datos.marca+', Modelo: '+datos.modelo+' Nro. Serie:'+datos.nroserie+'.');
        }
    });
}

function accionComboDocumento(){
        var valor = $('#cbNroDocumentoMaquinariaOpcion').val();
        if (valor == 'f'){
            $('#txtNroDocumentoObservadoMaquinaria').attr('readonly', false);
        }else{
            $('#txtNroDocumentoObservadoMaquinaria').val('');
            $('#txtNroDocumentoObservadoMaquinaria').attr('readonly', true);
        }  
}

function accionComboEquipo(){
	 var valor = $('#cbEquipoMaquinariaOpcion').val();
        if (valor == 'f'){
            $('#txtEquipoObservadoMaquinaria').attr('readonly', false);
        }else{
            $('#txtEquipoObservadoMaquinaria').val('');
            $('#txtEquipoObservadoMaquinaria').attr('readonly', true);
        }
}

function accionComboMarca(){
	var valor = $('#cbMarcaMaquinariaOpcion').val();
        if (valor == 'f'){
            $('#txtMarcaObservadoMaquinaria').attr('readonly', false);
        }else{
            $('#txtMarcaObservadoMaquinaria').val('');
            $('#txtMarcaObservadoMaquinaria').attr('readonly', true);
        }
}

function accionComboModelo(){
	var valor = $('#cbModeloMaquinariaOpcion').val();
        if (valor == 'f'){
            $('#txtModeloObservadoMaquinaria').attr('readonly', false);
        }else{
            $('#txtModeloObservadoMaquinaria').val('');
            $('#txtModeloObservadoMaquinaria').attr('readonly', true);
        }
}

function accionComboSerie(){
	var valor = $('#cbSerieMaquinariaOpcion').val();
        if (valor == 'f'){
            $('#txtSerieObservadoMaquinaria').attr('readonly', false);
        }else{
            $('#txtSerieObservadoMaquinaria').val('');
            $('#txtSerieObservadoMaquinaria').attr('readonly', true);
        }

}

function accionComboDocumentoAux(){
	var valor = $('#cbNroDocumentoOpcionMaquinariaProv').val();
        if (valor == 'f'){
            $('#txtNroDocumentoMaquinariaObservadoProv').attr('readonly', false);
        }else{
            $('#txtNroDocumentoMaquinariaObservadoProv').val('');
            $('#txtNroDocumentoMaquinariaObservadoProv').attr('readonly', true);
        }

}

function eventosCombosValidacionMaquinaria(){
    $('#cbNroDocumentoMaquinariaOpcion').change(function() {
        var valor = $('#cbNroDocumentoMaquinariaOpcion').val();
        if (valor == 'f'){
            $('#txtNroDocumentoObservadoMaquinaria').attr('readonly', false);
        }else{
            $('#txtNroDocumentoObservadoMaquinaria').val('');
            $('#txtNroDocumentoObservadoMaquinaria').attr('readonly', true);
        }
    }); 
    $('#cbEquipoMaquinariaOpcion').change(function(){
        var valor = $('#cbEquipoMaquinariaOpcion').val();
        if (valor == 'f'){
            $('#txtEquipoObservadoMaquinaria').attr('readonly', false);
        }else{
            $('#txtEquipoObservadoMaquinaria').val('');
            $('#txtEquipoObservadoMaquinaria').attr('readonly', true);
        }
    });
    $('#cbMarcaMaquinariaOpcion').change(function(){
        var valor = $('#cbMarcaMaquinariaOpcion').val();
        if (valor == 'f'){
            $('#txtMarcaObservadoMaquinaria').attr('readonly', false);
        }else{
            $('#txtMarcaObservadoMaquinaria').val('');
            $('#txtMarcaObservadoMaquinaria').attr('readonly', true);
        }
    });
    $('#cbModeloMaquinariaOpcion').change(function(){
        var valor = $('#cbModeloMaquinariaOpcion').val();
        if (valor == 'f'){
            $('#txtModeloObservadoMaquinaria').attr('readonly', false);
        }else{
            $('#txtModeloObservadoMaquinaria').val('');
            $('#txtModeloObservadoMaquinaria').attr('readonly', true);
        }
    });
    $('#cbSerieMaquinariaOpcion').change(function(){
        var valor = $('#cbSerieMaquinariaOpcion').val();
        if (valor == 'f'){
            $('#txtSerieObservadoMaquinaria').attr('readonly', false);
        }else{
            $('#txtSerieObservadoMaquinaria').val('');
            $('#txtSerieObservadoMaquinaria').attr('readonly', true);
        }
    });
	
	$('#cbNroDocumentoOpcionMaquinariaProv').change(function(){
         var valor = $('#cbNroDocumentoOpcionMaquinariaProv').val();
        if (valor == 'f'){
            $('#txtNroDocumentoMaquinariaObservadoProv').attr('readonly', false);
        }else{
            $('#txtNroDocumentoMaquinariaObservadoProv').val('');
            $('#txtNroDocumentoMaquinariaObservadoProv').attr('readonly', true);
        }
    });
}

function getDatosObservaciones(){
    var url = "controladores/controlador.maquinaria.php";
    $.ajax({
        type: "GET",
        url: url,
        data: "operacion=getObservaciones",
        success: function(data) {
            datos = $.parseJSON(data);
            $('#cbObservacionEspecificaMaquinaria').html(datos.comboObservacion);
			$('#cbObservacionEspecificaMaquinaria').multiselect('rebuild');
			
        }
    }); 
}

function opcionMultiselect(){	
	$('#cbObservacionEspecificaMaquinaria').multiselect({
        buttonText: function(options, select) {
            if (options.length === 0) {
                return 'Ninguna opción seleccionada';
            }
            else if (options.length > 5) {
                return 'Todo ha sido seleccionado';
            }
            else {
                var labels = [];
                var valores = [];
                var listaIdObservaciones;
                options.each(function() {
                    if ($(this).attr('label') !== undefined) {
                        labels.push($(this).attr('label'));
                        valores.push($(this).val());

                    }
                    else {
                        labels.push($(this).html());
                        valores.push($(this).val());
                    }
                });
                listaIdObservaciones = valores.join("|");
                $('#txtListaObservacionesMaquinaria').val(listaIdObservaciones);
                return labels.join(', ') + ' ';
            }
        }
    });
}



function OnClickbtnGuardarValidacionMaquinaria(){   
    $('#btnGuardarValidacionMaquinaria').on('click',function(){

		$('#operacion').val('guardarValidacion');
        var url = "controladores/controlador.maquinaria.php";
		var datos = $('#formularioValidacionMaquinaria').serialize();
        $.ajax({
            type: "GET",
            url: url,
            data: datos,
            success: function(data) {
				if(data > 0){
						alert("El documento fue validado correctamente");
               			 $('#tablaDocumentacionMaquinaria').dataTable().fnDraw();
						
					}
					else {
						alert("Ocurrio un error: "+data);
					}
				$('#divDatosValidacionDocMaquinariaProvisional').hide();
					$('#divDatosValidacionMaquinaria').hide();
					$('#divObservacionesMaquinaria').hide();
            }
        });

        //if(validarFormularioMaquinaria()){
            $('#operacion').val('guardarValidacion');
            var url = "controladores/controlador.maquinaria.php";
            var datos = $('#formularioValidacionMaquinaria').serialize();
            $.ajax({
                type: "GET",
                url: url,
                data: datos,
                success: function(data) {
                    if(data > 0){
                        alert("El documento fue validado correctamente");
                        $('#tablaDocumentacionMaquinaria').dataTable().fnDraw();
                    }else {
                        alert("Ocurrio un error: "+data);
                    }
                }
            });
        //}else{
        //    alert("Las variables u opción de validación: "+alertaValidacionMaquinaria+" deberán ser seleccionados");
        //    alertaValidacionMaquinaria="";
        //}    

    });
	 $('#btnCerrarValidacionMaquinaria').on('click',function(){
        //cancelar();
		$('#divDatosValidacionDocMaquinariaProvisional').hide();
					$('#divDatosValidacionMaquinaria').hide();
					$('#divObservacionesMaquinaria').hide();
    });
}

function compruebaObservaciones(){
	var adjunto = $('#cbAdjuntaMaquinaria').val();
   var corresponde = $('#cbCorrespondeMaquinaria').val();
   var legible = $('#cbLegibleMaquinaria').val();
   var tipoDocumento = $('#txtTipoDocumentoMaquinaria').val();
   if(tipoDocumento==8){
       $('#cbEstadoDocumentacionMaquinaria').val(1);
   }else{
       $('#cbEstadoDocumentacionMaquinaria').val(2);   
   }
   if(adjunto=='t' && corresponde==1 && legible=='t' ){
        //$('#divDatosValidacion').show();
        $('#divObservacionesMaquinaria').hide();
   }else{
       //if(adjunto!=-1 || corresponde!=-1 || legible!=-1){
	   if(adjunto=='f' || corresponde==2 || legible=='f'){
           //$('#divDatosValidacion').hide();
		   $('#divObservacionesMaquinaria').show();
       }
   }  
}

function habilitaObservaciones(){
	var primeraOpcion = 0;
	var segundaOpcion = 0;
	$('#cbAdjuntaMaquinaria').change(function() {
 		compruebaObservaciones();
	});
	$('#cbCorrespondeMaquinaria').change(function() {
 		compruebaObservaciones();	
	});
	$('#cbLegibleMaquinaria').change(function() {
 		compruebaObservaciones();		
	});
}


function verificarSiTieneValidacionMaquinaria(iddocumento){
    var url = "controladores/controlador.maquinaria.php";
    $.ajax({
        type: "GET",
        url : url,
        data: "operacion=verificarValidacion&iddocumento="+iddocumento,
        success: function (data) {
		   datos = $.parseJSON(data);
		   if(datos.tienevalidacion=='true'){
              $('#cbAdjuntaMaquinaria option[value="'+datos.adjunta+'"]').prop('selected','selected');
              $('#cbCorrespondeMaquinaria').val(datos.corresponde);
              $('#cbLegibleMaquinaria option[value="'+datos.legible+'"]').prop('selected','selected');
              
			  if($('#txtTipoDocumentoMaquinaria').val()==8){
			  $('#txtNroDocumentoObservadoMaquinaria').val(datos.nrodocumento);
              $('#txtDescripcionObservadoMaquinaria').val(datos.descripcion);
			  $('#txtMarcaObservadoMaquinaria').val(datos.marca);
			  $('#txtModeloObservadoMaquinaria').val(datos.modelo);
			  $('#txtSerieObservadoMaquinaria').val(datos.serie);
			  
			  $('#cbNroDocumentoMaquinariaOpcion option[value="'+datos.correctodocumento+'"]').prop('selected','selected');
			  $('#cbEquipoMaquinariaOpcion option[value="'+datos.correctodescripcion+'"]').prop('selected','selected');
			  $('#cbMarcaMaquinariaOpcion option[value="'+datos.correctomarca+'"]').prop('selected','selected');
			  $('#cbModeloMaquinariaOpcion option[value="'+datos.correctomodelo+'"]').prop('selected','selected');
			  $('#cbSerieMaquinariaOpcion option[value="'+datos.correctoserie+'"]').prop('selected','selected');
			  } else {
			  $('#txtNroDocumentoMaquinariaObservadoProv').val(datos.nrodocumento);
			  $('#cbNroDocumentoOpcionMaquinariaProv option[value="'+datos.correctodocumento+'"]').prop('selected','selected');
			  }
			 
			   $('#operacion').val('editarValidacion');
			   if($('#txtTipoDocumentoMaquinaria').val()==8)
			   		$('#cbEstadoDocumentacionMaquinaria').val(1);
			   else
			   		$('#cbEstadoDocumentacionMaquinaria').val(2);
			   $('#txtIdValidacion').val(datos.idvalidacion);
			   $('#txtListaObservacionesMaquinaria').val(datos.observaciondetalle);
			   var dataarray=datos.observaciondetalle.split("|");
			   $("#cbObservacionEspecificaMaquinaria").val(dataarray);
               $("#cbObservacionEspecificaMaquinaria").multiselect("refresh");
				  
				accionComboDocumento();
				accionComboEquipo();
				accionComboMarca();
				accionComboModelo();
				accionComboSerie();
				accionComboDocumentoAux();
	
              	  var idTipoDocumento = $('#txtTipoDocumentoMaquinaria').val();
				  if(idTipoDocumento == 8)
				  	$('#divCondicionesValidacionMaquinaria').show();
			
              mostrarDatosValidacionMaquinaria();
           }else{
              $('#cbAdjuntaMaquinaria option[value="-1"]').prop('selected','selected');
              $('#cbCorrespondeMaquinaria option[value="-1"]').prop('selected','selected');
              $('#cbLegibleMaquinaria option[value=-1]').prop('selected','selected');
              accionComboDocumentoAux();
              $('#divCondicionesValidacion').show();
              $('#divDatosValidacion').hide();
			  $('#divObservacionesMaquinaria').hide();
           }
        }
    });
}






function validarFormularioMaquinaria(){
    var todook = true;
    if($('#cbAdjuntaMaquinaria').val()=='-1'){
        todook=false;
        alertaValidacionMaquinaria += ' Adjunta';
    }
    if($('#cbCorrespondeMaquinaria').val()=='-1'){
        todook=false;
        alertaValidacionMaquinaria += ' Corresponde';
    }
    if($('#cbLegibleMaquinaria').val()=='-1'){
        todook=false;
        alertaValidacionMaquinaria += ' Legible';
    }
    var tipoDocumentoMaquinaria=$('#txtTipoDocumentoMaquinaria').val();
    if(tipoDocumentoMaquinaria==8){
        if($('#cbNroDocumentoMaquinariaOpcion').val()=='-1'){
            todook=false;
            alertaValidacionMaquinaria += ' Nro. Documento';
        }
        if($('#cbEquipoMaquinariaOpcion').val()=='-1'){
            todook=false;
            alertaValidacionMaquinaria += ' Equipo';
        }
        if($('#cbMarcaMaquinariaOpcion').val()=='-1'){
            todook=false;
            alertaValidacionMaquinaria += ' Marca';
        }
        if($('#cbModeloMaquinariaOpcion').val()=='-1'){
            todook=false;
            alertaValidacionMaquinaria += ' Modelo';
        }
        if($('#cbSerieMaquinariaOpcion').val()=='-1'){
            todook=false;
            alertaValidacionMaquinaria += ' Serie';
        }
    }else{
        if($('#cbNroDocumentoOpcionMaquinariaProv').val()=='-1'){
            todook=false;
            alertaValidacionMaquinaria += ' Nro. Documento';
        }
    }
    return todook;
}

