<?php

class Register extends Core {
	private $user_id, $password, $cpass, $passhash;
	public $reg, $username, $errors;
	
	public function __construct() {
		parent::__construct();
		
		$this->reg = (isset($_POST['register'])) ? 1 : 0;
		$this->username = ($this->reg) ? $_POST['username'] : '';
		$this->password = ($this->reg) ? $_POST['password'] : '';
		$this->cpass = ($this->reg) ? $_POST['cpass'] : '';
		$this->user_id = ($this->reg) ? $this->create_user_id() : '';
		$this->passhash = ($this->reg) ? $this->hash_password() : '';
		$this->errors = array();
	}
	
	public function valid_form() {
		try {
			if(empty($this->username))
				throw new Exception("Please type in a username!");
			if(empty($this->password))
				throw new Exception("Please type in a password!");
			if(empty($this->cpass))
				throw new Exception("You must confirm your password!");
			if($this->cpass != $this->password)
				throw new Exception("Your passwords do not match!");
			if(!$this->check_username())
				throw new Exception("This username is already taken!");
			
			$this->register();
			return true;
		} catch(Exception $e) {
			$this->errors[] = $e->getMessage();
		}
	}
	
	public function check_username() {
		$username = $this->db->real_escape_string($this->username);
		$query = $this->query("SELECT `username` FROM `users` WHERE `username` = '{$username}'");
		if($this->row_count() == 0) {
			return true;
		}
	}
	
	private function create_user_id() {
		$u = base64_encode(strtolower($this->username) . $this->password);
		$uu = hash('sha256', $u);
		$uuu = str_shuffle($uu);
		$uuuu = substr($uuu, 0, 6);
		return $uuuu;
	}
	
	public function register() {
		$this->query("
			INSERT INTO `users` (`user_id`, `username`, `password`)
			VALUES (
				'" . $this->db->real_escape_string($this->user_id) . "',
				'" . $this->db->real_escape_string($this->username) . "',
				'" . $this->db->real_escape_string($this->passhash) . "'
			)
		");
	}
	
	private function hash_password() {
		$p = base64_encode(strtolower($this->username) . $this->password . $this->user_id);
		$pp = hash('sha256', $p);
		$ppp = base64_encode($pp . SPCODE);
		$pppp = hash('sha256', $ppp);
		return $pppp;
	}
	
	public function show_errors() {
		foreach($this->errors as $key => $value)
			return $value;
	}
}

?>