<?php 
	function reverse_arr($x)
	{
		echo "<h1> The input array is:  </h1> ";
		var_dump($x);

		$a = 0;
		$b = count($x) - 1;
		$i = (count($x)/2);
		$t = 0;

		if ($i > 0)
		{
			$t = $x[$a];
			$x[$a] = $x[$b];
			$x[$b] = $t;

			$a++;
			$b--;
			$i--;
		}

		echo "<h1> the final output array is:</h1>";
		var_dump($x);

		return($x);
	}

	reverse_arr(['0','1','2','3','4']);
	reverse_arr(['j','k','l','m','n']);
	reverse_arr(['a','b','c','d','e']);

	reverse_arr(['j','k','l','m','n','0','1','2','3','4']);
 ?>