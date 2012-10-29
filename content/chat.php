<?php
if(!isset($_SESSION['login']))
	header("Location: ./");
?>
<div class="chat">
	<div class="messages"></div>
	<textarea class="entry" placeholder="Enter to send. Shift+Enter for new line."></textarea>
</div>
<a href="logout">Logout</a>