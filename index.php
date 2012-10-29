<?php

@session_start();

$page = "";

if(isset($_GET['url'])) {
	$url = $_GET['url'];
	$page = $url;
} else {
	if(isset($_SESSION['login'])) {
		if(isset($_GET['url'])) {
			$page = $_GET['url'];
		} else {
			$page = "chat";
		}
	} else {
		$page = "login";
	}
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>PHP/AJAX Chat App</title>
		<link rel="stylesheet" type="text/css" href="assets/chat.css">
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	</head>
	<body>
		<div id="wrapper">
			
			<?php
			
			$file = "content/{$page}.php";
			
			if(!file_exists($file)) {
				$error = "<h1>Error 404: Not Found!</h1>";
				$error .= "<p>The page you are looking for \"{$page}\" doesn't seem to exist or cannot be found!</p>";
				die($error);
			} else {
				echo "<div id=\"header\"><h1>PHP/AJAX Chat App</h1></div>";
				require $file;
			}
			
			?>
		</div>
		<script type="text/javascript" src="assets/chat.js"></script>
	</body>
</html>