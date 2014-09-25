<?php

	function GenPassword(){

			$ranges = array(65, 90);	
			$ranges_total = count($ranges);
			
			$tmp = '';
			for($i=0; $i < 8; $i++){
				$tmp .= chr(mt_rand($ranges[0], $ranges[1]));
			}
			return substr($tmp, 0 , 2)."-".substr($tmp, 2,3)."-".substr($tmp, 5,3);


	}

	$d1list = array("C");
	$d2list = array(array(0,9) );


	foreach ($d1list as $d1list_key => $d1list_value) {
		

		foreach ($d2list as $d2list_key => $d2list_value) {
			# code...

			for ($i=0; $i < 3; $i++) { 
				$result = GenPassword();
				$d1 = $d1list_value;
				$d2 = rand($d2list_value[0],$d2list_value[1]);
				echo "$d1$d2$result\n";
			}

		}
	}
?>