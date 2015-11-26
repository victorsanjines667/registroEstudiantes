<?php
?>
<style>
    #contenedorFrmContabilidad{
        width: 600px;
    }
</style>

<div id="contenedorFrmContabilidad">
    <form id="frmContabilidad">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-3">
                
            </div>
            <div class="col-lg-6">
                <span class="help-block">Tipo de Certificado:</span>
                <select id="contSelTipoCertificado" name="contSelTipoCertificado" class="form-control input-sm">
                    <option value="0">Seleccione un certificado</option>
                    <option value="1">Certificado de Deuda</option>
                    <option value="2">Certificado de Trabajo</option>
                </select>            
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <span class="help-block">Género:</span>
                <select id="contSelGenero" name="contSelGenero" class="form-control input-sm">
                    <option value="el señor">señor</option>
                    <option value="la señora">señora</option>
                </select>            
            </div>
            <div class="col-lg-6">
                <span class="help-block">Nombre Persona:</span>
                <input id="contTxtNombrePersona" name="contTxtNombrePersona" type="text" class="form-control input-sm">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <span class="help-block">CI:</span>
                <input id="contTxtCI" name="contTxtCI" type="text" class="form-control input-sm">
            </div>
            <div class="col-lg-6">
                <span class="help-block">Cuenta Contable:</span>
                <select id="contSelCuentaContable" name="contSelCuentaContable" class="form-control input-sm contControlesTrabajo">
                </select>
<!--                <input id="contNroCuenta" name="contNroCuenta" type="text" class="form-control input-sm"> -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <span class="help-block cargo">Cargo:</span>
                <span class="help-block monto" style="display:none;">Monto:</span>
                <input id="contTxtCargo" name="contTxtCargo" type="text" class="form-control input-sm contControlesDeuda cargo">
                <input id="contTxtMonto" name="contTxtMonto" type="text" class="form-control input-sm contControlesTrabajo monto" style="display:none;">
            </div>
            <div class="col-lg-6">
                <span class="help-block fechaInicio">Fecha Inicio:</span>
                <span class="help-block fechaCertificado" style="display:none;">Fecha Certificado:</span>
                <input id="contTxtFechaInicio" name="contTxtFechaInicio" type="text" class="form-control input-sm  txtCalendario">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <span class="help-block">Fecha Final:</span>
                <input id="contTxtFechaFinal" name="contTxtFechaFinal" type="text" class="form-control input-sm  txtCalendario contControlesDeuda">
            </div>
            <div class="col-lg-6">
                <span class="help-block">Hoja de Ruta:</span>
                <input id="contTxtHojaRuta" name="contTxtHojaRuta" type="text" class="form-control input-sm">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <span class="help-block">Fondo Complementario:</span>
                <select id="contSelFondoComplementario" name="contSelFondoComplementario" class="form-control input-sm">
                </select>
            </div>
            <div class="col-lg-6">
                <span class="help-block">Texto Nota:</span>
                <input id="contTxtTextoNota" name="contTxtTextoNota" type="text" class="form-control input-sm" value="del (la) interesado (a)">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <span class="help-block">Fecha Emisión:</span>
                <input id="contTxtFechaEmision" name="contTxtFechaEmision" type="text" class="form-control input-sm txtCalendario" value="">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <input type="hidden" name="accion" id="txtFormContabilidadAccion" value="guardaCertificadoContabilidad" />
                <input type="hidden" name="txtIdCertificadoContabilidad" id="txtIdCertificadoContabilidad" name="txtIdCertificadoContabilidad" value=""/>
                <div class="modal-footer"> 
                    <button id="btnContabilidadGuardar" name="" value="" class="btn btn-primary" >Generar Certificado</button>
                    <button id="btnContabilidadActualizar" name="" value="" class="btn btn-primary"  style="display:none">Actualizar</button>
                    <button id="btnContabilidadCancelar" name="" value="" class="btn btn-primary" >Cancelar</button>
                </div>
            </div> 
        </div>
    </form>

</div>


<script type="text/javascript">
    $(document).ready(function(){
        operacionesContabilidad();
    });
</script>