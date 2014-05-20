<?php
	require_once("/var/www/Model/MySQL.php");
	/**
	* 
	*/
	class TicketKey extends MySQL{
		var $password , $salt , $auth;

		function __construct($pwd){
			MySQL::connect();
			global $password , $salt , $auth;
			$password = $pwd;


			$len=32;

			$ranges = array(1 => array(97, 122),2 => array(65, 90),3 => array(48, 57));	
			$ranges_total = count($ranges);
			
			$tmp = '';
			for($i=1; $i <= $ranges_total; $i++){
				$tmp .= chr(mt_rand($ranges[$i][0], $ranges[$i][1]));
				$len--;
			}
			for($i=0; $i < $len; $i++){
				$r = mt_rand(1, $ranges_total);
				$tmp .= chr(mt_rand($ranges[$r][0], $ranges[$r][1]));
			}

			$salt = $tmp;

			$auth = sha1($password.md5($salt));
		}

		function intodb(){
			global $salt , $auth;

			$sql = "INSERT INTO `ticket`(auth, salt, status, step) VALUES
							('$auth','$salt','0','0')";
			$tmp = $this->query($sql);


			return $tmp;
		}
	}

$passlist="A156238128
A192280602
A167499070
A164546564
A181180940
A116797791
A122872615
A168231868
A155365364
A175024454
A178314091
A153580189
A188053413
A164167721
A199610097
A151064897
A178732781
A126074774
A113417078
A188950508
A175795173
A151409461
A152967601
A194655237
A181533542
A123243320
A166204697
A138509304
A122004809
A161020990
A198198440
A168242938
A153301593
A165697510
A132789502
A134482534
A172495301
A145662117
A192714402
A127860666
A120686571
A171028493
A171440856
A198739985
A135196214
A171050954
A149804883
A113928996
A187125728
A153221961
A192879505
A162920901
A194631423
A145847106
A157576138
A176164965
A159090427
A123780836
A114674269
A171095236
A174801826
A112872710
A139338174
A128103420
A168570220
A162127677
A152585954
A141065522
A197789794
A145300356
A158926188
A118476366
A116328850
A130367045
A117216351
A141525064
A191417999
A157021234
A145454061
A178543727
A110243196
A138333566
A141464629
A194874619
A174180673
A189040768
A171039585
A133271100
A112821604
A175713855
A194366337
A177623431
A178586565
A133704512
A195726851
A147156785
A185832189
A148312806
A178222308
A183621984";

$todopass = explode("\n", $passlist);

foreach ($todopass as $key => $value) {

	$a = new TicketKey($value);
	print_r($a->intodb());

}

?>