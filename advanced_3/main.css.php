<?php

 
    function gimmeColor()
    {
    	$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
    	$color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
    	return $color;
    }

    $h1 = gimmeColor();
    $p = gimmeColor();
    $b = gimmeColor();

   
	echo"
	*{
		background-color:".$b.";
		font-size: 60px;
	}";
	
	echo "
	p{
		color:".$p.";
	}";

	echo "
	h1{
		color:".$h1.";
	}";

 ?>
