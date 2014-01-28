<?php 
	session_start();

	$_SESSION = [];

	if (isset($_POST['action']) && $_POST['action'] == 'quiz')
	{
		//check if empty
		foreach ($_POST as $name => $value)
		{
			if (empty($value))
			{
				$_SESSION['error'][$name] = "Sorry, ".$name." cannot be blank";
			}
			else
			{
				switch ($name) {
					case 'color':
						if ( strtolower($value) != 'red')
						{
							$_SESSION['q1'] = 'it is actually red!';
						}								
					break;

					case 'yes_or_no':
						if ( strtolower($value) != 'yes')
						{
							$_SESSION['q2'] = 'Guess again!';
						}
					break;
				}
			}
		}		


		var_dump($_SESSION);
	}

	if (!empty($_SESSION))
	{
		header('Location: testquiz.php');
	}
	else
	{
		header('Location: success.php');
	}
 ?>