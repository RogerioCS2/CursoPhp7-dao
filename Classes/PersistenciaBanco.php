<?php 	
	class PersistenciaBanco extends PDO
	{		
		private $conexao;

		public function __construct(){			
			$this -> conexao = new PDO("mysql:dbname=dbphp7;host=localhost", "root", "");
		}
		
		private function receberParametrosSql($comando, $chave, $valor){
			$comando -> bindParam($chave, $valor);
		}

		private function percorrerParametrosSql($comando, $parametros = array()){
			foreach ($parametros as $chave => $valor) {				
				$this -> receberParametrosSql($comando, $chave, $valor); 
			}
		}		
		
		public function comandosSql($comandoSql, $parametros = array()):array{
			$comando = $this -> executarComandoSql($comandoSql, $parametros); 
			return $comando -> fetchall(PDO::FETCH_ASSOC);
		}

		public function executarComandoSql ($comandoSql, $parametros = array()){			
			$comando = $this -> conexao -> prepare($comandoSql);	
			$this -> percorrerParametrosSql($comando, $parametros);
			$comando -> execute();
			return $comando;		
		}					
	}
 ?>