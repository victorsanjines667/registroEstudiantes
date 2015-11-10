function poblarTablaEntidad(){
    $("#tblEntidades").dataTable({
        "bProcessing": true,
        "bServerSide": true,
        "bFilter": true,
        "bDestroy" : true,
        "bSort": true,
        //"aaSorting": [[0, "desc"]],
        //"aLengthMenu": [[20, -1], [20,50,100, "Todo"]],
        "iDisplayLength": 20,
        "sAjaxSource": "controladores/controlador.entidades.php?operacion=poblarentidades",
        "aoColumns": [
            {"mData": "id", "sClass": "left", "sTitle": "Nro"},
            {"mData": "nombre", "sClass": "left", "sTitle": "Nombre Completo"},
            {"mData": "lnkvalidacion", "sClass": "left", "sTitle": "Nombre Completo"}
        ],
        "oLanguage": {
            "sUrl": "recursos/idioma/Spanish.json"
        }
    });
}

function OperacionesTablaEntidad(){
    $('#tblEntidades tbody').delegate("tr", "click", filaEntidad);
}

function OperacionesEntidades(){
    $(document).on("click",".linkValidacionEntidad",function(event){
        event.preventDefault();
        $("#contenido").cargando();
        var identidad = $(this).attr("identidad");
        $.ajax({
            type:'POST',
            url:"controladores/controlador.pantallas.php",
            data:{id:identidad,pantalla:'contenidoxentidad'},
            success:function(data){
                $("#contenido").html(data);
            }
        });
    });
}

function filaEntidad()
{
   if(filaTblEntidad){
      $("td:first", filaTblEntidad).parent().children().each(function(){$(this).removeClass('markrow');});
   }
   filaTblEntidad = this;
   $("td:first", this).parent().children().each(function(){$(this).addClass('markrow');});
   var a = $("td:first", this).text();
   //var b = $("td:eq(1)", this).text();
   idEntidad = a;
}