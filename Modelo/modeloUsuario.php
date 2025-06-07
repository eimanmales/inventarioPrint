<?php
    require_once("modeloAbstractoDB.php");
	
    class Usuario extends ModeloAbstractoDB {
        private $IDusuario;
        private $nombreUsu;
		private $documentoUsu;
		private $emailUsu;
        private $clave;
        private $rol;
		private $estadoUsu;
		private $update_at;
		
		function __construct() {
			//$this->db_name = '';
		}


		public function getIDusuario(){
			return $this->IDusuario;
		}

        
        public function getNombreUsua(){
			return $this->nombreUsu;
		}

		public function getDocumentoUsu(){
			return $this->documentoUsu;
		}

		public function getEmailUsu(){
			return $this->emailUsu;
		}
		
		public function getClave(){
			return $this->clave;
        }
        
		public function getRol(){
			return $this->rol;
        }

		public function getFotoUsu(){
			return $this->fotoUsu;
        }

		public function getEstadoUsu(){
			return $this->estadoUsu;
        }
        public function getUdate_at(){
			return $this->update_at;
		}

		
		public function consultar($datos = array()) {
			
			$documento = $datos['documento'];
			$password = $datos['clave'];
			
            $this->query = "
            SELECT IDusuario, nombreUsu, documentoUsu, emailUsu, clave, rol, fotoUsu, estadoUsu
			FROM usuario 
			WHERE documentoUsu = '$documento'
			";

            $this->obtener_resultados_query();
			
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		public function lista() {
			$this->query = "
			SELECT IDusuario, nombreUsu, documentoUsu, emailUsu, clave, rol, fotoUsu, estadoUsu
			FROM usuario order by IDusuario
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}
        
        public function generarPassword($pass=""){
            $opciones = [
                'cost' => 12,
            ];
            
            $passwordHashed = password_hash($pass, PASSWORD_BCRYPT, $opciones);
            
            return $passwordHashed;
        }

		public function nuevo($datos=array()) {
			if(array_key_exists('IDusuario', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
                endforeach;
              
				$this->query = "
					INSERT INTO usuario
					(IDusuario, nombreUsu, documentoUsu, emailUsu, clave, rol, fotoUsu, estadoUsu update_at)
					VALUES
					(NULL, '$nombreUsu', '$documentoUsu', '$emailUsu', '$clave', '$rol', '$fotoUsu', '$estadoUsu',NOW())
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
		
		public function borrar($comu_codi='') {
			$this->query = "
			DELETE FROM usuario
			WHERE IDusuario = '$IDusuario'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>