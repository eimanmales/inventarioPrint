<?php
	require_once('modeloAbstractoDB.php');
	class Dispositivo extends ModeloAbstractoDB {
		private $IDdispositivo;
		private $serial;
		private $marca;
		private $modelo;
		private $estadoDis;
		private $IDusuario;
		private $IDcliente;
		private $ubicacion;
		private $update_at;
		
		function __construct() {
			//$this->db_name = '';
		}
	
		public function getIDdispositivo()
		{
			return $this->IDdispositivo;
		}

		public function getSerial()
		{
			return $this->serial;
		}

		public function getMarca()
		{
			return $this->marca;
		}

		public function getModelo()
		{
			return $this->modelo;
		}

		public function getEstadoDis()
		{
			return $this->estadoDis;
		}

		public function getIDusuario()
		{
			return $this->IDusuario;
		}

		public function getIDcliente()
		{
			return $this->IDcliente;
		}

		public function getUbicacion()
		{
			return $this->ubicacion;
		}

		public function getUpdateAt()
		{
			return $this->update_at;
		}
		
		public function consultar($IDdispositivo='') {
			if($IDdispositivo != ''):
				$this->query = "
				SELECT IDdispositivo, serial, marca, modelo, estadoDis, IDusuario, IDcliente, ubicacion
				FROM dispositivo
				WHERE IDdispositivo = '$IDdispositivo'
				";
				$this->obtener_resultados_query();
			endif;
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		public function lista() {
			$this->query = "
			SELECT IDdispositivo, serial, marca, modelo, estadoDis, d.IDusuario, d.IDcliente, u.nombreUsu, c.nombreCli, ubicacion
			FROM dispositivo as d 
			inner join usuario as u ON (d.IDusuario = u.IDusuario)
			inner join cliente as c ON (d.IDcliente = c.IDcliente)
			ORDER BY d.marca
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		public function listaMunicipio() {
			$this->query = "
			SELECT IDdispositivo, serial, marca, modelo, estadoDis, IDusuario, IDcliente, ubicacion
			FROM dispositivo order by marca
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		
		public function nuevo($datos=array()) {
			if(array_key_exists('IDdispositivo', $datos)):
					foreach ($datos as $campo=>$valor):
						$$campo = $valor;
					endforeach;
					$serial = isset($datos['serial']) ? $datos['serial'] : '';
					$marca = isset($datos['marca']) ? $datos['marca'] : '';
					$modelo = isset($datos['modelo']) ? $datos['modelo'] : '';
					$estadoDis = isset($datos['estadoDis']) ? $datos['estadoDis'] : '';
					$IDusuario = isset($datos['IDusuario']) ? $datos['IDusuario'] : '';
					$IDcliente = isset($datos['IDcliente']) ? $datos['IDcliente'] : '';
					$ubicacion = isset($datos['ubicacion']) ? $datos['ubicacion'] : '';
					
					$this->query = "
					INSERT INTO dispositivo
					(serial, marca, modelo, estadoDis, IDusuario, IDcliente, ubicacion, update_at)
					VALUES
					('$serial', '$marca', '$modelo', '$estadoDis', '$IDusuario', '$IDcliente', '$ubicacion',NOW())
					";
					$resultado = $this->ejecutar_query_simple();
					return $resultado;
			endif;
			
		}
		
		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$this->query = "
			UPDATE dispositivo
			SET serial='$serial',
			marca='$marca',
			modelo='$modelo',
			estadoDis='$estadoDis',
			IDusuario='$IDusuario',
			IDcliente='$IDcliente',
			ubicacion='$ubicacion',
			update_at = NOW()
			WHERE IDdispositivo = '$IDdispositivo'
			";
			$resultado = $this->ejecutar_query_simple();
				return $resultado;
		}
		
		public function borrar($IDdispositivo='') {
			$this->query = "
			DELETE FROM dispositivo
			WHERE IDdispositivo = '$IDdispositivo'
			";
			$resultado = $this->ejecutar_query_simple();
				return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}

	}
?>