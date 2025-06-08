<?php include_once("./Funciones/sessiones.php"); ?>
<!-- Left side column. contains the sidebar -->
<?php 
$rolUsuario = $_SESSION['rol']; 
$estadoUsu = $_SESSION['estadoUsu'];
?>
<script>
  const rolUsuario = "<?php echo $rolUsuario; ?>";
  const estadoUsu = "<?php echo $estadoUsu; ?>";
</script>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar" id="navegacionHome">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="./Recursos/img/<?php echo $_SESSION['fotoUsu']; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $_SESSION["nombreUsu"]; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENÚ DE ADMINSITRACIÓN</li>
      <li class="treeview">
        <a href="#">
          <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i> Dashboard </a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-cogs"></i>
          <span>Entidades Pricipales</span>
        </a>
        <ul class="treeview-menu">
          <li><a id="navUsuario" href="./vistas/Usuario/usuario.php"><i class="fas fa-users"></i> Usuarios</a></li>
          <li><a id="navDispositivo" href="./vistas/Dispositivo/dispositivo.php"><i class="fa fa-print"></i> Dispositivos</a></li>
          <li><a id="navCliente" href="./vistas/Cliente/cliente.php"><i class="fas fa-building"></i> Clientes</a></li>

        </ul>
      </li>

  </section>
  <!-- /.sidebar -->
</aside>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {
    //console.log(estadoUsu);
    if (rolUsuario === "Administrador") {
      
    }
    if (rolUsuario === "Coordinador") {
      $("#navUsuario").hide();
    }

    if (rolUsuario === "Tecnico") {
      $("#navUsuario").hide();
      $("#navCliente").hide();
    }
    
  });
</script>
<!-- =============================================== -->