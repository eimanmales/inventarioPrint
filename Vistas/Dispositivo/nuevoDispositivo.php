<?php include_once("../../Funciones/sessiones.php"); ?>
<!-- quick email widget -->

<div class="box-body">
    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" id="fdispositivo">
                    <div class="form-group row">
                        <label class="control-label col-sm-1" for="IDdispositivo">Codigo:</label>
                        <div class="input-group col-sm-10">

                            <input type="text" class="form-control " id="IDdispositivo" name="IDdispositivo" placeholder="Ingrese Codigo"
                                value="" readonly="true" data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-1" for="serial">Serial:</label>
                        <div class="input-group col-sm-10">

                            <input type="text" class="form-control" id="serial" name="serial" placeholder="Ingrese Serial"
                                value="" required>
                            <span class="error-message" style="color:red; display:none;">Se requiere llenarlo</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-1" for="marca">Marca:</label>
                        <div class="input-group col-sm-10">

                            <input type="text" class="form-control " id="marca" name="marca" placeholder="Ingrese Marca"
                                value="" required>
                            <span class="error-message" style="color:red; display:none;">Se requiere llenarlo</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-1" for="modelo">Modelo:</label>
                        <div class="input-group col-sm-10">

                            <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Ingrese Modelo"
                                value="" required>
                            <span class="error-message" style="color:red; display:none;">Se requiere llenarlo</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-1" for="estadoDis">Estado:</label>
                        <div class="input-group col-sm-10">

                            <select class="form-control" id="estadoDis" name="estadoDis">
                                <option value="">Seleccione ...</option>
                                <option value="Operativa">Operativa</option>
                                <option value="Reparar">Reparar</option>
                                <option value="Inactiva">Inactiva</option>
                            </select>
                            <span class="error-message" style="color:red; display:none;">Se requiere llenarlo</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="IDusuario">Usuario:</label>
                        <div class="input-group col-sm-10">

                            <select class="form-control" id="IDusuario" name="IDusuario">
                                <option value="" selected>Seleccione ...</option>
                                <?php foreach ($listaUsuarios as $fila) { ?>
                                    <option value="<?php echo trim($fila['IDusuario']); ?>">
                                        <?php echo utf8_encode(trim($fila['nombreUsu'])); ?> </option>

                                <?php } ?>
                            </select>
                            <span class="error-message" style="color:red; display:none;">Se requiere llenarlo</span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-1" for="IDcliente">Cliente:</label>
                        <div class="input-group col-sm-10">

                            <select class="form-control" id="IDcliente" name="IDcliente">
                                <option value="" selected>Seleccione ...</option>
                                <?php foreach ($listaClientes as $fila) { ?>
                                    <option value="<?php echo trim($fila['IDcliente']); ?>">
                                        <?php echo utf8_encode(trim($fila['nombreCli'])); ?> </option>

                                <?php } ?>
                            </select>
                            <span class="error-message" style="color:red; display:none;">Se requiere llenarlo</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-1" for="ubicacion">Ubicacion:</label>
                        <div class="input-group col-sm-10">

                            <select class="form-control" id="ubicacion" name="ubicacion">
                                <option value="">Seleccione ...</option>
                                <option value="Almacen">Almacen</option>
                                <option value="Bodega">Bodega</option>
                                <option value="Compras">Compras</option>
                                <option value="Direccion">Direccion</option>
                                <option value="Produccion">Produccion</option>
                                <option value="Ventas">Ventas</option>
                            </select>
                            <span class="error-message" style="color:red; display:none;">Se requiere llenarlo</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="grabar" class="btn btn-primary" data-toggle="tooltip" title="Grabar Dispositivo">Guardar</button>
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