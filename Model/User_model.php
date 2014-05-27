<?php
	class User_Model extends MySQL {

		function __construct() {
			MySQL::connect();
		}

		function hash($password_raw , $salt){

			return md5($salt.md5($password_raw));
		}

		function get_client_ip(){
			// You should log all IP istead of log single IP
			// and beware of injection form IP
			// All source can be faked easily except "REMOTE_ADDR"
			$source = array(
				"HTTP_CLIENT_IP",
				"HTTP_X_FORWARDED_FOR",
				"HTTP_X_FORWARDED",
				"HTTP_X_CLUSTER_CLIENT_IP",
				"HTTP_FORWARDED_FOR",
				"HTTP_FORWARDED",
				"REMOTE_ADDR"
			);
			$ip = array();
		
			foreach ($source as $src) {
				$val = $_SERVER[$src];
				if (filter_var($val, FILTER_VALIDATE_IP) ||
					filter_var($val, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
						$ip[] = $val;
					} else {
						$ip[] = "";
					}
			}
		
			return implode(";", $ip);
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

				if ($password === $info['password']) {
					NTULog(" login success : username:$username");
					$_SESSION['uid'] = $info['id'];
					$_SESSION['realname'] = base64_encode($info['realname']);
					$_SESSION['username'] = $info['username'];
					NTULog(json_encode($_SESSION));
					header("Location:/vote-auth");
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
			echo '<script type="text/javascript">';
	  	    echo 'alert("'.$string.'");';
	  	    echo 'history.back();';
	  	    echo '</script>';
		}
	}



?>
