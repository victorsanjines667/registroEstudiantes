function cargarListas(){
    ajaxListas("listaEntidades","divListaEntidad");
    ajaxListas("listaSitActual","divListaSituacionActual");
    ajaxListas("listaTipoMueble","divListaTipoMueble");
    ajaxListas("listaEstFisico","divListaEstadoFisico");
    ajaxListas("listaDepto","divListaDepartamento");
    
    //telefonos
    ajaxListasTelefonos("listaEstadoActualTelefono","divListaEstadoActualTelefono");
    ajaxListasTelefonos("listaCooperativaTelefono","divListaCooperativaTelefono");
    
    $(".divCheckProvincia,.divCheckMunicipio").hide();
    $(document).on("change","#lstDepartamento",function(){
        var iddepto = $(this).val();
        ajaxDeptoMunicipio("listaProvincia",iddepto,"divListaProvincia");
        $(".divCheckProvincia").show();
    });
    $(document).on("change","#lstProvincia",function(){
        var iddepto = $(this).val();
        ajaxDeptoMunicipio("listaMunicipio",iddepto,"divListaMunicipio");
        $(".divCheckMunicipio").show();
    });
    
   
}

function ajaxListas(opcion,divLista){
     $.ajax({
            type:"POST",
            data:{opcion:opcion},
            url:"controladores/controlador.muebles.php",
            success:function(data){
                $("#"+divLista).html(data);
            }
        });
}

function ajaxListasTelefonos(opcion,divLista){
     $.ajax({
            type:"POST",
            data:{opcion:opcion},
            url:"controladores/controlador.telefonos.php",
            success:function(data){
                $("#"+divLista).html(data);
            }
        });
}

function ajaxDeptoMunicipio(opcion,id,divLista){
    $.ajax({
            type:"POST",
            data:{opcion:opcion,id:id},
            url:"controladores/controlador.muebles.php",
            success:function(data){
                $("#"+divLista).html(data);
            }
    });
}