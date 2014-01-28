<?php 
	session_start();
	require_once('connection.php');

	$_SESSION['errors'] = array();

	if (isset($_POST['action']) and $_POST['action'] == 'register')
	{
		//adjusts greeting on success page
		$_SESSION['function'] = 'registering'; 

		//checks whether any of the fields are empty
		foreach ($_POST as $name => $value)
		{
			if (empty($value))
			{
				$_SESSION['errors'][$name] = "Sorry, ".$name." cannot be blank";
			}
			else
			{
				switch ($name)
				{
					case 'email':
						if (!filter_var($value, FILTER_VALIDATE_EMAIL))
						{
							$_SESSION['errors'][$name] = $name." is not a valid email";
						}
					break;
					case 'password':
						if ($value != ($_POST['confirm']) )
						{
							$_SESSION['errors'][$name] = "passwords do not match";
						}
						if (strlen($value) < 6)
						{
							array_push($_SESSION['errors'], "password isn't long enough");
						}
					break;
					case 
				}
			}
		}

		
		//DOES USER ALREADY EXIST?
		$query4 = "SELECT email from users WHERE email='".$_POST['email']."'";
		$redundant = fetch_record($query4);
		if (!empty($redundant))
		{
			$error = "Username already exists";
			array_push($_SESSION['errors'], $error);
		}



		//FORMAT IS CLEAN:
		if (empty($_SESSION['errors']))
		{
			$query2 = "SELECT email FROM users WHERE email='".$email."' ";

			$result = fetch_record($query2);
			
			//email IS NEW
			if (empty($result) )
			{
				$query3 = "INSERT into users (email, password, created_at) VALUES ('".$email."', 'password', NOW())";
				run_mysql_query($query3);
				echo "new email added";
			}
			else
			{
				echo "user already exists";
			}
		
			echo "<h1>I am inside the success loop </h1>";
			echo $query3;
			header('Location: success.php');
		}

		else  //SEND BACK TO INDEX-FORMAT NOT CLEAN
		{
			header('Location: index.php');
		}
	}

	if (isset($_POST['action']) and $_POST['action'] == 'login')
	{
		//GRAB POST Variables
		$_SESSION['function'] = 'login';

		$password = $_POST['email'];
		$email = $_POST['email'];

		$query = "SELECT * from users WHERE email = '".$email."' ";
		$user_record = fetch_record($query);
		
		//DOES USER EXIST?
		if (isset($user_record) )
		{			
			//IS THE PASSWORD CORRECT?
			if ($user_record['password'] != $password)
			{
				$error = "Password isn't valid, please re-enter";
				array_push($errors, $error);
			}
		}
		else
		{
			$error = "This user doesn't exist, please register above";
			array_push($errors, $error);
		}

		if (isset($errors) )
		{
			header('Location: index.php');
		}
		else
		{
			header('Location: home.php');
		}
	}

 ?>