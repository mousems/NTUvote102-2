<?php
	class User_Model extends MySQL {

		function __construct() {
			MySQL::connect();
		}

		function hash($password_raw , $salt){

			return md5($salt.md5($password_raw));
		}

		function get_client_ip(){
		    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		        $ip = $_SERVER['HTTP_CLIENT_IP'];
		    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		    } elseif (!empty($_SERVER['HTTP_X_FORWARDED'])) {
		        $ip = $_SERVER['HTTP_X_FORWARDED'];
		    } elseif (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
		        $ip = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
		    } elseif (!empty($_SERVER['HTTP_FORWARDED_FOR'])) {
		        $ip = $_SERVER['HTTP_FORWARDED_FOR'];
		    } elseif (!empty($_SERVER['HTTP_FORWARDED'])) {
		        $ip = $_SERVER['HTTP_FORWARDED'];
		    } else {
		        $ip = $_SERVER['REMOTE_ADDR'];
		    }
		    return $ip;
		}

		function login($str) {
			$ip = get_client_ip();

			$new_str = MySQL::real_array($str);
			$username = $new_str['username'];
			$password = $new_str['password'];


			NTULog(json_encode($new_str));
			NTULog(" is try to login : username:$username");

			$sql = "SELECT * FROM account WHERE username = '$username'";
			$info = MySQL::query_array($sql);
			NTULog(json_encode($info));


			if (isset($info)) {

				$password = User_Model::hash($password , $info['salt']);

				if ($password = $info['password']) {
					NTULog(" login success : username:$username");
					$_SESSION['uid'] = $info['id'];
					header("Location:/vote");
				}else{
					NTULog(" login failed : username:$username password not match");
					$msg = "帳號密碼錯誤";
					User_Model::errorMsg($msg);
				}

			}else{
				NTULog(" login failed : username:$username notfound");
				$msg = "帳號密碼錯誤";
				User_Model::errorMsg($msg);
			}


			//login and set 
		}





		function errorMsg($string) {
	        echo '<noscript>'.$string.'</noscript>';
			echo '<script language="javascript">';
	  	    echo 'alert("'.$string.'");';
	  	    echo 'history.back();';
	  	    echo '</script>';
		}
	}



?>