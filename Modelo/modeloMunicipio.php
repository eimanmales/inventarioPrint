<?php
	require_once('modeloAbstractoDB.php');
	class Municipio extends ModeloAbstractoDB {
		public $muni_codi;
		public $muni_nomb;
		public $depa_codi;
		
		function __construct() {
			//$this->db_name = '';
		}
		
		public function consultar($muni_codi='') {
			if($comu_codi != ''):
				$this->query = "
				SELECT comu_codi, comu_nomb, muni_codi
				FROM tb_comuna
				WHERE comu_codi = '$comu_codi'
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
			SELECT muni_codi, muni_nomb, d.depa_nomb
			FROM tb_municipio as m inner join tb_departamento as d
			ON (m.depa_codi = d.depa_codi) ORDER BY m.muni_nomb
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		public function listaMunicipio() {
			$this->query = "
			SELECT muni_codi, muni_nomb
			FROM tb_municipio as m order by muni_nomb
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		
		public function nuevo($datos=array()) {
			if(array_key_exists('comu_codi', $datos)):
				$this->consultar($datos['comu_codi']);
				if($datos['comu_codi'] != $this->comu_codi):
					foreach ($datos as $campo=>$valor):
						$$campo = $valor;
					endforeach;
					$this->query = "
					INSERT INTO tb_comuna
					(comu_codi, comu_nomb, muni_codi)
					VALUES
					('$comu_codi', '$comu_nomb', '$muni_codi')
					";
					$this->ejecutar_query_simple();
				endif;
			endif;
		}
		
		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$this->query = "
			UPDATE tb_comuna
			SET comu_nomb='$comu_nomb',
			muni_codi='$muni_codi'
			WHERE comu_codi = '$comu_codi'
			";
			$this->ejecutar_query_simple();
		}
		
		public function borrar($comu_codi='') {
			$this->query = "
			DELETE FROM tb_comuna
			WHERE comu_codi = '$comu_codi'
			";
			$this->ejecutar_query_simple();
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>