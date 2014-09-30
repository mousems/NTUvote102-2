<?php

 	
	date_default_timezone_set("Asia/Taipei");
	function exception_handler($e){
	    PHPerrorLog("EXCEPTION : ".$e->getMessage()." --- on Line:".$e->getLine()." at file:".$e->getFile());
	}
	set_exception_handler('exception_handler');
	function get_keyindex($password=''){
		return substr(md5($password), 1,10);
	}


	function Get_votelist($password){

		$result=preg_match("/^([A-Z])(\d)[A-Z]{8}$/", $password , $matches);


		$list1['A']=array(1=>'C1'); // againvote use this
		$list1['B']=array(1=>'D1');
		$list1['C']=array(1=>'D4');
		$list1['D']=array(1=>'A1' ,2=>'B4');
		$list1['E']=array(1=>'A1' ,2=>'B5' ,3=>'D2');
		$list1['F']=array(1=>'A1' ,2=>'B6' ,3=>'D3');
		$list1['G']=array(1=>'A1' ,2=>'B7' ,3=>'D4');
		$list1['H']=array(1=>'A1' ,2=>'B8');
		$list1['I']=array(1=>'A1' ,2=>'B9');
		$list1['J']=array(1=>'A1' ,2=>'B10' ,3=>'D5');
		$list1['K']=array(1=>'A1');

		// if ($matches[2]>=5) {
		// 	array_push($list1[$matches[1]] , 'C1');
		// 	array_push($list1[$matches[1]] , 'C2');
		// }

		return $list1[$matches[1]];

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
			$val = @$_SERVER[$src];
			if (filter_var($val, FILTER_VALIDATE_IP) ||
				filter_var($val, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
					$ip[] = $val;
				} else {
					$ip[] = "";
				}
		}
	
		return implode(";", $ip);
	}

	function NTULog($msg,$ECHO=false){
		if (isset($_SESSION['username'])) {
			$username = $_SESSION['username'];
		}else{
			$username = "{notlogin}";
		}
	    $_msg = date("Y-m-d H:i:s")." ".get_client_ip()." ".$username." $msg session:".json_encode($_SESSION)."\n";
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
