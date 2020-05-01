<?php

class Usuario{

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	
	/*
	  Colocando aspas nos parametros do construtor, ele pode receber vazio caso não
	  sejam preenchidos, pois não é em todo o caso que tu precisa colocar os parametros ao criar o objeto.	
    */
	public function __construct($login = "", $password = ""){

		$this->setDeslogin($login);
		$this->setDessenha($password);

	}

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

			$this->setData($result[0]);

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

			$this->setData($results[0]);

		} else {

			throw new Exception("Login e/ou Senha inválidos!Verifique!");
		}
	}

	public function setData($data){
		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime($data['dtcadastro']));
	}

	public function insert(){

		$sql = new Sql();
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)",array(
			'LOGIN'=>$this->getDeslogin(),
			'PASSWORD'=>$this->getDessenha()
	        ));

		if (count($results) > 0){
			$this->setData($results[0]);	
		}
	}

	public function update($login, $password){

		$this->setDeslogin($login);
		$this->setDessenha($password);

		$sql = new Sql();
		$sql->query("UPDATE TB_USUARIOS SET DESLOGIN = :LOGIN, DESSENHA = :PASSWORD           		   WHERE IDUSUARIO = :ID", array(
			         'LOGIN'=>$this->getDeslogin(),
			         'PASSWORD'=>$this->getDessenha(),
			         'ID'=>$this->getIdusuario()
		));
	}

	public function delete(){

		$sql = new Sql();

		$sql->query("DELETE FROM TB_USUARIOS WHERE IDUSUARIO = :ID", array(
			'ID'=>$this->getIdusuario()
		));
		/*
		  Como apagamos o registro, ele não existindo mais vamos zerar o objeto, passando vazios para os sets(); 
		*/
		$this->setIdusuario(0);
		$this->setDeslogin("");
		$this->setDessenha("");
		$this->setDtcadastro(new DateTime());  
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