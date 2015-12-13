<div id="divEliminarCertificado">
    <strong>Esta seguro de eliminar el certificado?</strong>
    <div class="row">
        <div class="col-xs-12">
           <div class="modal-footer"> 
               <button type="button" id="btnEliminarCertificado" name="btnEliminarCertificado"  class="btn btn-primary">Eliminar</button>
               <button type="button" id="btnCancelarEliminar" name="btnCancelarEliminar"  class="btn btn-primary">Cancelar</button>
           </div>
        </div>
    </div>
</div>
<script type="text/javascript">
        $( document ).ready(function() {
            $('#btnEliminarCertificado').click(function(){
                var idCertificado = $('#idCertificado').val();
                var variableAccion="eliminarCertificado";
                $.ajax({
                    url:'controladores/controlador.certificado.php',
                    type:'POST',
                    data:{accion:variableAccion,id:idCertificado},
                    success:function(data){
                        if(data>0){
                            alert("El certificado fue eliminado satisfactoriamente");
                            $("#tblListaCertificados").dataTable().fnDraw();
                            $('#myModal').modal('hide'); 
                        }else{
                            alert("Se produjo un error");
                        }
                    }
               });
            });
            $('#btnCancelarEliminar').click(function(){
                $('#myModal').modal('hide'); 
            }); 
             
        });
</script>