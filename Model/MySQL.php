<?php
class MySQL {
	public $link;
	function connect() {
		require('/var/www/host-config.php');
		global $link;
   		$link = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);
		// if ($link->connect_error)
		//  	die($link->connect_error);

		$link->set_charset("utf8");
		return $link;
	}
	function real($string) {
		global $link;
		return mysqli_real_escape_string($link, $string);
	}
	function real_array($ary) {
		global $link;
		$new_str = array();
		foreach($ary as $key => $value) {
			$temp = mysqli_real_escape_string($link, $value);
			$new_str[$key] = $temp;
		}
		return $new_str;
	}
	function query($sql) {
		global $link;
		//return mysqli_query($link, $sql) or die("execute sql fail!!");
		return @mysqli_query($link, $sql) or die(mysqli_error($link));
	}
	function query_row($sql) {
		global $link;
		$result = mysqli_query($link, $sql) or die("execute sql failed!!");
		return @mysqli_fetch_row($result);
	}
	function query_array($sql) {
		global $link;
		$result = mysqli_query($link, $sql) or die("execute sql failed!!");
		return @mysqli_fetch_array($result);
	}
	function query_assoc($sql){
		global $link;
		$result = mysqli_query($link, $sql) or die("execute sql failed!!");
		return @mysqli_fetch_assoc($result);
	}
}


?>
