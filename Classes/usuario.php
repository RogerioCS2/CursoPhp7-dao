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
	}	
 ?>