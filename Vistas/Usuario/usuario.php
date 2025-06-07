<?php include_once ("../../Funciones/sessiones.php"); ?>
      
      <h1>
        Gestión de
        <small>  Usuarios</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Usuario</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Listado de Usuarios</h3>
              <div class="box-tools pull-right">
                  <button class="btn btn-info btn-sm" id="nuevo"  data-toggle="tooltip" 
                      title="Nueva Comuna"><i class="fa fa-plus" aria-hidden="true"></i></button> 
              </div>
            </div>
           
        
            <!-- /.box-header -->
            <div class="box-body">
            <div id="editar"></div>
            <div id="listado">
              <table id="tabla" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>IDusuario</th>
                  <th>nombreUsu</th>
                  <th>documentoUsu</th>
                  <th>emailUsu</th>
                  <th>clave</th>
                  <th>rol</th>
                  <th>fotoUsu</th>
                  <th>estadoUsu</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                <!--<tfoot>
                <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Documento</th>
                  <th>Email</th>
                  <th>Clave</th>
                  <th>Rol</th>
                  <th>Foto</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
                </tfoot>-->
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->

<script src="./Recursos/js/funcionesUsuario.js"></script>
<!-- Funciones de Lógica de neogcio -->
<script>
    $(document).ready(usuario);
</script>


