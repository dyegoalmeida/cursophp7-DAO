<?php

	require_once("config.php");

	//$date = new DateTime('2020-04-30 13:21:12');
	//echo $date->format('d/m/Y H:i:s');

	$login = new Usuario();
	$login->login("valter","0800963");

	echo $login;

	/*
	$busca = Usuario::search("dy");
	echo json_encode($busca);
    */

	/*
	$lista = Usuario::getList();
	echo json_encode($lista);
    */
	
	//Carrega um usuário
	/*
	$root = new Usuario();
	$root->loadbyID(4);
	echo $root;
	*/

	/*
	$sql = new Sql();
	$usuarios = $sql->select("SELECT * FROM tb_usuarios");
	echo json_encode($usuarios);
	*/

?>