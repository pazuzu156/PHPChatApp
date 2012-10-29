<?php

if(isset($_SESSION['login']))
	header("Location: ./");

$response = "";
	
if(isset($_POST['login'])) {
	require 'core/init.php';
	$log = new Login();
	if(!$log->valid_form())
		$response = $log->show_errors();
	else
		header("Location: ./");
}

?>
<?php echo $response; ?>
<form method="post" action="login" autocomplete="off">
	<table>
		<tr>
			<td><label for="username">Username:</label></td>
			<td><input type="text" name="username" id="username"></td>
		</tr>
		<tr>
			<td><label for="password">Password:</label></td>
			<td><input type="password" name="password" id="password"></td>
		</tr>
		<tr>
			<td><input type="submit" name="login" value="Login"></td>
			<td>Not a member? <a href="register">Register</a>!</td>
		</tr>
	</table>
</form>