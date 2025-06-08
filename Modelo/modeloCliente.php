<?php
    require_once("modeloAbstractoDB.php");
	
    class Cliente extends ModeloAbstractoDB {
		private $IDcliente;
		private $nombreCli;
		private $nit;
		private $telefonoCli;
		private $emailCli;
		private $update_at;
		
		function __construct() {
			//$this->db_name = '';
		}

		public function getIDcliente(){
			return $this->IDcliente;
		}

		public function getNombreCli(){
			return $this->nombreCli;
		}
		
		public function getNit(){
			return $this->nit;
		}

		public function getTelefonoCli(){
			return $this->telefonoCli;
		}

		public function getEmailCli(){
			return $this->emailCli;
		}
		
		public function getUpdate_at(){
			return $this->update_at;
		}


		public function consultar($IDcliente='') {
			if($IDcliente !=''):
				$this->query = "
				SELECT IDcliente, nombreCli, nit, telefonoCli, emailCli
				FROM cliente
				WHERE IDcliente = '$IDcliente' order by IDcliente
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
			SELECT IDcliente, nombreCli, nit, telefonoCli, emailCli
				FROM cliente
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}
		
		public function nuevo($datos=array()) {
			if(array_key_exists('IDcliente', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
					INSERT INTO cliente
					(nombreCli, nit, telefonoCli, emailCli, update_at)
					VALUES
					('$nombreCli', '$nit', '$telefonoCli', '$emailCli', NOW())
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
			UPDATE cliente
			SET nombreCli ='$nombreCli',
			nit ='$nit',
			telefonoCli ='$telefonoCli',
			emailCli ='$emailCli',
			update_at = NOW()
			WHERE IDcliente = '$IDcliente'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($IDcliente='') {
			$this->query = "
			DELETE FROM cliente
			WHERE IDcliente = '$IDcliente'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>