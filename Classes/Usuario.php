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
				$this -> setarDados($resultado[0]);
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

		public function atualizarInformacoes($usuario, $senha){
			$this -> setDeslogin($usuario);
			$this -> setDessenha($senha);

			$sql = new PersistenciaBanco();
			$sql -> comandosSql("update tb_usuario set deslogin = :usuario, dessenha = :senha where idusuario = :id" ,array(
				':usuario' => $this -> getDeslogin(),
				':senha' => $this -> getDessenha(),
				':id' => $this -> getIdusuario()
			));				
		}

		public function autenticaUsuario($usuario, $senha){

			$sql = new PersistenciaBanco();

			$resultado = $sql -> comandosSql("select *from tb_usuario where deslogin = :usuario and dessenha = :senha",array(
				":usuario" => $usuario,
				":senha" => $senha
			));

			if(count($resultado) > 0){
				$this -> setarDados($resultado[0]);				
			}else{
				throw new Exception("Error ao informar usuario ou senha");				
			}
		}

		public function setarDados($dados){
			$this -> setIdusuario($dados['idusuario']);
			$this -> setDeslogin($dados['deslogin']);
			$this -> setDessenha($dados['dessenha']);
			$this -> setDtcadastro(new DateTime($dados['dtcadastro']));
		}

		public function excluirRegistro(){
			$sql = new PersistenciaBanco();

			$sql -> comandosSql("delete from tb_usuario where idusuario = :id" ,array(				
				':id' => $this -> getIdusuario()
			));	

			$this -> setIdusuario(0);
			$this -> setDeslogin("");
			$this -> setDessenha("");
			$this -> setDtcadastro(new DateTime());	
		}

		public function inserindoDados(){
			$sql = new PersistenciaBanco();

			$resultado = $sql -> comandosSql("CALL sp_usuaro_insert(:usuario, :senha)",array(
				":usuario" => $this -> getDeslogin(),
				":senha" => $this -> getDessenha()
			));

			if(count($resultado) > 0){
				$this -> setarDados($resultado[0]);
			}
		}

		public function __construct($usuario = "", $senha = ""){
			$this -> setDeslogin($usuario);
			$this -> setDessenha($senha);
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