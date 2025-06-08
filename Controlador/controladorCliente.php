<?php
 
require_once '../Modelo/modeloCliente.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $cliente = new Cliente();
        $resultado = $cliente->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $cliente = new Cliente();
        $resultado = $cliente->nuevo($datos);
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
		$cliente = new Cliente();
		$resultado = $cliente->borrar($datos['codigo']);
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
        $cliente = new Cliente();
        $cliente->consultar($datos['codigo']);

        if($cliente->getIDcliente() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'IDcliente' => $cliente->getIDcliente(),
                'nombreCli' => $cliente->getNombreCli(),
                'nit' =>$cliente->getNit(),
                'telefonoCli' => $cliente->getTelefonoCli(),
                'emailCli' => $cliente->getEmailCli(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $cliente = new Cliente();
        $listado = $cliente->lista();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
