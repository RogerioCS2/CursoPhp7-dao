<?php 
	class Usuario{
		private $idusuario; 
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

		public function getIdusuario(){
			return $this -> idusuario;
		}
		public function setIdusuario($valor){
			$this -> idusuario = $valor;
		}

		public function getDeslogin(){
			return $this -> deslogin;
		}
		public function setDeslogin($valor){
			$this -> deslogin = $valor;
		}

		public function getDessenha(){
			return $this -> dessenha;
		}
		public function setDessenha($valor){
			$this -> dessenha = $valor;
		}

		public function getDtadastro(){
			return $this -> dtcadastro;
		}
		public function setDtcadastro($valor){
			$this -> dtcadastro = $valor;
		}

		public function carregandoUsuario($id){
			$sql = new PersistenciaBanco();

			$resultado = $sql -> comandosSql("select *from tb_usuario where idusuario = :id" ,array(
				":id" => $id
			));

			if(count($resultado) > 0){
				$linha = $resultado[0];

				$this -> setIdusuario($linha['idusuario']);
				$this -> setDeslogin($linha['deslogin']);
				$this -> setDessenha($linha['dessenha']);
				$this -> setDtcadastro(new DateTime($linha['dtcadastro']));
			}
		}

		public static function carregandoUsuarios(){
			$sql = new PersistenciaBanco();
			return $sql -> comandosSql("select *from tb_usuario order by deslogin;");				
		}

		public static function buscarUsuario($deslogin){
			$sql = new PersistenciaBanco();
			return $sql -> comandosSql("select *from tb_usuario where deslogin like :buscar order by deslogin;" ,array(
				':buscar' => "%".$deslogin."%"
			));				
		}

		public function autenticaUsuario($usuario, $senha){
							
			$sql = new PersistenciaBanco();

			$resultado = $sql -> comandosSql("select *from tb_usuario where deslogin = :usuario and dessenha = :senha",array(
				":usuario" => $usuario,
				":senha" => $senha
			));

			if(count($resultado) > 0){
				$linha = $resultado[0];

				$this -> setIdusuario($linha['idusuario']);
				$this -> setDeslogin($linha['deslogin']);
				$this -> setDessenha($linha['dessenha']);
				$this -> setDtcadastro(new DateTime($linha['dtcadastro']));
			}else{
				throw new Exception("Error ao informar usuario ou senha");				
			}
		}

		public function __toString(){
			return json_encode(array(
				"idusuario" => $this -> getIdusuario(),
				"deslogin" => $this -> getDeslogin(),
				"dessenha" => $this -> getDessenha(),
				"dtcadastro" => $this -> getDtadastro() -> format("d-m-Y H:i:s")
			));
		}
	}	
 ?>