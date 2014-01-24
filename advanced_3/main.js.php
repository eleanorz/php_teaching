<?php 

	$x = rand(0, 100);
	$y = rand(0,100);
	$z = $x*$y;

	echo
	"
		var x = ".$x.";
		var y = ".$y.";
		console.log(x*y);
		alert('x is the value ".$x.", and y is the value ".$y.", their product is = ".$z."');
	";
?>