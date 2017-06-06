 <footer>
    <p>&copy;<?php                 $startYear = 2016;
				   $currentYear = date('Y');
				   if($startYear == $currentYear) {
				   echo $startYear;
				  }
				   else{
						echo "{$startYear}&ndash;{$currentYear}";
					}
	?> Abiola Adeyefa</p>
 </footer>