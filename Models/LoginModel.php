<?php
	class LoginModel extends Mysql{

		public $intIdUser;
		public $strUser;
		public $strPassword;
		public $strToken;

		public function __construct(){
			parent::__construct();
		}

		public function loginUser(string $user, string $password){
			$this->strUser = $user;
			$this->strPassword = $password;
			$sql = "SELECT idpersona, status FROM persona 
			WHERE status != 0 AND email_user = '$this->strUser' AND password = '$this->strPassword' 
			OR status != 0 AND telefono = '$this->strUser' AND password = '$this->strPassword'";
			$request = $this->select($sql);
			return $request;
		}

		public function sessionLogin(int $iduser){
			$this->intIdUser = $iduser;
			//Buscar Rol
			$sql = "SELECT p.idpersona,
							p.identificacion,
							p.nombres,
							p.apellidos,
							p.cuentas,
							p.telefono,
							p.email_user,
							p.nit,
							p.nombrefiscal,
							p.direccionfiscal,
							r.idrol,
							r.nombrerol,
							p.status
					FROM persona p
					INNER JOIN rol r
					ON p.rolid = r.idrol
					WHERE p.idpersona = $this->intIdUser";
			$request = $this->select($sql);
			$_SESSION['userData'] = $request;
			return $request;
		}

		public function getUserEmail(string $email){
			$this->strUser = $email;
			$sql = "SELECT idpersona,nombres,apellidos,status FROM persona WHERE email_user = '$this->strUser' and status = 1";
			$request = $this->select($sql);
			return $request;
		}

		public function setTokenUser(int $idpersona, string $token){
			$this->intIdUser = $idpersona;
			$this->strToken = $token;
			$sql = "UPDATE persona SET token = ? WHERE idpersona = $this->intIdUser";
			$arrData = array($this->strToken);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function getUsuario(string $email, string $token){
			$this->strUser = $email;
			$this->strToken = $token;
			$sql = "SELECT idpersona FROM persona WHERE email_user = '$this->strUser' and token = '$this->strToken' and status = 1";
			$request = $this->select($sql);
			return $request;
		}

		public function insertPassword(int $idpersona, string $password){
			$this->intIdUser = $idpersona;
			$this->strPassword = $password;
			$sql = "UPDATE persona SET password = ?, token = ? WHERE idpersona = $this->intIdUser";
			$arrData = array($this->strPassword,"");
			$request = $this->update($sql,$arrData);
			return $request;
		}
		
	}
?>