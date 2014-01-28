<?php 
	session_start();
 ?>

<html>
<head>
	<meta charset="UTF-8">	
	<title>Validation</title>
</head>
<body>
	<?php 
	if (isset($_SESSION['error']))
	{
		foreach ($_SESSION['error'] as $name => $message) 
		{
			?>
			<p><?=$message ?></p>
			<?php
		}
	}
	elseif(isset($_SESSION['success_message']))
	{
		?>
		<p><?=$_SESSION['success_message'] ?></p>
		<?php
	}
	 ?>
	<form action="process.php" method="post">
		<input type="hidden" name="action" value="register">
		<input type="text" name="first_name" placeholder="Enter First Name">
		<input type="text" name="last_name" placeholder="Enter Last Name">
		<input type="text" name="email" placeholder="enter email">
		<input type="password" name="password" placeholder="password">
		<input type="text" name="birthdate" placeholder="enter bday mm/dd/yyyy">
		<input type="submit" value="register">
	</form>

</body>
</html>

<?php 
$_SESSION = array();
 ?>