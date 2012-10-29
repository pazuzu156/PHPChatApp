<?php

if(isset($_SESSION['login']))
	header("Location: ./");
	
$response = "";

if(isset($_POST['register'])) {
	require 'core/init.php';
	$reg = new Register();
	if(!$reg->valid_form())
		$response = "<span class='error'>" . $reg->show_errors() . "</span>";
	else
		$response = "<span class='success'>You have successfully registered! Press the home link to login!</span>";
}

?>
<?php echo $response; ?>
<form method="post" action="register" autocomplete="off">
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
			<td><label for="cpass">Confirm Password:</label></td>
			<td><input type="password" name="cpass" id="cpass"></td>
		</tr>
		<tr>
			<td><input type="submit" name="register" value="Register"></td>
			<td><a href="./">Home</a></td>
		</tr>
	</table>
</form>