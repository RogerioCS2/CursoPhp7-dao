<?php 	
	class Sql extends PDO
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
				$this -> receberParametrosSql($chave, $valor); //USANDO O METODO receberParametrosSql		
			}
		}
		
		public function atribuindoValoresSql ($comandoSql, $parametros = array()){			
			$comando = $this -> conexao -> prepare($comandoSql);	
			$this -> percorrerParametrosSql($comando, $parametros);//USANDO O METODO percorrerParametrosSql
			$comando -> execute();
			return $comando;		
		}			
		
		public function comandosSql($comandoSql, $parametros = array()):array{
			$comando = $this -> atribuindoValoresSql($comandoSql, $parametros); //USANDO O METODO comandosSql
			return $comando -> fetchall(PDO::FETCH_ASSOC);
		}		
	}
 ?>