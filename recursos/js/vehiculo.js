
var idArchivo = "";
var idActivo = "";

function subeArchivo(){
     $('#archivoCsv').uploadify({
         height        : 30,
         swf           : 'librerias/uploadify/uploadify.swf',
         uploader      : 'librerias/uploadify/uploadify1.php',
         script        : 'librerias/uploadify/uploadify1.php',
         cancelImg     : 'librerias/uploadify/uploadify-cancel.png',
         buttonText    : 'Subir Archivo',
         width         : 120,
         onUploadSuccess : function(file, data, response) {
            if(data == 1){
               alert('El Archivo ' + file.name + ' fue correctamente subido.');
               $('#areaBotonVerifica').show();
               $("#subido").val(1);
               $("#nombreArchivo").val(file.name);
            }
            else
                alert('El Archivo no fue subido; '+data);
        },
        onUploadError : function(file, errorCode, errorMsg, errorString) {
            alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
        }

   });
}
function botonesSubirArchivo(){
  /*  $('#btnSubirArchivo').on('click',function(){
		if($("#archivo").val() == ''){
		 alert("Debe seleccionar un archivo");
		}
		else{
		idArchivo = $("#archivo").val();
		var archivos = idArchivo.split(".");
                //var file = document.getElementById('archivo').files[0];
                //var file = $("#archivo")[0].files[0]['name'];
                var file = $("#archivo")[0].files[0];
                  //var datos = new FormData();

                  //datos.append("archivo",file);
                //alert("hola "+file);
		if(archivos[1] == 'csv' || archivos[1] == 'CSV'){
			var url1 = "controladores/controlador.archivo.php";
                        $.ajax({
				type: "POST",
				url : url1,
				//data: "accion=subeArchivo&archivo="+file,
				data:{accion:'subeArchivo',archivo:file},
                                success: function (data) {
					if (data == 1){
						var url = "controladores/controlador.archivo.php";
                                                $.ajax({
                                                        type: "GET",
                                                        url : url,
                                                        data: "accion=guardaArchivo&idarchivo="+idArchivo,
                                                        success: function (data) {
                                                                if (data > 0)
                                                                        alert("El archivo fue subido correctamente con codigo: "+data);
                                                                else
                                                                        alert("Ocurrió un error al guardar los datos, comuníquese con su proveedor al respecto "+data);

                                                                cargaTablaDatos(data);
                                                                idActivo = data;
                                                                $('#divTablaDatos').show();
                                                                $('#divSeccionBotones').hide();
                                                        }
                                                });
                        }
                    else
						alert("Ocurrió un error al subir el archivo, comuníquese con su proveedor al respecto "+data);

                        }
			});
			
		 }
		else {
			alert("el archivo no tiene el formato establecido");
		}
	   }
        
    });*/
    $('#btnSubirArchivo').on('click',function(){
		$('#btnSubirArchivo').prop('disabled', true);
		$('#btnSubirArchivo').text('Procesando aguarde.');
       if($("#subido").val() == '1'){
           idArchivo = $("#nombreArchivo").val();
           var url = "controladores/controlador.archivo.php";
           $.ajax({
               type: "GET",
               url : url,
               data: "accion=guardaArchivo&idarchivo="+idArchivo,
               success: function (data) {
                       if (data > 0)
                           alert("Se realizó la verificación de los datos correctamente.");
                       else
                           alert("Ocurrió un error al guardar los datos, comuníquese con su proveedor al respecto "+data);

                       idActivo = data;
                       $('#idArchivoSubido').val(data);
                       $.ajax({
                           type: "GET",
                           url : url,
                           data: "accion=generaCamposExtra&idarchivo="+idActivo,
                           success: function (data) {
                               if (data > 0)
                                   alert("Se igresaron los campos manuales correctamente.");
                               else
                                   alert("Ocurrió un error al guardar los datos, comuníquese con su proveedor al respecto "+data);
                           }
                       });
                       cargaTablaDatos(data);
                       $('#divTablaDatos').show();
                       $('#divSeccionBotones').hide();
					   $('#btnSubirArchivo').prop('disabled', false);
					   $('#btnSubirArchivo').text('Verificar Datos');
                }
            });
       }
       else{
           alert("No subió un archivo correcto, seleccione uno y súbalo");
       }

    });
    $('#btnAceptar').on('click',function(){
        $('#divTablaDatos').hide();
        $('#archivo').val('');
        $('#divSeccionBotones').show();
    });
    $('#btnCancelar').on('click',function(){
        //alert (idActivo);
        var url = "controladores/controlador.archivo.php";
        $.ajax({
            type: "GET",
            url : url,
            data: "accion=eliminar&idarchivo="+idActivo,
            success: function (data) {
                if (data > 0)
                    alert("El archivo fue eliminado correctamente");
                else
                    alert("Ocurrió un error, comuníquese con su proveedor al respecto "+data);

                $('#divTablaDatos').hide();
                $('#archivo').val('');
                $('#divSeccionBotones').show();
            }
        });
    });
	
}


