<?php
require_once '../Modelo/modeloUsuario.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Validar que los datos vienen bien
if (!isset($_POST['documento'], $_POST['clave'], $_POST['accion'])) {
    echo json_encode(['respuesta' => 'no existe']);
    exit;
}

$usuario = htmlspecialchars(trim("$_POST[documento]"));
$password = htmlspecialchars(trim("$_POST[clave]"));

$datos = array("documento"=>$usuario, "clave"=>$password);

switch ($_POST['accion']){   
    case 'login':
        $usuario = new Usuario();
        $usuario->consultar($datos);

        if($usuario->getIDusuario() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            if(password_verify($datos['clave'],$usuario->getClave())){
                session_start();
                $_SESSION['documentoUsu'] = $usuario->getDocumentoUsu();
                $_SESSION['nombreUsu'] = $usuario->getNombreUsua();
                $_SESSION['fotoUsu'] = $usuario->getFotoUsu();
                $respuesta = array(
                    'respuesta' =>'existe'
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'no existe'
                );
            }
            
        }
        echo json_encode($respuesta);
        break;
    break;
    case 'editar':
        $usuario = new Usuario();
        $resultado = $usuario->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $usuario = new Usuario();
        $resultado = $usuario->nuevo($datos);
        if($resultado > 0) {
            $respuesta = array(
                'respuesta' => $resultado
            );
        }  else {
            $respuesta = array(
                'respuesta' => $resultado
            );
        }
        echo json_encode($respuesta);
        break;
       
    case 'borrar':
		$usuario = new Usuario();
		$resultado = $usuario->borrar($datos['codigo']);
        if($resultado > 0) {
            $respuesta = array(
                'respuesta' => 'correcto'
            );
        }  else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'consultar':
        $usuario = new Usuario();
        $usuario->consultar($datos['codigo']);

        if($usuario->getComu_codi() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'IDusuario' => $usuario->getIDusuario(),
                'nombreUsu' => $usuario->getNombreUsua(),
                'documentoUsu' =>$usuario->getDocumentoUsu(),
                'emailUsu' => $usuario->getEmailUsu(),
                'clave' => $usuario->getClave(),
                'rol' =>$usuario->getRol(),
                'fotoUsu' => $usuario->getFotoUsu(),
                'estadoUsu' =>$usuario->getEstadoUsu(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        try {
            $usuario = new Usuario();
            $listado = $usuario->lista();
            echo json_encode(['data' => $listado], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            echo json_encode(['data' => [], 'error' => $e->getMessage()]);
        }
        break;
}
?>
