<?php 
	require_once("Configuracao.php");

	//$usuario = new Usuario();
	//$usuario -> carregandoUsuario(4);	
	//echo $usuario;

	//$lista = Usuario::carregandoUsuarios();
	//echo json_encode($lista);

	//$buscar = Usuario::buscarUsuario("cs");
	//echo json_encode($buscar);

	//$usuario = new Usuario();
	//$usuario -> autenticaUsuario("RogerioCS", "cs123456");
	//echo $usuario;

	//$usuario = new Usuario("MarceloCS",  "cs123456");	
	//$usuario -> inserindoDados();
	//echo $usuario;

	$usuario = new Usuario();
	$usuario -> carregandoUsuario(5);
	$usuario -> atualizarInformacoes("FernandoSC", "cs123456");

	echo $usuario;
 ?>