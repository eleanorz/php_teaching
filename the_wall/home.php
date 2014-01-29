<?php 
	session_start();
	require_once('connection.php');
	var_dump($_SESSION);
 ?>

<html>
 <head>
 	<title>you made it!!</title>
 	<link rel="stylesheet" href="main.css">
 </head>
 <body>

 	<?php 
 		if ($_SESSION['function'] == 'registering')
 		{
 			echo "<h1> congratulations, you are now registered!</h1>";
 		}
 		else
 		{
 			echo "<h1> Welcome back !</h1>" ;
 		}

 		echo "HERE ARE THE MESSAGES:";

 		$query1 = 'SELECT * FROM messages';

 		$messages = fetch_all($query1);

 		foreach ($messages as $key => $message)
 		{
 			foreach ($message as $key => $value) {
	 			switch ($key) {
	 				case 'message':
	 					echo "<h3>".$value."</h3>";
	 					break;
	 				
	 				case 'idmessage':
	 					echo $value;
	 					break;
	 			}
 			}
 		}

 		echo "HERE ARE ALL COMMENTS:";

 		$query2 = 'SELECT * FROM comments';
 		$comments = fetch_all($query2);

 		foreach ($comments as $key => $comment)
 		{
 			var_dump($comment);
 		}
 	 ?>



 
 
 </body>
 </html>