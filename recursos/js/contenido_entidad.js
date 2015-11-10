function cargarPrimerTab(){
    cargarTabsRubros('TabInmuebles');
}

function cargarTab(){
    $(".nav-tabs a").on("click",function(){
        var tab = $(this).attr('tab');
        cargarTabsRubros(tab);
    });
}

function cargarTabsRubros(nombreTab){
    $("#"+nombreTab).cargando();
    $.ajax({
        type:'POST',
        url:'controladores/controlador.pantallas.php',
        data:{pantalla:nombreTab},
        success:function(data){
            $("#"+nombreTab).html(data);
        }
    });
}


