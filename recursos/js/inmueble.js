/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var idEntidad;
var idBien;
var filaTablaDocumento;
var idDocumentoBien=null;
var alertaValidacionInmueble="";
function cargaTablaInmuebles(){
    $("#tablaInmueble").dataTable({
        "bProcessing": true,
        "bServerSide": true,
        "bFilter": true,
        "bSort": true,
        "aaSorting": [[0, "desc"]],
        "aLengthMenu": [[100, -1], [100, "Todo"]],
        "iDisplayLength": 100,
        "sAjaxSource": "controladores/controlador.inmuebles.php?accion=listado",
        "aoColumns": [
            {"mData": "idbien", "sClass": "left", "sTitle": "IdBien"},
            {"mData": "codigo_activo", "sClass": "left", "sTitle": "Código Inmueble"},
            {"mData": "denominacion", "sClass": "left", "sTitle": "Denominación Inmueble"},
            {"mData": "tipobien", "sClass": "left", "sTitle": "Terreno o Edificación"},
            {"mData": "direccion", "sClass": "left", "sTitle": "Dirección"},
            {"mData": "superficie_terreno", "sClass": "left", "sTitle": "Sup. Terreno"},
            {"mData": "departamento", "sClass": "left", "sTitle": "Departamento"},
            {"mData": "estadobien", "sClass": "left", "sTitle": "Estado Bien"},
            {"mData": "uso", "sClass": "left", "sTitle": "Uso"},
            {"mData": "boton", "sClass": "left", "sTitle": "Opción"}
        ],
        "columnDefs": [
            { "width": "20%", "targets": 0 },
            { "width": "20%", "targets": 1 },
            { "width": "20%", "targets": 2 },
            { "width": "20%", "targets": 3 },
            { "width": "20%", "targets": 4 },
            { "width": "20%", "targets": 5 },
            { "width": "20%", "targets": 6 },
            { "width": "20%", "targets": 7 },
            { "width": "20%", "targets": 8 },
            { "width": "20%", "targets": 9 }
        ],
        "oLanguage": {
                "sUrl": "recursos/idioma/Spanish.json"
         }
    });
}
function cargarTablaDocumentacion(idbien){
    idBien = idbien;
    $("#tablaDocumentacionInmueble").dataTable({
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
function marcarFilaTablaDocumentacion(){
    $('#tablaDocumentacionInmueble').on('click','tbody tr',filaDocumento); 
}
function filaDocumento(){
   if(filaTablaDocumento){
      $("td:first", filaTablaDocumento).parent().children().each(function(){$(this).removeClass('markrow');});
   }
   filaTablaDocumento = this;
   $("td:first", this).parent().children().each(function(){$(this).addClass('markrow');});
   var a = $("td:first", this).text();
   idDocumentoBien=a;
   $('#txtIdDocumento').val(idDocumentoBien);
   $('#txtObservacionesInmuebles').val('');
   cargarComboObservaciones();
   //getDatosDocumento(a);
   verificarSiTieneValidacion(a);
   
   
}
function abrirDialogValidacion(idbien){
   $('#txtListaObservaciones').val('');
   $('#txtObservacionesInmuebles').val('');
   $('#txtIdBienInmueble').val(idbien);
   $('#divCondicionesValidacion').hide();
   $('#divDatosValidacion').hide(); 
   $('#divObservacionesInmueble').hide(); 
   $('#divDatosValidacionDocProvisional').hide(); 
   $('#cbNroDocumentoOpcionProv option[value="-1"]').prop('selected','selected');
   $('#txtNroDocumentoInmuebleObservadoProv').val('');
   cargarTablaDocumentacion(idbien);
   getDatosParaValidar(idbien);
   $('#largeModal').modal('show');
}
function mostrarDatosValidacion(){
   var adjunto = $('#cbAdjuntaInmueble').val();
   var corresponde = $('#cbCorrespondeInmueble').val();
   var legible = $('#cbLegibleInmueble').val();
   var tipoDocumento = $('#txtTipoDocumento').val();
   
   if(tipoDocumento=='1'){
       $('#cbEstadoDocumentacionInmueble').val(1);
   }else{
       $('#cbEstadoDocumentacionInmueble').val(2);   
   }
   if(tipoDocumento==1||tipoDocumento==2){
        if(adjunto=='t' && corresponde==0 && legible=='t'){
            $('#divDatosValidacionDocProvisional').hide();
            $('#divDatosValidacion').show();
            $('#divObservacionesInmueble').hide();
        }else{ 
            if(adjunto=='f' || corresponde==1 || legible=='f'){
                $('#divDatosValidacion').hide();
                $('#divObservacionesInmueble').show();  
            }
        }
   }else{
        if(adjunto=='t' && corresponde==0 && legible=='t'){
            $('#divDatosValidacionDocProvisional').show();
            $('#divDatosValidacion').hide();
            $('#divObservacionesInmueble').hide();
        }else{ 
            if(adjunto=='f' || corresponde==1 || legible=='f'){
                $('#divDatosValidacion').hide();
                $('#divDatosValidacionDocProvisional').hide();
                $('#divObservacionesInmueble').show();  
            }
        } 
   } 
}
function verificarSeleccion(){
    $('#cbAdjuntaInmueble').change(function() {
        mostrarDatosValidacion();
    }); 
    $('#cbCorrespondeInmueble').change(function() {
        mostrarDatosValidacion();
    }); 
    $('#cbLegibleInmueble').change(function() {
        mostrarDatosValidacion();
    }); 
}
function eventosCombosValidacion(){
    $('#cbNroDocumentoOpcion').change(function() {
        accionComboNroDocumento();
    }); 
    $('#cbSuperficieOpcion').change(function(){
        accionComboSuperficie(); 
    });
    $('#cbDireccionOpcion').change(function(){
        accionComboDireccion();
    });
    $('#cbCatastroOpcion').change(function(){
        accionComboCatastro();
    });
    $('#cbDenominacionOpcion').change(function(){
        accionComboDenominacion();
    });
    $('#cbNroDocumentoOpcionProv').change(function(){
        accionComboNroDocumentoProv();
    });
}
function accionComboNroDocumentoProv(){
    var valor = $('#cbNroDocumentoOpcionProv').val();
    if (valor == 'f'){
        $('#txtNroDocumentoInmuebleObservadoProv').attr('readonly', false);
    }else{
        $('#txtNroDocumentoInmuebleObservadoProv').val('');
        $('#txtNroDocumentoInmuebleObservadoProv').attr('readonly', true);
    }
}
function accionComboNroDocumento(){
    var valor = $('#cbNroDocumentoOpcion').val();
    if (valor == 'f'){
        $('#txtNroDocumentoInmuebleObservado').attr('readonly', false);
    }else{
        $('#txtNroDocumentoInmuebleObservado').val('');
        $('#txtNroDocumentoInmuebleObservado').attr('readonly', true);
    }
}
function accionComboSuperficie(){
    var valor = $('#cbSuperficieOpcion').val();
    if (valor == 'f'){
        $('#txtSuperficieInmuebleObservado').attr('readonly', false);
    }else{
        $('#txtSuperficieInmuebleObservado').val('');
        $('#txtSuperficieInmuebleObservado').attr('readonly', true);
    }
}
function accionComboDireccion(){
    var valor = $('#cbDireccionOpcion').val();
    if (valor == 'f'){
        $('#txtDireccionInmuebleObservado').attr('readonly', false);
    }else{
        $('#txtDireccionInmuebleObservado').val('');
        $('#txtDireccionInmuebleObservado').attr('readonly', true);
    } 
}
function accionComboCatastro(){
    var valor = $('#cbCatastroOpcion').val();
    if (valor == 'f'){
        $('#txtCatastroInmuebleObservado').attr('readonly', false);
    }else{
        $('#txtCatastroInmuebleObservado').val('');
        $('#txtCatastroInmuebleObservado').attr('readonly', true);
    }
}
function accionComboDenominacion(){
    var valor = $('#cbDenominacionOpcion').val();
    if (valor == 'f'){
        $('#txtDenominacionInmuebleObservado').attr('readonly', false);
    }else{
        $('#txtDenominacionInmuebleObservado').val('');
        $('#txtDenominacionInmuebleObservado').attr('readonly', true);
    }
}
function botonesDialogoValidacion(){
    $('#btnGuardarValidacionInmueble').on('click',function(){
        guardarValidacion();
    });
}

function getDatosParaValidar(idbien){
    var url = "controladores/controlador.inmuebles.php";
    $.ajax({
        type: "GET",
        url: url,
        data: "accion=getDatosInmueble&idbien=" + idbien,
        success: function(data) {
            datos = $.parseJSON(data);
            $('#txtSuperficieInmueble').val(datos.superficieterreno);
            $('#txtDireccionInmueble').val(datos.direccion+' (Zona:'+datos.zona+')');
            $('#txtCatastroInmueble').val(datos.nrocatastro);
            $('#txtDenominacionInmueble').val(datos.denominacion);
            $('#txtMensajeCabeceraIn').val('IdBien: '+idbien+', Denominacion: '+datos.denominacion+', Superficie: '+datos.superficieterreno+', Dirección: '+datos.direccion+' (Zona:'+datos.zona+')');
        }
    });
}

function getDatosDocumento(idDocumento){
    var url = "controladores/controlador.inmuebles.php";
    $.ajax({
        type: "GET",
        url : url,
        data: "accion=getDatosDocumento&iddocumento="+idDocumento,
        success: function (data) {
            datos = $.parseJSON(data);
            $('#txtNroDocumentoInmueble').val(datos.nrodocumento);
            $('#txtTipoDocumento').val(datos.idtipodocumento);
            $('#txtNroDocumentoInmuebleProv').val(datos.nrodocumento);
            
        }
    });
}
function verificarSiTieneValidacion(iddocumento){
    var url = "controladores/controlador.inmuebles.php";
    $.ajax({
        type: "GET",
        url : url,
        data: "accion=verificarValidacion&iddocumento="+iddocumento,
        success: function (data) {
           datos = $.parseJSON(data);
           if(datos.tienevalidacion=='true'){
              $('#txtNroDocumentoInmueble').val(datos.nrodocumento);
              $('#txtTipoDocumento').val(datos.idtipodocumento);
              $('#txtNroDocumentoInmuebleProv').val(datos.nrodocumento);
              $('#cbAdjuntaInmueble option[value="'+datos.adjunta+'"]').prop('selected','selected');
              $('#cbCorrespondeInmueble').val(datos.corresponde);
              $('#cbLegibleInmueble option[value="'+datos.legible+'"]').prop('selected','selected');
              $('#accion').val('editarValidacion');
              
              $('#txtIdValidacion').val(datos.idvalidacion);
              $('#txtListaObservaciones').val(datos.observaciondetalle);
              $('#txtObservacionesInmuebles').val(datos.observaciones);
              $('#divCondicionesValidacion').show(); 
              var tipoDocumento = $('#txtTipoDocumento').val();
              if(tipoDocumento==1 || tipoDocumento==2){
                $('#txtNroDocumentoInmuebleObservado').val(datos.nrodocumento);
                $('#cbNroDocumentoOpcion option[value="'+datos.correctodocumento+'"]').prop('selected','selected');
                $('#txtSuperficieInmuebleObservado').val(datos.superficieterreno);
                $('#cbSuperficieOpcion option[value="'+datos.correctosupterreno+'"]').prop('selected','selected');
                $('#txtDireccionInmuebleObservado').val(datos.direccion);
                $('#cbDireccionOpcion option[value="'+datos.correctadireccion+'"]').prop('selected','selected');
                $('#txtCatastroInmuebleObservado').val(datos.catastro);
                $('#cbCatastroOpcion option[value="'+datos.correctocatastro+'"]').prop('selected','selected');
                $('#txtDenominacionInmuebleObservado').val(datos.denominacion);
                $('#cbDenominacionOpcion option[value="'+datos.correctodenominacion+'"]').prop('selected','selected');  
                
              }else{
                $('#txtNroDocumentoInmuebleObservadoProv').val(datos.nrodocumento);
                $('#cbNroDocumentoOpcionProv option[value="'+datos.correctodocumento+'"]').prop('selected','selected');
              }
              $('#cbEstadoDocumentacionInmueble').val($('#txtTipoDocumento').val());
              var dataarray=datos.observaciondetalle.split("|");
              $("#cbObservacionesInmuebles").val(dataarray);
              $("#cbObservacionesInmuebles").multiselect("refresh");
              accionComboNroDocumentoProv();
              accionComboNroDocumento();
              accionComboSuperficie(); 
              accionComboDireccion();
              accionComboCatastro();
              accionComboDenominacion();
              mostrarDatosValidacion();
           }else{
              $('#txtNroDocumentoInmueble').val(datos.nrodocumento);
              $('#txtTipoDocumento').val(datos.idtipodocumento);
              $('#txtNroDocumentoInmuebleProv').val(datos.nrodocumento); 
              $('#cbAdjuntaInmueble option[value="-1"]').prop('selected','selected');
              $('#cbCorrespondeInmueble option[value="-1"]').prop('selected','selected');
              $('#cbLegibleInmueble option[value=-1]').prop('selected','selected');
              $('#txtNroDocumentoInmuebleObservado').val('');
              $('#cbNroDocumentoOpcion option[value="-1"]').prop('selected','selected');
              $('#txtSuperficieInmuebleObservado').val('');
              $('#cbSuperficieOpcion option[value="-1"]').prop('selected','selected');
              $('#txtDireccionInmuebleObservado').val('');
              $('#cbDireccionOpcion option[value="-1"]').prop('selected','selected');
              $('#txtCatastroInmuebleObservado').val('');
              $('#cbCatastroOpcion option[value="-1"]').prop('selected','selected');
              $('#txtDenominacionInmuebleObservado').val('');
              $('#cbDenominacionOpcion option[value="-1"]').prop('selected','selected');
              $('#accion').val('nuevaValidacion');
              accionComboNroDocumentoProv();
              accionComboNroDocumento();
              accionComboSuperficie(); 
              accionComboDireccion();
              accionComboCatastro();
              accionComboDenominacion();
              $('#cbEstadoDocumentacionInmueble').val('');
              $('#divCondicionesValidacion').show();
              $('#divDatosValidacion').hide();
              $('#divObservacionesInmueble').hide();   
              $('#divDatosValidacionDocProvisional').hide();
              $('#cbNroDocumentoOpcionProv option[value="-1"]').prop('selected','selected');
              $('#txtNroDocumentoInmuebleObservadoProv').val('');
           }
        }
        
    });
    
}
function guardarValidacion(){
    //if(validarFormulario()){
        var url = "controladores/controlador.inmuebles.php";
        var datos = $('#formularioValidacionInmueble').serialize();
        $.ajax({
            type: "GET",
            url: url,
            data: datos,
            success: function(data) {
                if(data>0){
                    alert("El documento fue validado correctamente");
                    $('#tablaDocumentacionInmueble').dataTable().fnDraw();
                }else{
                    alert("Se produjo un error al validar el documento, favor comunicarse con el Area de Sistemas")
                }
            }
        });
    //}else{
    //    alert("Las variables u opción de validación: "+alertaValidacionInmueble+" deberán ser seleccionados");
    //    alertaValidacionInmueble="";
    //}    
}

function cargarComboObservaciones(){
    var url = "controladores/controlador.inmuebles.php";
    $.ajax({
       type: "GET",
       url: url,
       data: "accion=obtenerObservaciones",
       success: function (data) {
           $('#cbObservacionesInmuebles').html(data);
           $('#cbObservacionesInmuebles').multiselect('rebuild');
       }
    });
    
}
function comboMultiSelect(){
    $('#cbObservacionesInmuebles').multiselect({
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
                var listaIdBienes;
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
                listaIdBienes = valores.join("|");
                $('#txtListaObservaciones').val(listaIdBienes);
	        return labels.join(', ') + ' ';
            }
        }
    });
}

function validarFormulario(){
    var todook = true;
    if($('#cbAdjuntaInmueble').val()=='-1'){
        todook=false;
        alertaValidacionInmueble += "adjunta";
    }
    if($('#cbCorrespondeInmueble').val()=='-1'){
        todook=false;
        alertaValidacionInmueble += " corresponde";
    }
    if($('#cbLegibleInmueble').val()=='-1'){
        todook=false;
        alertaValidacionInmueble += " legible";
    }
    var tipoDocumento = $('#txtTipoDocumento').val();
    if(tipoDocumento==1 || tipoDocumento==2){
       if($('#cbNroDocumentoOpcion').val()=='-1'){
            todook=false;
            alertaValidacionInmueble += "Nro. Documentación";
        }
        if($('#cbSuperficieOpcion').val()=='-1'){
            todook=false;
            alertaValidacionInmueble += " Superficie ";
        }
        if($('#cbDireccionOpcion').val()=='-1'){
            todook=false;
            alertaValidacionInmueble += " Dirección";
        }
        if($('#cbCatastroOpcion').val()=='-1'){
            todook=false;
            alertaValidacionInmueble += " Catastro";
        }
        if($('#cbDenominacionOpcion').val()=='-1'){
            todook=false;
            alertaValidacionInmueble += " Denominación";
        } 
    }else{
        if($('#cbNroDocumentoOpcionProv').val()=='-1'){
            todook=false;
            alertaValidacionInmueble += "Nro. Documentación";
        }
    }     
    return todook;
}