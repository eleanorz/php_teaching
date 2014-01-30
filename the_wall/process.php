<?php 
	session_start();
	require_once('connection.php');

	$_SESSION['errors'] = array();

	if (isset($_POST['action']) and $_POST['action'] == 'register')
	{
		register_user();
	}

	if (isset($_POST['action']) and $_POST['action'] == 'login')
	{
		login_user();
	}

	if (isset($_POST['action']) and $_POST['action'] == 'logout')
	{
		logout_user();
	}

	if (isset($_POST['action']) and $_POST['action'] == 'new_msg')
	{
		new_msg();
		header("Location: home.php");
	}

	if (isset($_POST['action']) and $_POST['action'] == 'reply')
	{
		reply();
		header("Location: home.php");
		die();
	}

	if (isset($_POST['action']) and $_POST['action'] == 'delete_msg')
	{
		delete_msg($_POST['id']);
		header("Location: home.php");
		die();
	}

	if (isset($_POST['action']) and $_POST['action'] == 'delete_comment')
	{
		delete_comment($_POST['id']);
		header("Location: home.php");
		die();
	}

	function register_user()
	{
		//adjusts greeting on success page
		$_SESSION['function'] = 'registering'; 

		foreach ($_POST as $name => $value)
		{
			//checks whether any of the fields are empty
			if (empty($value))
			{
				$_SESSION['errors'][$name] = "Sorry, ".$name." cannot be blank";
			}
			//checks other filters for email/password format
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
			//inside success loop
			$query3 = "INSERT into users (first_name, last_name, email, password, created_at) VALUES ('".$_POST['first']."','".$_POST['last']."','".$_POST['email']."','password', NOW())";
			run_mysql_query($query3);

			$query4 = "SELECT * from users WHERE email='".$_POST['email']."'";
			$temp = fetch_record($query4);
	
			header('Location: home.php');
			die();
		}

		//SEND BACK TO INDEX: FORMAT NOT CLEAN
		else  
		{
			header('Location: index.php');
		}

		die();
	}

	function login_user()
	{
		echo "you logged in !";

		$_SESSION['function'] = 'login';

		//GRAB POST Variables
		$password = $_POST['password'];
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
				array_push($_SESSION['errors'], $error);
			}
		}
		else
		{
			$error = "This user doesn't exist, please register above";
			array_push($_SESSION['errors'], $error);
		}

		if (isset($errors) )
		{
			header('Location: index.php');
		}
		else
		{
			//set user id  for displaying correct comments
			$_SESSION['user_id'] = $user_record['iduser'];
			$_SESSION['first'] = $user_record['first_name'];
			$_SESSION['last'] = $user_record['last_name'];
			header('Location: home.php');
		}

		die();
	}

	function logout_user()
	{
		unset($_SESSION);
		header("Location: index.php");
		die();
	}

	function new_msg()
	{
		var_dump($_POST);
		$query = "INSERT into messages (idusers, message, created_at, updated_at) VALUES (".$_POST['id'].", '".$_POST['message']."', NOW(), NOW() )";
		run_mysql_query($query);
	}

	function reply()
	{
		$query = "INSERT into comments (message_id, user_id, comment, created_at, updated_at) VALUES (".$_POST['message_id'].", ".$_POST['user_id'].", '".$_POST['comment']."', NOW(), NOW() )";
		run_mysql_query($query);
	}

	function delete_msg($id)
	{
		$query = "DELETE FROM messages WHERE idmessage=".$id;
		var_dump($query);
		die();
	}

	function delete_comment($id)
	{
		$query = "DELETE FROM comments where idcomment=".$id;
		run_mysql_query($query);
	}

 ?>