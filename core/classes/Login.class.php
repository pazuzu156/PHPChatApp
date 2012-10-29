<?php

class Login extends Core {
	private $user_id, $password, $passhash;
	public $log, $username, $errors;
	
	public function __construct() {
		parent::__construct();
		
		$this->log = (isset($_POST['login'])) ? 1 : 0;
		$this->username = ($this->log) ? $_POST['username'] : '';
		$this->password = ($this->log) ? $_POST['password'] : '';
		$this->user_id = ($this->log) ? $this->fetch_user_id() : '';
		$this->passhash = ($this->log) ? $this->hash_password() : '';
		$this->errors = array();
	}
	
	public function valid_form() {
		try {
			if(empty($this->username))
				throw new Exception("Please type in your username!");
			if(empty($this->password))
				throw new Exception("Please type in your password!");
			if(!$this->check_up_combo())
				throw new Exception("Invalid username/password combination!");
			
			$this->login();
			return true;
		} catch(Exception $e) {
			$this->errors[] = $e->getMessage();
		}
	}
	
	private function check_up_combo() {
		$this->query("
			SELECT		`username`,
						`password`
			FROM		`users`
			WHERE		`username` = '" . $this->db->real_escape_string($this->username) . "'
			AND			`password` = '" . $this->db->real_escape_string($this->passhash) . "'
		");
		if($this->row_count() > 0)
			return true;
	}
	
	private function fetch_user_id() {
		$this->query("
			SELECT	`user_id`
			FROM	`users`
			WHERE	`username` = '" . $this->db->real_escape_string($this->username) . "'
		");
		$user_info = $this->rows();
		$user_id = $user_info[0]['user_id'];
		return $user_id;
	}
	
	public function login() {
		$_SESSION['login'] = true;
		$_SESSION['user'] = $this->user_id;
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