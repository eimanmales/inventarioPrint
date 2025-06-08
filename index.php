<?php
  session_start();

  if(isset($_GET["cerrar_session"]) and $_GET["cerrar_session"]==true){
    session_destroy();
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="Recursos/css/bootstrap.min.css">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
 
  <!-- Ionicons -->
  <link rel="stylesheet" href="Recursos/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="Recursos/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="Recursos/css/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card-header text-center">
    <a href="#" class="h1"><b>Print</b>Ops</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingresa las Credenciales</p>

    <form id="login-form" action="" method="post">
      <div class="form-group has-feedback">
        <input type="type" id="documento" name="documento" class="form-control" placeholder="Usuario">
        <span class="form-control-feedback"><i class="fas fa-user-tie"></i></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="clave" name="clave" class="form-control" placeholder="Password">
        <span class="form-control-feedback"> <i class="fas fa-key"></i></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <a href="#">¿Olvidó su contraseña?</a>
          <br><br>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" id="ingresar" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
        <!-- /.col -->
        <input type="hidden" value="login" name="accion">
      </div>
    </form>

   
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.2/sweetalert2.all.js"></script>
<script src="./Recursos/js/funcionesUsuario.js"></script>
<!-- Funciones de Lógica de neogcio -->
<script>
    $(document).ready(usuario);
</script>


</body>
</html>
