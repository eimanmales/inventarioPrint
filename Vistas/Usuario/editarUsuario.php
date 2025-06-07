<?php include_once ("../../Funciones/sessiones.php"); ?>
<!-- quick email widget -->


    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fcomuna">
 					<div class="form-group">
                        <label class="control-label col-sm-2" for="comu_codi">Codigo:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="comu_codi" name="comu_codi" placeholder="Ingrese Codigo"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="comu_nomb">Nombre:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="comu_nomb" name="comu_nomb" placeholder="Ingrese Nombre comuna"
                            value = "">
                        </div>
                    </div>
					
					
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="muni_codi">Municipio:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="muni_codi" name="muni_codi">
                            <option value="" selected>Seleccione ...</option>
								<?php foreach($listaMunicipio as $fila){ ?>
								<option value="<?php echo trim($fila['muni_codi']); ?>" >
								<?php echo utf8_encode(trim($fila['muni_nomb'])); ?> </option>

								<?php } ?>
							</select>	
                        </div>
                    </div>

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip" title="Actualizar Comuna">Actualizar Comuna</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="editar" name="accion"/>
			</fieldset>

		</form>
	</div>
