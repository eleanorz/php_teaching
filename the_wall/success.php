<?php 
	session_start();
 ?>

<html>
 <head>
 	<title>you made it!!</title>
 </head>
 <body>

 	<?php 
 		if ($_POST['function'] == 'registering')
 		{
 			echo "<h1> congratulations, you are now registered!</h1>";
 		}
 		else
 		{
 			echo "<h1> Welcome back !</h1>" ;
 		}
 	 ?>

 
 
 </body>
 </html>