<?php

?>

<div id="panelPrincipal">

</div>


<div id="pruebaVico">
    <div id="divTablaCertificado" class="areaTabla areaScroll">
        <div id="botonesTablaCertificado" class="grupoBotonesTabla">
            <button id="btnNuevo" name="btnNuevo" value="0">Nuevo Certificado</button>
            <button id="btnEditar" name="btnEditar" value="0">Editar Certificado</button>
        </div>
        <div>
            <label>hola mundo</label>
        </div>
        <table id="tablaCertificado" name="tablaCertificado" with="100%" class="display">

        </table>
    </div>

</div>
<!--
<div id="divFormularioJuridico" style="display:none">
    <form id="frmCertificadoJuridico" class="frmCertificadoJuridico">

        <div id="frmJuridicaContenedor">
            <fieldset id="datosCertificado">
                <legend>Datos del Certificado</legend>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <span class="help-block" >Existencia del Proceso: </span>
                            <select id="cbExistencia" class="form-control input-sm" name="cbExistencia">
                                <option value="1">Existe</option>
                                <option value="2">No Existe</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <span class="help-block" >Nombre Completo: </span>
                            <input tabindex="1" type="text" class="form-control input-sm" value="" id="txtNombreCompleto" name="txtNombreCompleto" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <span class="help-block">Carnet de Identidad: </span>
                            <input tabindex="2" class="form-control input-sm" type="text" value="" id="txtCi" name="txtCi" />
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <span class="help-block">Nota de Cargo: </span>
                            <input tabindex="3" class="form-control input-sm"  type="text" value="" id="txtNotaCargo" name="txtNotaCargo" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <span class="help-block">Monto y Literal: </span>
                            <input tabindex="4" class="form-control input-sm" type="text" value="" id="txtMonto" name="txtMonto" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <span class="help-block">Radicado: </span>
                            <input tabindex="4" class="form-control input-sm" type="text" value="" id="txtRadicado" name="txtRadicado" />
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <span class="help-block">Hoja de Ruta: </span>
                            <input tabindex="4" class="form-control input-sm" type="text" value="" id="txtHojaRuta" name="txtHojaRuta" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <span class="help-block">Entidad: </span>
                            <select id="cbEntidad" class="form-control input-sm" name="cbEntidad">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <span class="help-block">Entidad: </span>
                            <select id="cbEntidad" class="form-control input-sm" name="cbEntidad">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <span class="help-block">Sexo: </span>
                <div class="radio">
                    <label>
                        <input type="radio" name="opciones" id="masculino" value="el" checked>
                        Masculino
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="opciones" id="femenino" value="la">
                        Femenino
                    </label>
                </div>
                </div>
                <input tabindex="6"  type='hidden' id='txtIdCertificado' name='txtIdCertificado'  value=''/>

            </fieldset>
        </div>
    </form>

</div>
-->
<!--para el formulario de certificado del area juridica-->
<div class="modal fade" id="modalFormularioJuridico" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Datos del Certificado</h4>
            </div>
            <div class="modal-body">
                <form id="frmCertificadoJuridico" class="frmCertificadoJuridico">

                    <div id="frmJuridicaContenedor">
                        <fieldset id="datosCertificado">
                            <legend>Datos del Certificado</legend>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <span class="help-block" >Existencia del Proceso: </span>
                                        <select id="cbExistencia" class="form-control input-sm" name="cbExistencia">
                                            <option value="1">Existe</option>
                                            <option value="2">No Existe</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <span class="help-block" >Nombre Completo: </span>
                                        <input tabindex="1" type="text" class="form-control input-sm" value="" id="txtNombreCompleto" name="txtNombreCompleto" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <span class="help-block">Carnet de Identidad: </span>
                                        <input tabindex="2" class="form-control input-sm" type="text" value="" id="txtCi" name="txtCi" />
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <span class="help-block">Nota de Cargo: </span>
                                        <input tabindex="3" class="form-control input-sm"  type="text" value="" id="txtNotaCargo" name="txtNotaCargo" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <span class="help-block">Monto y Literal: </span>
                                        <input tabindex="4" class="form-control input-sm" type="text" value="" id="txtMonto" name="txtMonto" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <span class="help-block">Radicado: </span>
                                        <input tabindex="4" class="form-control input-sm" type="text" value="" id="txtRadicado" name="txtRadicado" />
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <span class="help-block">Hoja de Ruta: </span>
                                        <input tabindex="4" class="form-control input-sm" type="text" value="" id="txtHojaRuta" name="txtHojaRuta" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <span class="help-block">Entidad: </span>
                                        <select id="cbEntidad" class="form-control input-sm" name="cbEntidad">
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="help-block">Sexo: </span>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="opciones" id="masculino" value="el" checked>
                                        Masculino
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="opciones" id="femenino" value="la">
                                        Femenino
                                    </label>
                                </div>
                            </div>
                            <input tabindex="6"  type='hidden' id='txtIdCertificado' name='txtIdCertificado'  value=''/>

                        </fieldset>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id ="guardaCertificadoJuridico" class="btn btn-default" data-dismiss="modal">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!--fin garante-->

<script>
    $(document).ready(function(){
        //cargaTablaCertificado(49);
        dialogoNuevoJuridico();
       // guardaDatos();
        cargarFondoComplementarios();
    });
</script>