
</div>           <!-- fin contenido -->
</div> <!-- fin contenedor -->

<!-- dialogo -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content" id="contenidoModalInicio">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
          <div class="modal-body" id="contenidoModal">
          
          </div>
          <!--<div class="modal-footer"></div>-->
    </div>
  </div>
</div>
<!-- fin dialogo -->
<form id="frmImprimeCertificado" action="" method="POST" target="_blank" style="display:none;">
    <input type="hidden" name="id" id="txtImprimeCertificadoId" value="" />
    <input type="hidden" name="accion" id="txtImprimeCertificadoAccion" value="imprimirCertificado" />
</form>
</body>
    <script type="text/javascript">
        $( document ).ready(function() {
             rutinasPanelPrincipal();
             asignarClicTablaCertificado();
        });
    </script>
</html>
