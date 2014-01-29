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

	<div id = "logout">
		<form action="process.php" method = "post">
			<input type="hidden" name="action" value="logout">
			<input type="submit" value="log out of FaceSpace">
		</form>
	</div>

 	<?php 

 		if (isset($_SESSION['function']) && $_SESSION['function'] == 'registering')
 		{
 			echo "<h1> congratulations, you are now registered!</h1>";
 		}
 		else
 		{
 			echo "<h1> Welcome back !</h1>" ;
 		}

 		?>

 		<form action="process.php" method="post">
 			<input type="hidden" name="action" value="new_msg">
 			<input type="text" name="comment">
 			<input type="submit" value="update status">
 		</form>

 		<?php

 		$query1 = "SELECT * FROM messages LEFT JOIN users on messages.idusers=users.iduser order by messages.idmessage DESC";
 		$messages = fetch_all($query1);

 		foreach ($messages as $key => $message)
 		{
 			display_message($message);
 		}

 		function display_message($message)
 		{
 			?><div class='message'><?php
 			foreach ($message as $key => $value) 
 			{
	 			switch ($key)
	 			{
	 				case 'created_at':
	 					echo "on ";
	 					fancy_date($value);
	 					echo ", ";
	 					break;
	 				case 'first_name':
	 					echo " ".$value." ";
	 					break;
	 				case 'last_name':
	 					echo $value." said: ";
	 					break;
	 				case 'message':
	 					echo "<h3>".$value."</h3>";
	 					break;
	 				
	 				case 'idmessage':
	 					echo $value;
 						delete_msg_button($value);
	 					break;
	 			}
 			}
			?></div><?php

			display_comments($message);
 		}

 		function fancy_date($date)
 		{	
 			$old_date = strtotime($date);
 			$today = date("F d");
 			echo $today;
 			$clean_date = date($old_date);
 			$formatted_date = date("F d", $clean_date);

 			//if today, only show time
 			if ($formatted_date == $today)
 			{
 				echo "today";
 			}
 			
 			//if older than today, only display day of week and hour
 			else
 			{
 				echo "<br>".$formatted_date;
 			}

 			//if older than a week, only display month/day
 		}

 		function display_comments($message)
 		{
 			$query = "SELECT * FROM comments WHERE message_id =".$message['idmessage'];
 			$comments = fetch_all($query);

 			?><div class='comment'><?php
 				foreach ($comments as $key => $comment)
 				{
 					display_one_comment($comment);
 				}
 			?></div><?php
 		}

 		function display_one_comment($comment)
 		{
			echo "<p>";
 			foreach ($comment as $key => $value)
 			{
	 			switch ($key) {
	 				case 'comment':
	 					echo $value;
	 					break;	 				
	 				case 'created_at':
	 					echo $value;
	 					break;
	 				case 'user_id':
	 					echo "  user id is: ".$value;
	 					break;
	 				case 'idcomment':
	 					delete_comment_button($value);
	 			}
 			}
			echo "</p>";
 		}

 		function delete_msg_button($id)
 		{
 		?>
 			<form action="process.php" method="post">
 				<input type="hidden" name="action" value="delete_msg">
 				<input type="hidden" name="id" value="
 				<?php echo $id; ?>
 				">
 				<input type="submit" value="delete">
 			</form>
 		<?php
 		}

 		function delete_comment_button($id)
 		{
 		?>
 			<form action="process.php" method="post">
 				<input type="hidden" name="action" value="delete_comment">
 				<input type="hidden" name="id" value="
 				<?php echo $id; ?>
 				">
 				<input type="submit" value="delete">
 			</form>
 		<?php
 		}
 	 ?>




 
 
 </body>
 </html>