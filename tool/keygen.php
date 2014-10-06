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
			for($i=0; $i < $len; $i++){
				$r = mt_rand(1, $ranges_total);
				$tmp .= chr(mt_rand($ranges[$r][0], $ranges[$r][1]));
			}

			$salt = $tmp;

			$auth = sha1($salt.md5($password));
		}

		function intodb(){
			global $salt , $auth , $password;
			$keyindex = substr(md5($password), 1,10) ;
			$sql = "INSERT INTO `ticket`(auth, salt, status, step ,keyindex) VALUES
							('$auth','$salt','0','0','$keyindex')";
			$tmp = $this->query($sql);


			return $tmp;
		}
	}

$passlist="";

$passlist = str_replace("-", "", $passlist);

$todopass = explode("\n", $passlist);

foreach ($todopass as $key => $value) {

	$a = new TicketKey($value);
	echo $value.":".($a->intodb())."\n";

}


?>