<?php
	session_start();
	require_once('connection.php');
 ?>

<html>
<head>
	<title>login/registration</title>
	<link rel="stylesheet" href="main.css">
</head>
<body>

	<?php 

		if (isset($_SESSION['errors']) )
		{
			var_dump( $_SESSION['errors']);
		}
	?>

	<h2>register!</h2>
	<form action="process.php" method = "POST">
		<input type="hidden" name = 'action' value = 'register'>
		enter first name: <input type="text" name="first">
		enter last name: <input type="text" name="last">
		enter email: <input type="text" name = "email">
		enter new password: <input type='password' name = 'password'>
		confirm: <input type="password" name = 'confirm'>
		<input type="submit" value = 'register me!'>
	</form>

	<h2>login!</h2>
	<form action="process.php" method = "POST">
		<input type="hidden" name = 'action' value = 'login'>
		email: <input type="text" name="email">
		password: <input type="password" name="password">
		<input type="submit" value = 'Login'>
	</form>

</body>
</html>

<?php 
$_SESSION = array();
 ?>