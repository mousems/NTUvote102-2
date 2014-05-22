<?php

 
	date_default_timezone_set("Asia/Taipei");
	function exception_handler($e){
	    PHPerrorLog("EXCEPTION : ".$e->getMessage()." --- on Line:".$e->getLine()." at file:".$e->getFile());
	}
	set_exception_handler('exception_handler');
	function get_keyindex($password=''){
		return substr(md5($password), 1,10);
	}
	
	function get_client_ip(){
		try {
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
		} catch (Exception $e) {
			$ip = "noip";
		}
	    
	    return $ip;
	}

	function NTULog($msg,$ECHO=false){
	    $_msg = date("Y-m-d H:i:s")." ".get_client_ip()." $msg\n";
	    $log_path="/var/log/NTUvote/NTUinfo.log";
	    @file_put_contents($log_path, $_msg,FILE_APPEND);
	}


	function NTUVoteLog($msg,$ECHO=false){
	    $_msg = date("Y-m-d H:i:s")." ".get_client_ip()." $msg\n";
	    $log_path="/var/log/NTUvote/votelog.log";
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
//echo urlencode('[{"cid":"B1-1","result":"1"},{"cid":"B1-2","result":"0"},{"cid":"B1-3","result":"-1"},{"cid":"B1-4","result":"1"},{"cid":"B1-5","result":"1"}]');
//echo json_encode($b);

?>