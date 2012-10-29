<?php

require 'init.php';

if(isset($_POST['method']) && !empty($_POST['method'])) {
	$chat = new Chat();
	$method = trim($_POST['method']);
	
	if($method == "fetch") {
		$messages = $chat->fetch_messages();
		
		if(empty($messages)) {
			echo "<em>There are no messages to display. Say something? :D</em>";
		} else {
			foreach($messages as $message) {
				?>
				
				<div class="message">
					<p>
						<a href="#"><?php echo $message['username']; ?></a>:
						<?php echo nl2br($message['message']); ?>
					</p>
				</div>
				
				<?php
			}
		}
	} elseif($method == "throw") {
		$message = trim($_POST['message']);
		if(!empty($message)) {
			$chat->throw_message($_SESSION['user'], $message);
		}
	}
}

?>