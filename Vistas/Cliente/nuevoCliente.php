<?php include_once("../../Funciones/sessiones.php"); ?>
<!-- quick email widget -->

<div class="box-body">
    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" id="fcliente">
                    <div class="form-group row">
                        <label class="control-label col-sm-1" for="IDcliente">Codigo:</label>
                        <div class="input-group col-sm-10">

                            <input type="text" class="form-control " id="IDcliente" name="IDcliente" placeholder="Ingrese Codigo"
                                value="" readonly="true" data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-1" for="nombreCli">Nombre:</label>
                        <div class="input-group col-sm-10">

                            <input type="text" class="form-control" id="nombreCli" name="nombreCli" placeholder="Ingrese Nombre"
                                value="" required>
                                <span class="error-message" style="color:red; display:none;">Se requiere llenarlo</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-1" for="nit">Nit:</label>
                        <div class="input-group col-sm-10">

                            <input type="text" class="form-control " id="nit" name="nit" placeholder="Ingrese numero Nit"
                                value="" required>
                                <span class="error-message" style="color:red; display:none;">Se requiere llenarlo</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-1" for="telefonoCli">Telefono:</label>
                        <div class="input-group col-sm-10">

                            <input type="text" class="form-control" id="telefonoCli" name="telefonoCli" placeholder="Ingrese numero Telefono"
                                value="" required>
                                <span class="error-message" style="color:red; display:none;">Se requiere llenarlo</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-1" for="emailCli">Email:</label>
                        <div class="input-group col-sm-10">

                            <input type="email" class="form-control" id="emailCli" name="emailCli" placeholder="ejemplo@correo.com"
                                value="" required>
                                <span class="error-message" style="color:red; display:none;">Se requiere llenarlo</span>
                        </div>
                    </div>
                    

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="grabar" class="btn btn-primary" data-toggle="tooltip" title="Guardar Cliente">Guardar</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

                    <input type="hidden" id="nuevo" value="nuevo" name="accion" />
                    </fieldset>

                </form>
            </div>

            
                <style>
                .input-error {
                border: 1px solid red;
                }
                .mensaje-error {
                color: red;
                font-size: 12px;
                margin-top: 3px;
                }
                </style>