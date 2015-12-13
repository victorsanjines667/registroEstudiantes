<style type="text/css">
#divFormularioCertitificadoCartera {
    width: 600px;
    padding: .5em .5em .5em .5em;
    margin: 0 auto;
}

</style>
<div id="divFormularioCertitificadoCartera">
    <form id="formCertificadoCartera">
        <input type="hidden" id="accion" name="accion" value="guardarCertificadoCartera"/>
        <input type="hidden" id="idCertificacionCartera" name="idCertificacionCartera" value="0"/>
        <fieldset> 
            <legend>Datos del Certificado</legend>
            <div class="row">
                <div class="col-xs-3">
                    <span class="help-block" >Género:</span>
                    <select id="cbGeneroCartera" name="cbGeneroCartera" class="form-control input-sm">
                        <option value="el señor">Señor</option>
                        <option value="la señora">Señora</option>
                    </select>
                </div>
                <div class="col-xs-9">
                    <span class="help-block" >Nombres Completo de la Persona: </span>
                    <input type="text" class="form-control input-sm" value="" id="txtNombreCompletoCartera" name="txtNombreCompletoCartera" />
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <span class="help-block" >Carnet de Identidad: </span>
                    <input type="text" class="form-control input-sm" value="" id="txtCiCartera" name="txtCiCartera" />
                </div>
                <div class="col-xs-2">
                    <span class="help-block" >Procedencia </span>
                    <select id="cbProcedenciaCartera" name="cbProcedenciaCartera" class="form-control input-sm">
                        <option value="BN.">BN</option>
                        <option value="CH.">CH</option>
                        <option value="Cbba.">Cbba</option>
                        <option value="LP.">LP</option>
                        <option value="OR.">OR</option>
                        <option value="PN.">PN</option>
                        <option value="PO.">PO</option>
                        <option value="SC.">SC</option>
                        <option value="TJ.">TJ</option>
                    </select>
                </div>
                <div class="col-xs-6">
                    <span class="help-block" >Nro. Cuenta Contable: </span>
                    <select id="cbCuentaContableCartera" class="form-control input-sm" name="cbCuentaContableCartera">
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <span class="help-block" >Monto numeral y literal: </span>
                    <input type="text" class="form-control input-sm" value="" id="txtMontoLiteralCartera" name="txtMontoLiteralCartera" />
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <span class="help-block" >Fecha de préstamo: </span>
                    <input type="text" class="form-control input-sm" value="" id="txtFechaPrestamoCartera" name="txtFechaPrestamoCartera" />
                </div>
                <div class="col-xs-6">
                    <span class="help-block" >Tipo de Préstamo: </span>
                    <select id="cbTipoPrestamoCartera" class="form-control input-sm" name="cbTipoPrestamoCartera">
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-9">
                    <span class="help-block" >Fondo Complementario:</span>
                    <select id="cbFondoComplementarioCartera" class="form-control input-sm" name="cbFondoComplementarioCartera">
                    </select>
                </div>
                <div class="col-xs-3">
                    <span class="help-block" >Hoja de Ruta:</span>
                    <input type="text" class="form-control input-sm" value="" id="txtHojaRutaCartera" name="txtHojaRutaCartera" />
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <span class="help-block" >Nombre del Solicitante:</span>
                    <input type="text" value="del (la) interesado (a)" class="form-control input-sm" value="" id="txtNombreSolicitanteCartera" name="txtNombreSolicitanteCartera"/>
                </div>
                <div class="col-xs-6">
                    <span class="help-block" >Fecha del certificado:</span>
                    <input type="text" class="form-control input-sm" value="" id="txtFechaEmisionCartera" name="txtFechaEmisionCartera" />
                </div>
            </div>
        </fieldset>
            <div class="row">
              <div class="col-xs-12">
                  <div class="modal-footer"> 
                    <button type="button" id="btnGenerarCertificadoCartera" name="btnGenerarCertificadoCartera"  class="btn btn-primary">Guardar y Generar Reporte</button>
                    <button type="button" id="btnCancelarCertificadoCartera" name="btnCancelarCertificadoCartera"  class="btn btn-primary">Cancelar</button>
                </div>
                    
              </div>
            </div>
    </form>
    
</div>
<script type="text/javascript">
        $( document ).ready(function() {
             initializeCartera();
        });
</script>