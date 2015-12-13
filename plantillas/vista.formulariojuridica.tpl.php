<style type="text/css">
#divFormularioCertitificadoCartera {
    width: 600px;
    padding: .5em .5em .5em .5em;
    margin: 0 auto;
}

</style>
<!--para el formulario de certificado del area juridica-->
                <form id="frmCertificadoJuridico" class="frmCertificadoJuridico">
                      <input type="hidden" id="accion" name="accion" value="guardaCertificadoJuridica" />
                      <input type="hidden" id="idCerti" name="idCerti" value="" />
                    <div id="frmJuridicaContenedor">
                        <fieldset id="datosCertificado">
                            <legend>Datos del Certificado</legend>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <span class="help-block" >Existencia del Proceso: </span>
                                        <select id="cbExistencia" class="form-control input-sm" name="cbExistencia">
                                            <option value="0">Seleccione una opción</option>
                                            <option value="1">Existe</option>
                                            <option value="2">No Existe</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!--<div class="col-xs-4">
                                            <div class="form-group">
                                            <span class="help-block">Género: </span>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="opcionesJuridica" id="masculino" value="el" checked>
                                                    Masculino
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="opcionesJuridica" id="femenino" value="la">
                                                    Femenino
                                                </label>
                                            </div>
                                        </div>
                                </div>-->
                                <div class="col-xs-4">
                                    <span class="help-block" >Género:</span>
                                    <select id="cbGeneroJuridica" name="cbGeneroJuridica" class="form-control input-sm">
                                        <option value="el señor">señor</option>
                                        <option value="la señora">señora</option>
                                    </select>
                				</div>
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <span class="help-block" >Nombre Completo: </span>
                                        <input tabindex="1" type="text" class="form-control input-sm" value="" id="txtNombreCompletoJuridica" name="txtNombreCompletoJuridica" />
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <span class="help-block">Carnet de Identidad: </span>
                                        <input tabindex="2" class="form-control input-sm" type="text" value="" id="txtCiJuridica" name="txtCiJuridica" />
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <span class="help-block">Monto y Literal: </span>
                                        <input tabindex="4" class="form-control input-sm contControlesNoExiste" type="text" value="" id="txtMontoJuridica" name="txtMontoJuridica" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <span class="help-block">Nota de Cargo: </span>
                                        <input tabindex="3" class="form-control input-sm contControlesNoExiste"  type="text" value="" id="txtNotaCargoJuridica" name="txtNotaCargoJuridica" />
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <span class="help-block">Radicado: </span>
                                        <input tabindex="4" class="form-control input-sm contControlesNoExiste" type="text" value="" id="txtRadicadoJuridica" name="txtRadicadoJuridica" />
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <span class="help-block">Hoja de Ruta: </span>
                                        <input tabindex="4" class="form-control input-sm" type="text" value="" id="txtHojaRutaJuridica" name="txtHojaRutaJuridica" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <span class="help-block">Entidad: </span>
                                        <select id="cbEntidad" class="form-control input-sm" name="cbEntidad">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4" id="fechaModificacionJuridica">
                                    <div class="form-group">
                                        <span class="help-block" >Fecha de emisión: </span>
                    					<input type="text" class="form-control input-sm txtCalendario" value="" id="txtFechaEmisionJuridica" name="txtFechaEmisionJuridica" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            	<div class="col-xs-6">
                                    <div class="form-group">
                                        <span class="help-block">Solicitante: </span>
                                        <input tabindex="4" class="form-control input-sm" type="text" value="del (la) interesado (a)" id="txtSolicitanteJuridica" name="txtSolicitanteJuridica" />
                                    </div>
                                </div>
                                
                            </div>

                            
                            <input tabindex="6"  type='hidden' id='txtIdCertificado' name='txtIdCertificado'  value=''/>

                        </fieldset>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
          
                <button type="button" id ="guardaCertificadoJuridico" class="btn btn-primary">Generar Certificado</button>
              
             
                <button type="button" id ="editarCertificadoJuridico" class="btn btn-primary" style="display:none">Editar Certificado</button>
            
                <button type="button" id ="cancelarCertificadoJuridico" class="btn btn-primary">Cancelar</button>
                
            </div>
   
<!--fin garante-->

<script>
    $(document).ready(function(){
        //cargaTablaCertificado(49);
		//$('#fechaModificacionJuridica').datepicker({format:"dd/mm/yyyy"});
		$(".txtCalendario").datepicker({
        format: 'dd/mm/yyyy',
        language: 'es',
		orientation: 'auto top'
    	});
        dialogoNuevoJuridico();
        operacionesFormulario();
        cargarFondoComplementarios();
		guardaDatos();
		editaDatos();
		cancelar();
		//editarCertificadoJuridica();
    });
</script>