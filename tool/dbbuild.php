<?php
	require_once("/var/www/Model/MySQL.php");
	/**
	* 
	*/

	class TicketKey extends MySQL{
		var $password , $username , $realname , $salt;

		function __construct($row){
			MySQL::connect();
			global $password , $salt , $auth, $username , $realname ;

			$row = explode("	",$row);
			print_r($row);
			$realname = $row[2];
			$username = $row[0];
			$password = $row[1];


			$len=32;


			//SALT
			$ranges = array(1 => array(97, 122),2 => array(65, 90),3 => array(48, 57));	
			$ranges_total = count($ranges);
			
			$tmp = '';
			for($i=0; $i < $len; $i++){
				$r = mt_rand(1, $ranges_total);
				$tmp .= chr(mt_rand($ranges[$r][0], $ranges[$r][1]));
			}

			$salt = $tmp;
			//SALT


			print_r(array("salt"=>$salt , "password"=>$password));
			$password = md5($salt.md5($password));
			$sql = "INSERT INTO `account`(username, password, salt, realname , admin) VALUES
							('$username','$password','$salt','$realname' , '1')";
			$tmp = $this->query($sql);


		}
	}

$passlist="";


$todopass = explode("\n", $passlist);

foreach ($todopass as $key => $value) {

	$a = new TicketKey($value);
}


?>