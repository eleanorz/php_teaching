<!-- BASIC 1 PHP Assignment -->

<?php

	function grade_me()
	{
		$score = rand(50, 100);
		
		echo "<h1>Your Score:";

		if ($score < 70) 
		{
			echo $score."/100 </h1>";
			echo "<h2>Your grade is a D</h2>";
		}
		elseif ($score < 80) 
		{
			echo $score."/100 </h1>";
			echo "<h2>Your grade is a C</h2>";	
		}
		elseif ($score < 90) 
		{
			echo $score."/100 </h1>";
			echo "<h2>Your grade is a B</h2>";	
		}
		else
		{
			echo $score."/100 </h1>";
			echo "<h2>Your grade is a A</h2>";
		}
	}


	for ($i=0; $i < 100; $i++)
	{ 
		grade_me();
	}

?>