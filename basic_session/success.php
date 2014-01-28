<?php 
	session_start();
 ?>

<html>
 <head>
 	<title>you made it!!</title>
 </head>
 <body>

 	<?php 
 		if ($_SESSION['function'] == 'registering')
 		{
 			echo "<h1> congratulations! ".$_SESSION['current_email']." , you are now registered!</h1>";
 		}
 		else
 		{
 			echo "<h1> Welcome back ".$_SESSION['current_email']." !</h1>" ;
 		}
 	 ?>

 	 Delete this account?
 	 <form action="process.php" method = 'POST'>
 	 	<input type="hidden" name = 'action' value = 'delete'>
 	 	<input type="submit" value = 'please remove my account!'>
 	 </form>

 
 </body>
 </html>