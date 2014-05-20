<?php
	@session_start();

 
	function exception_handler($e){
	    PHPerrorLog("EXCEPTION : ".$e->getMessage()." --- on Line:".$e->getLine()." at file:".$e->getFile());
	}
	set_exception_handler('exception_handler');

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

	function NTUvoteLog($msg,$ECHO=false){
	    $_msg = date("Y-m-d H:i:s")." ".get_client_ip()." $msg\n";
	    $log_path="/var/log/NTUvote/NTUvote.log";
	    @file_put_contents($log_path, $_msg,FILE_APPEND);
	}
	function PHPerrorLog($msg,$ECHO=false){
	    global $debug_mode;

	    $_msg = date("Y-m-d H:i:s")." $msg\n";
	    $log_path="/var/log/NTUvote/phperror.log";
	    @file_put_contents($log_path, $_msg,FILE_APPEND);
	    if($debug_mode==true || $ECHO==true ){
	        echo $_msg;
	    }
	}


	define('DS', DIRECTORY_SEPARATOR);
	define('APP_DIR',dirname(__FILE__));
	define('Models_DIR', APP_DIR.DS.'Model'.DS);
	define('Controllers_DIR', APP_DIR.DS.'Controller'.DS);
	define('Views_DIR', APP_DIR.DS.'View'.DS);

    require_once('host-config.php');
    date_default_timezone_set("Asia/Taipei");

    require_once(Controllers_DIR.'Controller.php');
    require_once(Controllers_DIR.'Vote.php');
    require_once(Models_DIR.'MySQL.php');
    require_once(Models_DIR.'User_model.php');


	$_control = new Controller();
	//網址分析2
	$_URL=$_SERVER['REQUEST_URI'];
	$_REDIRECT_URL = explode("/",$_URL);
	$first_url = @$_REDIRECT_URL[0];
	$second_url = @$_REDIRECT_URL[1];
	$third_url = @$_REDIRECT_URL[2];
	$t_REDIRECT_URL= explode(".", $second_url);
	$second_url=$t_REDIRECT_URL[0];
	$e_REDIRECT_URL = explode("?", $second_url);
	//處理get url
	$_GET_URL = explode("?", $third_url);

	$Controller = new Controller;

	switch ($e_REDIRECT_URL[0]) {
		case 'vote':
			$Controller->view("step1");
			break;
		case 'password_check':
			
			break;
		case 'login':
			$user = new User_Model;
			$user->Login($_POST);
			break;

		case 'logout':
			session_destroy();
			header("location:/");
			break;
		default:
			$Controller->view("index");
			session_destroy();
			break;
	}


?>




