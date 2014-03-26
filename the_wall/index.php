<?php
	session_start();
	require_once('connection.php');
 ?>

<html>
<head>
	<!-- This page is would be the splash page which either blocks user or allows them to pass to the home.php -->
	<title>FaceSpace Login</title>
	<link rel="stylesheet" href="main.css">
</head>
<body>

	<?php
		if (isset($_SESSION['errors']) )
		{
			foreach ($_SESSION['errors'] as $key => $value)
			{
				echo $value."<br>"; //tell the user what is wrong with the form
			}
		}
	?>

	<h2>register!</h2>
	<div class="index">		<!-- Registration form -->
		<form action="process.php" method = "POST">
			<input type="hidden" name = 'action' value = 'register'>
			enter first name: <input type="text" name="first"> <br>
			enter last name: <input type="text" name="last"> <br>
			enter email: <br> <input type="text" name = "email"> <br>
			enter new password: <br> <input type='password' name = 'password'> <br>
			confirm: <br><input type="password" name = 'confirm'> <br>
			<input type="submit" value = 'register me!'>
		</form>
	</div>

	<h2>login!</h2>
	<div class="index">   <!-- login form -->
		<form action="process.php" method = "POST">
			<input type="hidden" name = 'action' value = 'login'>
			email: <br><input type="text" name="email"> <br>
			password: <br><input type="password" name="password"> <br>
			<input type="submit" value = 'Login'>
		</form>		
	</div>
</body>
</html>

<?php 
$_SESSION = array();
 ?>