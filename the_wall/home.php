<?php 
	session_start();
	require_once('connection.php');
 ?>

<html>
 <head>
 	<!-- This would be the main page only accessible to the user after going through index.php for login -->
 	<title>FaceSpace</title>
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
 			echo "<h1> Congratulations, ".ucfirst($_SESSION['first']).", you are now registered!</h1>";
 		}
 		else
 		{
 			echo "<h1> Welcome back, ".$_SESSION['first']."</h1>";
 		}

 		if (isset($_SESSION['user_id']))
 		{
 			?> 
		 		<form action="process.php" method="post">
		 			<input type="hidden" name="id" value=<?php echo "'".$_SESSION['user_id']."'"; ?> >
		 			<input type="hidden" name="action" value="new_msg">
		 			<input type="textarea" name="message">
		 			<input type="submit" value="update status">
		 		</form> 			
 			<?php
 		}

 		$query1 = "SELECT * FROM messages LEFT JOIN users on messages.idusers=users.iduser order by messages.idmessage DESC";
 		$messages = fetch_all($query1);

 		foreach ($messages as $key => $message)
 		{
 			display_message($message);
 		}

 		function display_message($message)
 		{
 			?><div class='message'><?php
 			echo fancy_date($message['created_at'])." ".$message['first_name']." ".$message['last_name']." said: <br>".$message['message']."<br>";
			
			//only let the author delete
			if ($message['iduser'] == $_SESSION['user_id'])
			{
 				delete_msg_button($message['idmessage']);
			}

			//put the reply button inside the message div
 			reply($_SESSION['user_id'], $message['idmessage']);

 			?></div><?php

			display_comments($message);
 		}

 		function fancy_date($date) //prints out a formatted version of a date var
 		{	
 			$old_date = strtotime($date);
 			$today = date("F d");
 			$clean_date = date($old_date);
 			$formatted_date = date("F d", $clean_date);

 			//if today, only show time
 			if ($formatted_date == $today)
 			{
 				echo "today";
 			}
 			
 			//if older than today, show month/day
 			else
 			{
 				echo $formatted_date;
 			}
 		}

 		function display_comments($message) //iterates through the comments table for a given message and prints thm out
 		{
 			$query = "SELECT * FROM comments LEFT JOIN users on comments.user_id=users.iduser WHERE message_id =".$message['idmessage'];
 			
 			$comments = fetch_all($query);

 			?><div class='comment'><?php
 				foreach ($comments as $key => $comment)
 				{
 					display_one_comment($comment);
 				}
 			?></div><?php
 		}

 		function display_one_comment($comment) //formatting for one specicic comment
 		{
 			echo "<p>".$comment['updated_at']." ".$comment['first_name']." ".$comment['last_name']." said: <br>".$comment['comment'];

 			//only adds the delete button if the current user == author
 			if ($_SESSION['user_id'] == $comment['iduser'])
 			{
	 			delete_comment_button($comment['idcomment']);
 			}
			echo "</p>";
 		}

 		//adding a new comment
 		function reply($user_id, $message_id)
 		{
 			?> 
				<form action="process.php" method="post">
					<input type="hidden" name="action" value="reply">
					<input type="hidden" name="message_id" value=<?php echo "'".$message_id."'";?> >
					<input type="hidden" name="user_id" value=<?php echo "'".$user_id."'"; ?> >
					<input type="text area" name="comment">
					<input type="submit" value="reply">
				</form>
 			<?php
 		}

 		function delete_msg_button($id)
 		{
 		?>
 			<form action="process.php" method="post">
 				<input type="hidden" name="action" value="delete_msg">
 				<input type="hidden" name="id" value=<?php echo "'".$id."'"; ?> >
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