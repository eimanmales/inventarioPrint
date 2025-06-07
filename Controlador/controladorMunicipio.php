<?php

require_once '../Modelo/modeloMunicipio.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $municipio = new Municipio();
		$municipio->editar($datos);
        break;
    case 'nuevo':
        $municipio = new Municipio();
		$municipio->nuevo($datos);

        $resultado = $municipio->nuevo($datos);
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

    case 'borrar':
		$municipio = new Municipio();
		$municipio->borrar($datos['codigo']);
        break;
    case 'listar':
        $municipio = new Municipio();
        $listado = $municipio->lista();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;
}
?>
