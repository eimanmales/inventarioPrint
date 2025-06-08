<?php
require_once '../Modelo/modeloUsuario.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

$datos = array_map('trim', $_POST);

file_put_contents("debug.log", print_r($_POST, true));
//var_dump($_POST);
//exit;

switch ($_POST['accion']) {
    case 'login':
        if (!isset($_POST['documento'], $_POST['clave'])) {
            echo json_encode(['respuesta' => 'faltan datos']);
            exit;
        }

        $usuario = htmlspecialchars(trim($_POST['documento']));
        $password = htmlspecialchars(trim($_POST['clave']));
        $datos = array("documento" => $usuario, "clave" => $password);

        $usuario = new Usuario();
        $usuario->consultaLogin($datos);

        if ($usuario->getEstadoUsu() !== "Activo") {
            $respuesta = array(
                "respuesta" => "inactivo"
            );
        } else {
            if (password_verify($datos['clave'], $usuario->getClave())) {
                session_start();
                $_SESSION['documentoUsu'] = $usuario->getDocumentoUsu();
                $_SESSION['nombreUsu'] = $usuario->getNombreUsu();
                $_SESSION['fotoUsu'] = $usuario->getFotoUsu();
                $_SESSION['rol'] = $usuario->getRol();
                $_SESSION['estadoUsu'] = $usuario->getEstadoUsu();
                $respuesta = array(
                    'respuesta' => 'existe'
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'no existe'
                );
            }
        }
        echo json_encode($respuesta);
        break;

    case 'editar':
        //var_dump($_POST);
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

        // Valida que sea numérico (porque puede retornar false si falla)
        if ($resultado && is_numeric($resultado)) {
            $respuesta = array(
                'respuesta' => true,
                'id' => $resultado // Si deseas devolver el ID insertado
            );
        } else {
            // Puedes usar un mensaje más útil si habilitas logs
            $respuesta = array(
                'respuesta' => false,
                'error' => 'No se pudo insertar el usuario'
            );
        }

        // Importante: Asegúrate que no haya ECHO antes
        header('Content-Type: application/json'); // Opcional pero recomendado
        echo json_encode($respuesta);
        break;

    case 'borrar':
        $usuario = new Usuario();
        $resultado = $usuario->borrar($datos['codigo']);
        if ($resultado > 0) {
            $respuesta = array(
                'respuesta' => 'correcto'
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'consultar':
        //var_dump($_POST);
        $codigo = htmlspecialchars(trim($_POST['codigo']));
        $datos = array('codigo' => $codigo);
        $usuario = new Usuario();
        $usuario->consultar($datos);

        if ($usuario->getIDusuario() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        } else {
            $respuesta = array(
                'IDusuario' => $usuario->getIDusuario(),
                'nombreUsu' => $usuario->getNombreUsu(),
                'documentoUsu' => $usuario->getDocumentoUsu(),
                'emailUsu' => $usuario->getEmailUsu(),
                'clave' => $usuario->getClave(),
                'rol' => $usuario->getRol(),
                'fotoUsu' => $usuario->getFotoUsu(),
                'estadoUsu' => $usuario->getEstadoUsu(),
                'respuesta' => 'existe'
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
