<?php 
	session_start();

	if (!isset($_SESSION['sum']) )
	{
		$temp = 10;
		$_SESSION['sum'] = $temp;
		echo "I just started getting sum to work";

		echo "now let's see what happens after setting session to zero";

		var_dump($_SESSION);
	}
	if (!isset($_SESSION['activity']))
	{
		$_SESSION['activity'] = array();
		$temp = 'I just started';
		array_push($_SESSION['activity'], $temp); 
	}

	if (isset($_POST['action']) and $_POST['action'] == 'farm')
	{
		$temp = rand(10, 20);
		$_SESSION['sum'] = $_SESSION['sum'] + $temp;
		$temp2 = 'I am on the farm and '.$temp.' points were added to total </br> <h3>'.$_SESSION['sum'].'</h3>';
		array_push($_SESSION['activity'], $temp2);
		echo "random number is".$temp;
		echo "sum is".$_SESSION['sum'];
	}
	elseif (isset($_POST['action']) and $_POST['action'] == 'cave')
	{
		$temp = rand(5,10);
		$_SESSION['sum'] = $_SESSION['sum'] +$temp;
		$temp2 = 'I am in a cave, and '.$temp.' points were added to the total</br> <h3>'.$_SESSION['sum'].'</h3>';
		array_push($_SESSION['activity'], $temp2);
	}

	elseif (isset($_POST['action']) and $_POST['action'] == 'house')
	{
		$temp = rand(2,5);
		$_SESSION['sum'] = $_SESSION['sum'] +$temp;
		$temp2 = 'I am in a house, and '.$temp.' points were added to the total</br> <h3>'.$_SESSION['sum'].'</h3>';
		array_push($_SESSION['activity'], $temp2);
	}

	elseif (isset($_POST['action']) and $_POST['action'] == 'casino')
	{
		$temp = rand(-50,50);
		$_SESSION['sum'] = $_SESSION['sum'] +$temp;
		$temp2 = 'I am in a casino, and '.$temp.' points were added to the new total</br> <h3>'.$_SESSION['sum'].'</h3>';
		array_push($_SESSION['activity'], $temp2);
	}

	elseif (isset($_POST['action']) and $_POST['action'] == 'clean')
	{
		$_SESSION['sum'] = 0;
		$_SESSION['activity'] = array();
		$temp2 = '<h2>Restart</h2>';
		array_push($_SESSION['activity'], $temp2);
	}

	else
	{
		echo "I never made it into the loop";
		die();
	}

	header("Location: ninja_gold.php")

 ?>