<?php

require_once '../Modelo/modeloDispositivo.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $dispositivo = new Dispositivo();
        $resultado = $dispositivo->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $dispositivo = new Dispositivo();
        $resultado = $dispositivo->nuevo($datos);
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
		$dispositivo = new Dispositivo();
		$resultado = $dispositivo->borrar($datos['codigo']);
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
        $dispositivo = new Dispositivo();
        $dispositivo->consultar($datos['codigo']);

        if($dispositivo->getIDdispositivo() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'IDdispositivo' => $dispositivo->getIDdispositivo(),
                'serial' => $dispositivo->getSerial(),
                'marca' =>$dispositivo->getMarca(),
                'modelo' =>$dispositivo->getModelo(),
                'estadoDis' => $dispositivo->getEstadoDis(),
                'IDusuario' => $dispositivo->getIDusuario(),
                'IDcliente' => $dispositivo->getIDcliente(),
                'ubicacion' => $dispositivo->getUbicacion(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $dispositivo = new Dispositivo();
        $listado = $dispositivo->lista();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
