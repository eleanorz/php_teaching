<?php 
	session_start();
 ?>

<html>
<head>
	<title>Make Money!</title>
	<link rel="stylesheet" href="main.css">
</head>
<body>
	<div class = 'bldg'>		
		FARM!
		<form action="process.php" method = "post">
			<input type="hidden" name="action" value="farm">
			<input type="submit" value="find gold!">
		</form>
	</div>

	<div class = 'bldg'>
		CAVE!
		<form action="process.php" method = 'post'>
			<input type="hidden" name="action" value="cave">
			<input type="submit" value="find gold!">
		</form>
	</div>
	<div class = 'bldg'>
		HAUS!
		<form action="process.php" method = 'post'>
			<input type="hidden" name="action" value="house">
			<input type="submit" value="find gold!">
		</form>		
	</div>
	<div class = 'bldg'>
		CASINOOOO!
		<form action="process.php" method='post'>
			<input type="hidden" name="action" value="casino">
			<input type="submit" value="find gold!">
		</form>
	</div>

	<div class = 'bldg'>
		<form action="process.php" method='post'>
			<input type="hidden" name="action" value="clean">
			<input type="submit" value="Start all over!">
		</form>
	</div>

	<div id = 'results'>
		<?php 
			foreach ($_SESSION['activity'] as $key => $active)
			{
				echo $active ;
			}
		 ?>
	</div>


</body>
</html>