<?php

	require_once("config.php");

    $usuario = new Usuario();
    $usuario->loadbyID(15);
    $usuario->update("professor","123456789");
	echo $usuario;
    
    /*
    $aluno = new Usuario("aluno653","98!lun0");
    $aluno->insert();
    echo $aluno;
    */
    /*
	$login = new Usuario();
	$login->login("valter","0800963");

	echo $login;
    */
	/*
	$busca = Usuario::search("alun");
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