<?php 
	session_start();
	require_once('connection.php');

	$_SESSION['errors'] = array();

	if (isset($_POST['action']) and $_POST['action'] == 'register')
	{
		$_SESSION['function'] = 'registering';
		$_SESSION['current_email'] = $_POST['email'];
		$_SESSION['new_password'] = $_POST['password'];
		$_SESSION['confirm_password'] = $_POST['confirm'];
		$email = $_SESSION['current_email'];
		$password = $_SESSION['new_password'];
		$confirm = $_SESSION['confirm_password'];

		//IS THE PASSWORD BLANK?
		if (empty($password))
		{
			$error = 'Password is blank';
			array_push($_SESSION['errors'], $error);
		}
		
		//DOES USER ALREADY EXIST?
		$query4 = "SELECT email from users WHERE email='".$email."'";
		$redundant = fetch_record($query4);
		if (empty($redundant))
		{}
		else
		{
			$error = "Username already exists";
			array_push($_SESSION['errors'], $error);
		}

		//DO PASSWORDS MATCH?
		if ($confirm != $password)
		{
			$error = "the passwords do not match";
			array_push($_SESSION['errors'], $error);
		}

		// IS THERE AN AT SIGN?
		if (strpos($email,'@') == FALSE)
		{
			$error = "you do NOT have an at sign in your email";
			array_push($_SESSION['errors'], $error);
		}
		
		//IS THERE A PERIOD?
		if (strpos($email, '.') == FALSE)
		{
			$error = 'you do NOT have a period in your email address';
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
		$_SESSION['current_email'] = $_POST['email'];
		$_SESSION['password'] = $_POST['password'];
		$email = $_SESSION['current_email'];
		$password = $_SESSION['password'];

		$query = "SELECT * from users WHERE email = '".$email."' ";
		$user_record = fetch_record($query);
		
		//DOES USER EXIST?
		if (isset($user_record) )
		{			
			//IS THE PASSWORD CORRECT?
			if ($user_record['password'] == $password)
			{
				//PASSWORD GOOD
			}
			else
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
			header('Location: success.php');
		}
	}

	if (isset($_POST['action']) and $_POST['action'] == 'delete')
	{
		$email = $_SESSION['current_email'];

		$query = "DELETE FROM users WHERE email='".$email."'";

		echo $query;
		die();
	}

 ?>