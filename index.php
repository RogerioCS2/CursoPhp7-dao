<?php 
	require_once("Configuracao.php");

	//$usuario = new Usuario();
	//$usuario -> carregandoUsuario(4);	
	//echo $usuario;

	//$lista = Usuario::carregandoUsuarios();
	//echo json_encode($lista);

	//$buscar = Usuario::buscarUsuario("cs");
	//echo json_encode($buscar);

	$usuario = new Usuario();
	$usuario -> autenticaUsuario("RogerioCS", "cs123456");
	echo $usuario;
 ?>