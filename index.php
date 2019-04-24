<?php 
	require_once("configuracao.php");

	$sql = new Sql();

	$usuarios = $sql -> comandosSql("select *from tb_usuario"); //CHAMANDO O MÉTODO SELECT DA CLASSE SQL

	echo json_encode($usuarios);
 ?>