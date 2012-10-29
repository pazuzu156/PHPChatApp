<?php

class Chat extends Core {
	
	public function fetch_messages() {
		$this->query("
			SELECT		`chat`.`message`,
						`users`.`username`,
						`users`.`user_id`
			FROM		`chat`
			JOIN		`users`
			ON			`chat`.`user_id` = `users`.`user_id`
			ORDER BY	`chat`.`timestamp`
			DESC
		");
		
		return $this->rows();
	}
	
	public function throw_message($user_id, $message) {
		$this->query("
			INSERT INTO `chat` (`user_id`, `message`, `timestamp`)
			VALUES (
				'" . $this->db->real_escape_string($user_id) . "',
				'" . $this->db->real_escape_string($message) . "',
				UNIX_TIMESTAMP()
			)
		");
	}
	
}

?>