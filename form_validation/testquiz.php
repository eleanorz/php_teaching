<?php 
	session_start();
?>

<html>
<?php 
	if (isset($_SESSION['error']) )
	{
		foreach ($_SESSION['error'] as $name => $message)
		{
			?>
			<p><?= $message ?></p>
			<?php
		}
	}

 ?>
	Please answer the following questions:
	<form action="process_quiz.php" method = "post">
		<input type="hidden" name="action" value="quiz">

		
		<p>What is my favorite color?</p>
		<input type="text" name="color">
		
		<?php 
			if (isset($_SESSION['q1']) ) {
				echo "<h1>".$_SESSION['q1']."  </h1>";
			}
		 ?>

		<p>Will the Seahawks win the superbowl?</p>
		<input type="text" name="yes_or_no">

		<?php 
			if (isset($_SESSION['q2']) ) {
				echo "<h1>".$_SESSION['q2']."  </h1>";
			}

			if (!empty($_SESSION))
			{
				echo "<input type='submit' value='try again!'>";
			}
			else
			{
				echo "<input type='submit' value='answer!'>";	
			}
		 ?>

	</form>

</html>

<?php 
	$_SESSION = array();
 ?>