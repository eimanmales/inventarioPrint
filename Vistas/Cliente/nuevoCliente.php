<?php include_once("../../Funciones/sessiones.php"); ?>
<!-- quick email widget -->

<div class="box-body">
    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" id="fusuario">
                    <div class="form-group row">
                        <label class="control-label col-sm-1" for="IDusuario">Codigo:</label>
                        <div class="input-group col-sm-10">

                            <input type="text" class="form-control " id="IDusuario" name="IDusuario" placeholder="Ingrese Codigo"
                                value="" readonly="true" data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-1" for="nombreUsu">Nombre:</label>
                        <div class="input-group col-sm-10">

                            <input type="text" class="form-control" id="nombreUsu" name="nombreUsu" placeholder="Ingrese Nombre"
                                value="" required>
                                <span class="error-message" style="color:red; display:none;">Se requiere llenarlo</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-1" for="documentoUsu">Documento:</label>
                        <div class="input-group col-sm-10">

                            <input type="text" class="form-control " id="documentoUsu" name="documentoUsu" placeholder="Ingrese numero Documento"
                                value="" required>
                                <span class="error-message" style="color:red; display:none;">Se requiere llenarlo</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-1" for="emailUsu">Email:</label>
                        <div class="input-group col-sm-10">

                            <input type="email" class="form-control" id="emailUsu" name="emailUsu" placeholder="ejemplo@correo.com"
                                value="" required>
                                <span class="error-message" style="color:red; display:none;">Se requiere llenarlo</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-1" for="clave">Contraseña:</label>
                        <div class="input-group col-sm-10">

                            <input type="password" class="form-control " id="clave" name="clave" placeholder="Ingrese su contraseña"
                                value="" required>
                                <span class="error-message" style="color:red; display:none;">Se requiere llenarlo</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-1" for="rol">Rol:</label>
                        <div class="input-group col-sm-10">

                            <select class="form-control" id="rol" name="rol">
                                <option value="">Seleccione ...</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Coordinador">Coordinador</option>
                                <option value="Tecnico">Técnico</option>
                            </select>
                            <span class="error-message" style="color:red; display:none;">Se requiere llenarlo</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-1" for="fotoUsu">Foto:</label>
                        <div class="input-group col-sm-10">
                            <input type="file" class="form-control" id="fotoUsu1" name="fotoUsu1" accept="image/*" onchange="capturarNombre()">
                            <input type="hidden" id="fotoUsu" name="fotoUsu">
                            
                        </div>
                        <script>
                            function capturarNombre() {
                                const input = document.getElementById('fotoUsu1');
                                const archivo = input.files[0];
                                if (archivo) {
                                    const nombre = archivo.name;
                                    document.getElementById('fotoUsu').value = nombre;
                                    //console.log("Nombre de imagen seleccionada:", nombre);
                                }
                            }
                        </script>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-1" for="estadoUsu">Estado:</label>
                        <div class="input-group col-sm-10">

                            <select class="form-control" id="estadoUsu" name="estadoUsu">
                                <option value="">Seleccione ...</option>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                            <span class="error-message" style="color:red; display:none;">Se requiere llenarlo</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="grabar" class="btn btn-primary" data-toggle="tooltip" title="Guardar Usuario">Guardar</button>
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