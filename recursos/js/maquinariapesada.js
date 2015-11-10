var idBien;
var filaTablaMaquinariaPesada;
var filaTablaDocumentoMP;
var alertaValidacionMP="";
function cargarTablaMaquinariaPesada(){    
    $("#tablaMaquinariaPesada").dataTable({
        "bProcessing": true,
        "bServerSide": true,
        "bFilter": true,
        "bDestroy" : true,
        "scrollX": true,
        "bSort": true,
        "aaSorting": [[0, "desc"]],
        "aLengthMenu": [[20, -1], [20,50,100, "Todo"]],
        "iDisplayLength": 20,
        "sAjaxSource": "controladores/controlador.maquinariapesada.php?accionMP=listado",
        "aoColumns": [            
            {"mData": "idbien", "sClass": "left", "sTitle": "Id Bien"},
            {"mData": "descripcion", "sClass": "left", "sTitle": "Descripcion"},
            {"mData": "tipobien", "sClass": "left", "sTitle": "Tipo Bien"},
            {"mData": "marca", "sClass": "left", "sTitle": "Marca"},
            {"mData": "modelo", "sClass": "left", "sTitle": "Modelo"},
            {"mData": "nrochasis", "sClass": "left", "sTitle": "Chasis"},
            {"mData": "nromotor", "sClass": "left", "sTitle": "Motor"},
            {"mData": "color", "sClass": "left", "sTitle": "Color"},
            {"mData": "estadobien", "sClass": "left", "sTitle": "Estado"},
            {"mData": "uso", "sClass": "left", "sTitle": "Uso"},
            {"mData": "boton", "sClass": "left", "sTitle": ""}
        ],
        "oLanguage": {
            "sUrl": "recursos/idioma/Spanish.json"
        }
    }); 
}
function cargarTablaDocumentacionMaquinariaPesada(idbien){
    idBien = idbien;
    $("#tablaDocumentacionMaquinariaPesada").dataTable({
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
function marcarFilaTablaMaquinariaPesada(){
    $('#tablaDocumentacionMaquinariaPesada').on('click','tbody tr', filaDocumentoMaquinariaPesada);   
}
function filaDocumentoMaquinariaPesada(){
   if(filaTablaDocumentoMP){
      $("td:first", filaTablaDocumentoMP).parent().children().each(function(){$(this).removeClass('markrow');});
   }
   filaTablaDocumentoMP = this;
   $("td:first", this).parent().children().each(function(){$(this).addClass('markrow');}); 
   var a = $("td:first", this).text();
   idDocumentoBienMaquinariaPesada=a;
   $('#txtIdDocumentoMaquinariaPesada').val(a);
   $('#txtObservacionesMaquinariaPesada').val('');
   cargarComboObservacionesMaquinariaPesada();
   //getDatosDocumentoMaquinariaPesada(a);
   verificarSiTieneValidacionMaquinariaPesada(a);
}


function abrirDialogValidacionMaquinariaPesada(idbien){
   $('#txtListaObservacionesMaquinariaPesada').val('');
   $('#txtObservacionesMaquinariaPesada').val('');
   $('#txtIdBienMaquinariaPesada').val(idbien);
   $('#divCondicionesValidacionMaquinariaPesada').hide();
   $('#divDatosValidacionMaquinariaPesada').hide(); 
   $('#divObservacionesMaquinariaPesada').hide(); 
   $('#divDatosValidacionDocProvisionalMP').hide();
   $('#cbNroDocumentoOpcionMPProv option[value="-1"]').prop('selected','selected');
   $('#txtNroDocumentoMPObservadoProv').val('');
   cargarTablaDocumentacionMaquinariaPesada(idbien);
   getDatosParaValidarMaquinariapesada(idbien);
   $('#ModalMaquinariaPesadaValidar').modal('show');
}


function VerificarSeleccionMaquinariaPesada(){
    $('#cbAdjuntaMaquinariaPesada').change(function() {
        mostrarDatosValidacionMaquinariaPesada();        
    }); 
    $('#cbCorrespondeMaquinariaPesada').change(function() {
        mostrarDatosValidacionMaquinariaPesada();        
    }); 
    $('#cbLegibleMaquinariaPesada').change(function() {
        mostrarDatosValidacionMaquinariaPesada();        
    }); 
}

function mostrarDatosValidacionMaquinariaPesada(){
   var adjunto = $('#cbAdjuntaMaquinariaPesada').val();
   var corresponde = $('#cbCorrespondeMaquinariaPesada').val();
   var legible = $('#cbLegibleMaquinariaPesada').val();
   var tipoDocumento = $('#txtTipoDocumentoMaquinariaPesada').val();
   if(/*tipoDocumento==8 || */tipoDocumento==7){
       $('#cbEstadoDocumentacionMaquinariaPesada').val(1);
   }else{
       $('#cbEstadoDocumentacionMaquinariaPesada').val(2);   
   }
   if(/*tipoDocumento==8||*/tipoDocumento==7){
        if(adjunto=='t' && corresponde==0 && legible=='t'){
            $('#divDatosValidacionMaquinariaPesada').show();
            $('#divDatosValidacionDocProvisionalMP').hide();
            $('#divObservacionesMaquinariaPesada').hide();
        }else{ 
            if(adjunto=='f' || corresponde==1 || legible=='f'){
                $('#divDatosValidacionMaquinariaPesada').hide();
                $('#divObservacionesMaquinariaPesada').show();  
            }
        }
   }else{
        if(adjunto=='t' && corresponde==0 && legible=='t'){
            $('#divDatosValidacionMaquinariaPesada').hide();
            $('#divObservacionesMaquinariaPesada').hide();
            $('#divDatosValidacionDocProvisionalMP').show();
        }else{ 
            if(adjunto=='f' || corresponde==1 || legible=='f'){
                $('#divDatosValidacionMaquinariaPesada').hide();
                $('#divDatosValidacionDocProvisionalMP').hide();
                $('#divObservacionesMaquinariaPesada').show();  
            }
        } 
   }  
}

function getDatosParaValidarMaquinariapesada(idbien){       
    $.ajax({
        type: "GET",
        url: "controladores/controlador.maquinariapesada.php",
        data: "accionMP=getDatosMaquinariaPesada&idbien=" + idbien,
        success: function(data) {
            datos = $.parseJSON(data);
            $('#txtEquipoMaquinariaPesada').val(datos.descripcion);
            $('#txtMarcaMaquinariaPesada').val(datos.marca);
            $('#txtModeloMaquinariaPesada').val(datos.modelo);
            $('#txtChasisMaquinariaPesada').val(datos.nrochasis);
            $('#txtMotorMaquinariaPesada').val(datos.nromotor);
            $('#txtColorMaquinariaPesada').val(datos.color);
            $('#txtMensajeCabeceraMP').val('IdBien: '+idbien+', Descripcion: '+datos.descripcion+', Marca: '+datos.marca+', Modelo: '+datos.modelo+', Chasis: '+datos.nrochasis+', Motor: '+datos.nromotor+', Color: '+datos.color);
        }
    });
}

function comportamientoComboValidacion(elemento0,elemento1){
    var valor = $(elemento0).val();
    if (valor == 'f'){
        $(elemento1).attr('readonly', false);
    }else{
        $(elemento1).val('');
        $(elemento1).attr('readonly', true);
    }
}
function estadoCombos(){
    var combo = $('#cbNroDocumentoMaquinariaPesadaOpcion');
    var cajatexto = $("#txtNroDocumentoMaquinariaPesadaObservado");
    comportamientoComboValidacion(combo,cajatexto);
    combo = $('#cbEquipoMaquinariaPesadaOpcion');
    cajatexto = $("#txtEquipoMaquinariaPesadaObservado");
    comportamientoComboValidacion(combo,cajatexto);
    combo = $('#cbMarcaMaquinariaPesadaOpcion');
    cajatexto = $("#txtMarcaMaquinariaPesadaObservado");
    comportamientoComboValidacion(combo,cajatexto);
    combo = $('#cbModeloMaquinariaPesadaOpcion');
    cajatexto = $("#txtModeloMaquinariaPesadaObservado");
    comportamientoComboValidacion(combo,cajatexto);
    combo = $('#cbChasisMaquinariaPesadaOpcion');
    cajatexto =  $("#txtChasisMaquinariaPesadaObservado");
    comportamientoComboValidacion(combo,cajatexto);
    combo = $('#cbMotorMaquinariaPesadaOpcion');
    cajatexto =  $("#txtMotorMaquinariaPesadaObservado");
    comportamientoComboValidacion(combo,cajatexto);
    combo = $('#cbColorMaquinariaPesadaOpcion');
    cajatexto =  $("#txtColorMaquinariaPesadaObservado");
    comportamientoComboValidacion(combo,cajatexto);
    combo = $('#cbNroDocumentoOpcionMPProv');
    cajatexto =  $("#txtNroDocumentoMPObservadoProv");
    comportamientoComboValidacion(combo,cajatexto);
}
function eventosCombosValidacionMaquinariaPesada(){
    $('#cbNroDocumentoMaquinariaPesadaOpcion').on("change",function() {
        var cajatexto = $("#txtNroDocumentoMaquinariaPesadaObservado");
        comportamientoComboValidacion(this,cajatexto);
    }); 
    
    $('#cbEquipoMaquinariaPesadaOpcion').change(function() {
        var cajatexto = $("#txtEquipoMaquinariaPesadaObservado");
        comportamientoComboValidacion(this,cajatexto);
    });
    
    $('#cbMarcaMaquinariaPesadaOpcion').change(function() {
        var cajatexto = $("#txtMarcaMaquinariaPesadaObservado");
        comportamientoComboValidacion(this,cajatexto);
    });
    
    $('#cbModeloMaquinariaPesadaOpcion').change(function() {
        var cajatexto = $("#txtModeloMaquinariaPesadaObservado");
        comportamientoComboValidacion(this,cajatexto);
    });
    
    $('#cbChasisMaquinariaPesadaOpcion').change(function() {
        var cajatexto = $("#txtChasisMaquinariaPesadaObservado");
        comportamientoComboValidacion(this,cajatexto);
    });
    
    $('#cbMotorMaquinariaPesadaOpcion').change(function() {
        var cajatexto = $("#txtMotorMaquinariaPesadaObservado");
        comportamientoComboValidacion(this,cajatexto);
    });
    
    $('#cbColorMaquinariaPesadaOpcion').change(function() {
        var cajatexto = $("#txtColorMaquinariaPesadaObservado");
        comportamientoComboValidacion(this,cajatexto);
    });
    $('#cbNroDocumentoOpcionMPProv').change(function() {
        var cajatexto = $("#txtNroDocumentoMPObservadoProv");
        comportamientoComboValidacion(this,cajatexto);
    });
    
}
function comboMultiSelectMaquinariaPesada(){
    $('#cbObservacionesMaquinariaPesada').multiselect({
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
                $('#txtListaObservacionesMaquinariaPesada').val(listaIdBienes);
	        return labels.join(', ') + ' ';
            }
        }
    });
}

function cargarComboObservacionesMaquinariaPesada(){
    var url = "controladores/controlador.maquinariapesada.php";
    $.ajax({
       type: "GET",
       url: url,
       data: "accionMP=obtenerObservacionesMaquinariaPesada",
       success: function (data) {
           $('#cbObservacionesMaquinariaPesada').html(data);
           $('#cbObservacionesMaquinariaPesada').multiselect('rebuild');
       }
    });
    
}

function getDatosDocumentoMaquinariaPesada(idDocumento){
    var url = "controladores/controlador.maquinariapesada.php";
    $.ajax({
        type: "GET",
        url : url,
        data: "accionMP=getDatosDocumento&iddocumento="+idDocumento,
        success: function (data) {
            datos = $.parseJSON(data);
            $('#txtNroDocumentoMaquinariaPesada').val(datos.nrodocumento);
            $('#txtTipoDocumentoMaquinariaPesada').val(datos.idtipodocumento);   
            $('#txtNroDocumentoMPProv').val(datos.nrodocumento);
        }
    });
}

function verificarSiTieneValidacionMaquinariaPesada(iddocumento){
    var url = "controladores/controlador.maquinariapesada.php";
    $.ajax({
        type: "GET",
        url : url,
        data: "accionMP=verificarValidacion&iddocumento="+iddocumento,
        success: function (data) {
           datos = $.parseJSON(data);
           if(datos.tienevalidacion=='true'){
              $('#txtNroDocumentoMaquinariaPesada').val(datos.nrodocumento);
              $('#txtTipoDocumentoMaquinariaPesada').val(datos.idtipodocumento);
              $('#txtNroDocumentoMPProv').val(datos.nrodocumento);
              $('#cbAdjuntaMaquinariaPesada option[value="'+datos.adjunta+'"]').prop('selected','selected');
              $('#cbCorrespondeMaquinariaPesada').val(datos.corresponde);
              $('#cbLegibleMaquinariaPesada option[value="'+datos.legible+'"]').prop('selected','selected');
              $('#accionMP').val('editarValidacion');
              var idTipoDoc = $('#txtTipoDocumentoMaquinariaPesada').val();
              if(idTipoDoc == 7 /*|| idTipoDoc==8*/){
                    $('#cbEstadoDocumentacionMaquinariaPesada').val(1);
                    $('#txtNroDocumentoMaquinariaPesadaObservado').val(datos.nrodocumento);
                    $('#txtEquipoMaquinariaPesadaObservado').val(datos.descripcion);
                    $('#txtMarcaMaquinariaPesadaObservado').val(datos.marca);
                    $('#txtModeloMaquinariaPesadaObservado').val(datos.modelo);
                    $('#txtChasisMaquinariaPesadaObservado').val(datos.nrochasis);
                    $('#txtMotorMaquinariaPesadaObservado').val(datos.nromotor);
                    $('#txtColorMaquinariaPesadaObservado').val(datos.color);
                    $('#cbNroDocumentoMaquinariaPesadaOpcion option[value="'+datos.correctodocumento+'"]').prop('selected','selected');
                    $('#cbEquipoMaquinariaPesadaOpcion option[value="'+datos.correctodescripcion+'"]').prop('selected','selected');
                    $('#cbMarcaMaquinariaPesadaOpcion option[value="'+datos.correctomarca+'"]').prop('selected','selected');
                    $('#cbModeloMaquinariaPesadaOpcion option[value="'+datos.correctomodelo+'"]').prop('selected','selected');
                    $('#cbChasisMaquinariaPesadaOpcion option[value="'+datos.correctonrochasis+'"]').prop('selected','selected');
                    $('#cbMotorMaquinariaPesadaOpcion option[value="'+datos.correctonromotor+'"]').prop('selected','selected');
                    $('#cbColorMaquinariaPesadaOpcion option[value="'+datos.correctocolor+'"]').prop('selected','selected');
                    
              }else{
                    $('#cbEstadoDocumentacionMaquinariaPesada').val(2);
                    $('#txtNroDocumentoMPObservadoProv').val(datos.nrodocumento);
                    $('#cbNroDocumentoOpcionMPProv option[value="'+datos.correctodocumento+'"]').prop('selected','selected');
                    
              }
              
              $('#txtIdValidacionMaquinariaPesada').val(datos.idvalidacion);
              $('#txtListaObservacionesMaquinariaPesada').val(datos.observaciondetalle);
              $('#txtObservacionesMaquinariaPesada').val(datos.observaciones);
              var dataarray=datos.observaciondetalle.split("|");
              $("#cbObservacionesMaquinariaPesada").val(dataarray);
              $("#cbObservacionesMaquinariaPesada").multiselect("refresh");
              estadoCombos();
              $('#divCondicionesValidacionMaquinariaPesada').show();
              $('#divDatosValidacionMaquinariaPesada').show();
              mostrarDatosValidacionMaquinariaPesada();
           }else{
              $('#txtNroDocumentoMaquinariaPesada').val(datos.nrodocumento);
              $('#txtTipoDocumentoMaquinariaPesada').val(datos.idtipodocumento);
              $('#txtNroDocumentoMPProv').val(datos.nrodocumento); 
              $('#cbAdjuntaMaquinariaPesada option[value="-1"]').prop('selected','selected');
              $('#cbCorrespondeMaquinariaPesada option[value="-1"]').prop('selected','selected');
              $('#cbLegibleMaquinariaPesada option[value=-1]').prop('selected','selected');
              $('#cbEstadoDocumentacionMaquinariaPesada').val('');
              
              $('#cbNroDocumentoMaquinariaPesadaOpcion option[value="-1"]').prop('selected','selected');
              $('#cbEquipoMaquinariaPesadaOpcion option[value="-1"]').prop('selected','selected');
              $('#cbMarcaMaquinariaPesadaOpcion option[value="-1"]').prop('selected','selected');
              $('#cbModeloMaquinariaPesadaOpcion option[value="-1"]').prop('selected','selected');
              $('#cbChasisMaquinariaPesadaOpcion option[value="-1"]').prop('selected','selected');
              $('#cbMotorMaquinariaPesadaOpcion option[value="-1"]').prop('selected','selected');
              $('#cbColorMaquinariaPesadaOpcion option[value="-1"]').prop('selected','selected');
              
              $('#txtNroDocumentoMaquinariaPesadaObservado').val('');
              $('#txtEquipoMaquinariaPesadaObservado').val('');
              $('#txtMarcaMaquinariaPesadaObservado').val('');
              $('#txtModeloMaquinariaPesadaObservado').val('');
              $('#txtChasisMaquinariaPesadaObservado').val('');
              $('#txtMotorMaquinariaPesadaObservado').val('');
              $('#txtColorMaquinariaPesadaObservado').val('');           
              $('#accionMP').val('nuevaValidacion');
              estadoCombos();
              $('#cbEstadoDocumentacionMaquinariaPesada').val('');
              $('#divCondicionesValidacionMaquinariaPesada').show();
              $('#divDatosValidacionMaquinariaPesada').hide();
              $('#divObservacionesMaquinariaPesada').hide();
              $('#divDatosValidacionDocProvisionalMP').hide();  
              $('#cbNroDocumentoOpcionMPProv option[value="-1"]').prop('selected','selected');
              $('#txtNroDocumentoMPObservadoProv').val('');
           }
        }
    });
    
}

function guardarValidacionMP(){
    //if(validarFormularioMP()){
        var url = "controladores/controlador.maquinariapesada.php";
        var datos = $('#formularioValidacionMaquinariaPesada').serialize();
        $.ajax({
            type: "GET",
            url: url,
            data: datos,
            success: function(data) {
                if(data>0){
                    alert("El documento fue validado correctamente");
                    $('#tablaDocumentacionMaquinariaPesada').dataTable().fnDraw();
                }else{
                    alert("Se produjo un error al validar el documento, favor comunicarse con el Area de Sistemas")
                }
            }
        });
    //}else{
    //    alert("Las Variables u opción de validación: "+alertaValidacionMP+" deberán ser seleccionados");
    //    alertaValidacionMP="";
    //}    
}

function botonesDialogoValidacionMaquinariaPesada(){
    $('#btnGuardarValidacionMP').on('click',function(){
        guardarValidacionMP();
    });
}

function validarFormularioMP(){
    var todook = true;
    if($('#cbAdjuntaMaquinariaPesada').val()=='-1'){
        todook=false;
        alertaValidacionMP += "adjunta";
    }
    if($('#cbCorrespondeMaquinariaPesada').val()=='-1'){
        todook=false;
        alertaValidacionMP += " corresponde";
    }
    if($('#cbLegibleMaquinariaPesada').val()=='-1'){
        todook=false;
        alertaValidacionMP += " legible";
    }
    var tipoDocumento = $('#txtTipoDocumentoMaquinariaPesada').val();
    if(tipoDocumento==7){
       if($('#cbNroDocumentoMaquinariaPesadaOpcion').val()=='-1'){
            todook=false;
            alertaValidacionMP += "Nro. Documentación";
        }
        if($('#cbEquipoMaquinariaPesadaOpcion').val()=='-1'){
            todook=false;
            alertaValidacionMP += " Equipo ";
        }
        if($('#cbMarcaMaquinariaPesadaOpcion').val()=='-1'){
            todook=false;
            alertaValidacionMP += " Marca";
        }
        if($('#cbModeloMaquinariaPesadaOpcion').val()=='-1'){
            todook=false;
            alertaValidacionMP += " Modelo";
        }
        if($('#cbChasisMaquinariaPesadaOpcion').val()=='-1'){
            todook=false;
            alertaValidacionMP += " Chasis";
        }
        if($('#cbMotorMaquinariaPesadaOpcion').val()=='-1'){
            todook=false;
            alertaValidacionMP += " Motor";
        }
        if($('#cbColorMaquinariaPesadaOpcion').val()=='-1'){
            todook=false;
            alertaValidacionMP += " Color";
        }
    }else{
        if($('#cbNroDocumentoOpcionMPProv').val()=='-1'){
            todook=false;
            alertaValidacionMP += "Nro. Documentación";
        }
    }     
    return todook;
}