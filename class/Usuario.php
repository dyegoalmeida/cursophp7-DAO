<?php

class Usuario{

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario(){
		return $this->idusuario;
	}

	public function setIdusuario($value){
		$this->idusuario = $value;
	}

	public function getDeslogin(){
		return $this->deslogin;
	}

	public function setDeslogin($value){
		$this->deslogin = $value;
	}

	public function getDessenha(){
		return $this->dessenha;
	}

	public function setDessenha($value){
		$this->dessenha = $value;
	}

	public function getDtcadastro(){
		return $this->dtcadastro;
	}

	public function setDtcadastro($value){
		$this->dtcadastro = $value;
	}

	public function loadById($id){

		$sql = new SQL();

		$result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", 
			             array( "ID"=>$id));

		if (count($result) > 0){

			$row = $result[0];

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}
	}

	/*
		Como não utilizamos o $this, esse método fica STATIC, na prática a vantagem é que
		não precisamos instanciar o objeto para chamá-lo, apenas usar o USUARIO::NOMEMETODO
	*/
	public static function getList(){

		$sql = new SQL();

		return $sql->select("SELECT * FROM TB_USUARIOS ORDER BY DESLOGIN");
	}

	public static function search($login){

		$sql = new SQL();

		return $sql->select("SELECT * FROM TB_USUARIOS WHERE DESLOGIN LIKE :SEARCH ORDER BY IDUSUARIO", Array("SEARCH"=>"%".$login."%"));
	}

	public function login($login, $password){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM TB_USUARIOS WHERE DESLOGIN = :LOGIN AND DESSENHA = :PASSWORD", array(":LOGIN"=>$login,
										 ":PASSWORD"=>$password));
		if (count($results) > 0) {

			$row = $results[0];

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));

		} else {

			throw new Exception("Login e/ou Senha inválidos!Verifique!");
		}
	}

	public function __toString(){
        
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}
}

?>