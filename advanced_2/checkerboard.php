

<html>
<head>
	<title>checkerboard</title>
	<link rel="stylesheet" href="main.css">
</head>
<body>

</body>
</html>

<?php 


echo "<h1> Checkerboard Generator </h1>";

echo "string";

echo "<table>";
for ($i=0; $i < 8; $i++)
{ 
	echo "<tr>";
	for ($j=0; $j < 8; $j++)
	{ 
		$k = ($i + $j)%2;
		if ($k ==1)
		{		
			echo "<td class = 'red'>class".$k."</td>";
		}
		else
		{		
			echo "<td class = 'black'>class".$k."</td>";
		}
	}

	echo "</tr>";
}

echo "</table>";

?>