<?php
require_once("modeloAbstractoDB.php");

class Usuario extends ModeloAbstractoDB
{
	private $IDusuario;
	private $nombreUsu;
	private $documentoUsu;
	private $emailUsu;
	private $clave;
	private $rol;
	private $fotoUsu;
	private $estadoUsu;
	private $update_at;

	function __construct()
	{
		//$this->db_name = '';
	}


	public function getIDusuario()
	{
		return $this->IDusuario;
	}


	public function getNombreUsu()
	{
		return $this->nombreUsu;
	}

	public function getDocumentoUsu()
	{
		return $this->documentoUsu;
	}

	public function getEmailUsu()
	{
		return $this->emailUsu;
	}

	public function getClave()
	{
		return $this->clave;
	}

	public function getRol()
	{
		return $this->rol;
	}

	public function getFotoUsu()
	{
		return $this->fotoUsu;
	}

	public function getEstadoUsu()
	{
		return $this->estadoUsu;
	}
	public function getUdate_at()
	{
		return $this->update_at;
	}


	public function consultaLogin($datos = array())
	{

		$documento = $datos['documento'];

		$this->query = "
            SELECT IDusuario, nombreUsu, documentoUsu, emailUsu, clave, rol, fotoUsu, estadoUsu
			FROM usuario 
			WHERE documentoUsu = '$documento'
			";

		$this->obtener_resultados_query();

		if (count($this->rows) == 1):
			foreach ($this->rows[0] as $propiedad => $valor):
				$this->$propiedad = $valor;
			endforeach;
		endif;
	}
	public function consultar($datos = array())
	{

		$codigo = $datos['codigo'];

		$this->query = "
            SELECT IDusuario, nombreUsu, documentoUsu, emailUsu, clave, rol, fotoUsu, estadoUsu
			FROM usuario 
			WHERE IDUsuario = '$codigo'
			";

		$this->obtener_resultados_query();

		if (count($this->rows) == 1):
			foreach ($this->rows[0] as $propiedad => $valor):
				$this->$propiedad = $valor;
			endforeach;
		endif;
	}

	public function lista()
	{
		$this->query = "
			SELECT IDusuario, nombreUsu, documentoUsu, emailUsu, clave, rol, fotoUsu, estadoUsu
			FROM usuario order by IDusuario DESC
			";

		$this->obtener_resultados_query();
		return $this->rows;
	}

	public function generarPassword($pass = "")
	{
		$opciones = [
			'cost' => 12,
		];

		$passwordHashed = password_hash($pass, PASSWORD_BCRYPT, $opciones);

		return $passwordHashed;
	}

	public function nuevo($datos = array())
	{
		if (array_key_exists('IDusuario', $datos)):
			foreach ($datos as $campo => $valor):
				$$campo = $valor;

			endforeach;
			$nombreUsu = isset($datos['nombreUsu']) ? $datos['nombreUsu'] : '';
			$documentoUsu = isset($datos['documentoUsu']) ? $datos['documentoUsu'] : '';
			$emailUsu = isset($datos['emailUsu']) ? $datos['emailUsu'] : '';
			$clave = isset($datos['clave']) ? password_hash($datos['clave'], PASSWORD_DEFAULT) : '';
			$rol = isset($datos['rol']) ? $datos['rol'] : '';
			$fotoUsu = isset($datos['fotoUsu']) ? $datos['fotoUsu'] : '';
			$estadoUsu = isset($datos['estadoUsu']) ? $datos['estadoUsu'] : '';

			$this->query = "
					INSERT INTO usuario
            			(nombreUsu, documentoUsu, emailUsu, clave, rol, fotoUsu, estadoUsu, update_at)
            			VALUES ('$nombreUsu','$documentoUsu','$emailUsu','$clave','$rol','$fotoUsu','$estadoUsu',NOW())
       				 ";

			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		endif;
	}

	public function editar($datos = array())
	{
		foreach ($datos as $campo => $valor):
			$$campo = $valor;
		endforeach;
		$this->query = "
			UPDATE usuario
			SET nombreUsu ='$nombreUsu',
			documentoUsu ='$documentoUsu',
			emailUsu ='$emailUsu',
			clave ='$clave',
			rol ='$rol',
			fotoUsu ='$fotoUsu',
			estadoUsu ='$estadoUsu',
			update_at = NOW()
			WHERE IDusuario = '$IDusuario'
			";
		$resultado = $this->ejecutar_query_simple();
		return $resultado;
	}

	public function borrar($IDusuario = '')
	{
		$this->query = "
			DELETE FROM usuario
			WHERE IDusuario = '$IDusuario'
			";
		$resultado = $this->ejecutar_query_simple();

		return $resultado;
	}

	function __destruct()
	{
		//unset($this);
	}
}