function cargaTablaDatos(idActivo){
    $("#tablaDatos").dataTable({
        "bProcessing": true,
        "bServerSide": true,
        "bFilter": true,
        "bSort": true,
        "aaSorting": [[0, "desc"]],
        "aLengthMenu": [[100, -1], [25,50,100, "Todo"]],
        "iDisplayLength": 15,
        "sAjaxSource": "controladores/controlador.archivo.php?accion=listado&idarchivo="+idActivo,
        "aoColumns": [
            {"mData": "cuenta", "sClass": "left", "sTitle": "Cuenta"},
            {"mData": "nombre_cuenta", "sClass": "left", "sTitle": "Nombre Cuenta"},
            //{"mData": "saldo_anterior_deudor", "sClass": "left", "sTitle": "Saldo Anterior Deudor"},
            //{"mData": "saldo_anterior_acreedor", "sClass": "left", "sTitle": "Saldo Anterior Acreedor"},
            {"mData": "fecha", "sClass": "left", "sTitle": "Fecha"},
            {"mData": "numero", "sClass": "left", "sTitle": "Numero"},
            {"mData": "tipo_comprobante", "sClass": "left", "sTitle": "Tipo Comprobante"},
            {"mData": "descripcion", "sClass": "left", "sTitle": "Descripcion"},
           // {"mData": "tipo_movimiento", "sClass": "left", "sTitle": "Tipo Movimiento"},
           // {"mData": "serie", "sClass": "left", "sTitle": "Serie"},
           // {"mData": "numero1", "sClass": "left", "sTitle": "Numero"},
            {"mData": "codigo_contracuenta", "sClass": "left", "sTitle": "Cód Contra Cuenta"},
            {"mData": "contracuenta", "sClass": "left", "sTitle": "Contra Cuenta"},
            {"mData": "glosa", "sClass": "left", "sTitle": "Glosa"},
            {"mData": "debito", "sClass": "left", "sTitle": "Debito"},
            {"mData": "credito", "sClass": "left", "sTitle": "Credito"},
            //{"mData": "deudor", "sClass": "left", "sTitle": "Deudor"},
            //{"mData": "acreedor", "sClass": "left", "sTitle": "Acreedor"},
           // {"mData": "ficha", "sClass": "left", "sTitle": "Ficha"},
           // {"mData": "documento", "sClass": "left", "sTitle": "Documento"},
           // {"mData": "vencimiento", "sClass": "left", "sTitle": "Vencimiento"},
           // {"mData": "monedaref", "sClass": "left", "sTitle": "Moneda Referencial"},
            {"mData": "cnegocio", "sClass": "left", "sTitle": "C Negocio"}
        ],
        /*"columnDefs": [
            { "width": "20%", "targets": 0 },
            { "width": "20%", "targets": 1 },
            { "width": "20%", "targets": 2 },
            { "width": "20%", "targets": 3 },
            { "width": "20%", "targets": 4 },
            { "width": "20%", "targets": 5 },
            { "width": "20%", "targets": 6 },
            { "width": "20%", "targets": 7 },
            { "width": "20%", "targets": 8 },
            { "width": "20%", "targets": 9 },
            { "width": "20%", "targets": 10 },
            { "width": "20%", "targets": 11 },
            { "width": "20%", "targets": 12 },
            { "width": "20%", "targets": 13 },
            { "width": "20%", "targets": 14 },
            { "width": "20%", "targets": 15 },
            { "width": "20%", "targets": 16 },
            { "width": "20%", "targets": 17 },
            { "width": "20%", "targets": 18 },
            { "width": "20%", "targets": 19 },
            { "width": "20%", "targets": 20 },
            { "width": "20%", "targets": 21 }
        ],*/
        "oLanguage": {
            "sUrl": "recursos/idioma/Spanish.json"
        }
    });
}

