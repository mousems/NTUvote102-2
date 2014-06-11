<?php
/**
* 
*/
require_once("function.php");
require_once("/var/www/Model/MySQL.php");

class Vote extends MySQL {
	var $candidate_data;

	function __construct(){	
		global $candidate_data;
		$candidate_data = new stdClass;
		$json='{"C2-0":{"rname":"na","rid":"C2","no":"0","dept":"na","name":"na"},"C2-1":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"1","dept":"\u5927\u6c23\u78a9\u4e00","name":"\u9673\u6881\u653f"},"C2-2":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"2","dept":"\u6d77\u6d0b\u78a9\u4e00","name":"\u8607\u742c\u5a77"},"C2-3":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"3","dept":"\u96fb\u4fe1\u78a9\u4e00","name":"\u9ec3\u67cf\u5b87"},"C2-4":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"4","dept":"\u690d\u5fae\u78a9\u4e00","name":"\u76e7\u6f54"},"C2-5":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"5","dept":"\u7d93\u6fdf\u78a9\u4e00","name":"\u912d\u660e\u54f2"},"C2-6":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"6","dept":"\u5712\u85dd\u78a9\u4e00","name":"\u5289\u80b2\u52f3"},"C2-7":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"7","dept":"\u96fb\u5b50\u78a9\u4e00","name":"\u738b\u5247\u60df"},"C2-8":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"8","dept":"\u570b\u4f01\u78a9\u4e00","name":"\u95d5\u6109\u5a1f"},"C2-9":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"9","dept":"\u571f\u6728\u6240","name":"\u65bd\u6b63\u502b"},"C2-10":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"10","dept":"\u79d1\u6cd5\u78a9\u4e00","name":"\u9673\u6587\u8473"},"C2-11":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"11","dept":"\u570b\u767c\u78a9\u4e8c","name":"\u9127\u7dad\u8fb2"},"C2-12":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"12","dept":"\u96fb\u5b50\u78a9\u4e00","name":"\u5289\u4f73\u741b"},"C2-13":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"13","dept":"\u570b\u767c\u78a9\u4e8c","name":"\u66fe\u53cb\u5db8"},"C2-14":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"14","dept":"\u7378\u91ab\u78a9\u4e8c","name":"\u8303\u6b63\u4e00"},"C2-15":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"15","dept":"\u6a5f\u68b0\u78a9\u4e00","name":"\u5f35\u54f2\u7dad"},"C2-16":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"16","dept":"\u4eba\u985e\u78a9\u4e8c","name":"\u738b\u921e\u745c"},"D1-1":{"rname":"\u793e\u79d1\u9662\u5b78\u751f\u6703\u9577","rid":"D1","no":"1","dept":"\u653f\u6cbb\u4e8c","name":"\u8521\u627f\u7ff0"},"D4-1":{"rname":"\u7ba1\u9662\u5b78\u751f\u6703\u9577","rid":"D4","no":"1","dept":"\u6703\u8a08\u4e8c","name":"\u66f8\u5176\u6690"}}';
		$candidate_data = json_decode($json);

		//stdClass Object
		// (
		//     [A1-1] => stdClass Object
		//         (
		//             [rname] => 學生會會長
		//             [rid] => A1
		//             [no] => 1
		//             [dept] => 國發碩一
		//             [name] => 汪興寰
		//         )
		//
		//     [A1-2] => stdClass Object
		//         (
		//             [rname] => 學生會會長
		//             [rid] => A1
		//             [no] => 2
		//             [dept] => 中文二
		//             [name] => 王日暄
		//         )
		//
		//			...
		// }
		$this->connect();

	}



	// return -1 for error
	function Get_Ticket_step($password){

		$result=preg_match("/^([A-Z])(\d)[A-Z]{8}$/", $password , $matches);

		if ($result===1) {
		}else{
			NTULog(" Vote-Get_Ticket_step failed '$password' for password format");
			return -1;
		}

		$keyindex = get_keyindex($password) ;
		$d1 = $matches[1];
		$d2 = $matches[2];
		$SQL = "SELECT * from `ticket` where `keyindex`='$keyindex'";

		try {
			$tmp = $this->query_row($SQL);
		} catch (Exception $e) {
			NTULog("warning MySQL failed");
			return -1;
		}

		if (isset($tmp)) {
			//password exists
			$auth_fromuser = sha1($tmp[2].md5($password));
			if ($auth_fromuser===$tmp[1]) {
				if ($tmp[3]==0 || $tmp[3]<=date("U") ){
					//pass auth		

					$final_step = sizeof(Get_votelist($password));

					if ($step>=$final_step) {
						NTULog(" Vote-Get_Ticket_step failed '$password' step wrong out of range");
						return -1;
					}

					return $tmp[4];
				}else{

					NTULog(" Vote-Get_Ticket_step failed '$password' is already locked");
					return -1;
				}		

			}else{
				NTULog(" Vote-Get_Ticket_step failed '$password' match index but hash failed");
				return -1;

			}
		}else{
			NTULog(" Vote-Get_Ticket_step fail '$password' not found");
			return -1;
		}



	}


	/*
	// return 0:failed ,1:success , -1:locked

	*/
	function Check_ticket($step , $password){
		$result=preg_match("/^([A-Z])(\d)[A-Z]{8}$/", $password , $matches);

		if ($result===1) {
		}else{
			NTULog(" Vote-check_ticket failed '$password' for password format");
			return 0;
		}

		$result=preg_match("/^(\d)$/", $step);

		
		if ($result===1) {
		}else{
			NTULog(" Vote-check_ticket failed '$step' for step format");
			return 0;
		}


		$keyindex = get_keyindex($password) ;
		$d1 = $matches[1];
		$d2 = $matches[2];
		$SQL = "SELECT * from `ticket` where `keyindex`='$keyindex'";

		try {
			$tmp = $this->query_row($SQL);
		} catch (Exception $e) {
			NTULog("warning MySQL failed");
			return 0;
		}

		if (isset($tmp)) {
			//password exists
			$auth_fromuser = sha1($tmp[2].md5($password));
			if ($auth_fromuser===$tmp[1]) {
				if ($tmp[3]==0 || $tmp[3]<=date("U") ){
					//pass auth		

					$final_step = sizeof(Get_votelist($password));

					if ($step>$final_step) {
						NTULog(" Vote-check_ticket failed '$password' step wrong out of range");
						return 0;
					}

					if ($step == $tmp[4]+1) {
						return 1;
					}else{
						NTULog(" Vote-check_ticket failed '$password' step wrong");
						NTULog(json_encode($tmp));
						return 0;
					}

				}else{

					NTULog(" Vote-check_ticket failed '$password' is already locked");
					return -1;
				}		

			}else{
				NTULog(" Vote-check_ticket failed '$password' match index but hash failed");
				return 0;

			}
		}else{
			NTULog(" Vote-check_ticket fail '$password' not found");
			return 0;
		}

	}

	function Lock_ticket($password){
		$result=preg_match("/^([A-Z])(\d)[A-Z]{8}$/", $password , $matches);


		if ($result===1) {
		}else{			NTULog(" Vote-Lock_ticket failed '$password' for fomat");
			return 0;
		}

		$keyindex = get_keyindex($password) ;


		$unlocktime = date("U")+180;

		try {
			$SQL = "UPDATE `ticket` SET `status`='$unlocktime' where `keyindex`='$keyindex'";

			$this->query_row($SQL);
			NTULog(" Vote-Lock_ticket locked successful '$password'");
			return 1;
		} catch (Exception $e) {
			NTULog("Vote-Lock_ticket warning Lock_ticket failed");
			return 0;
		}
					//Lock
	}

	function Unlock_ticket($password){
		$result=preg_match("/^([A-Z])(\d)[A-Z]{8}$/", $password , $matches);


		if ($result===1) {
		}else{
			NTULog(" Vote-Unlock_ticket failed '$password' for fomat");
			return 0;
		}

		$keyindex = get_keyindex($password) ;
		try {
			$SQL = "UPDATE `ticket` SET `status`='0' and `step`=`step`+1 where `keyindex`='$keyindex'";
			$this->query_row($SQL);

			return 1;
		} catch (Exception $e) {
			NTULog("warning Unlock_ticket failed");
			return 0;
		}
		//Lock
	}



	function submitTicketSingle($step , $password , $cid){

		global $candidate_data;
		$result=preg_match("/^([A-Z])(\d)[A-Z]{8}$/", $password , $matches);


		if ($result===1) {
		}else{
			NTULog(" Vote-submit_ticket_single failed '$password' for password format");
			return 0;
		}

		$result=preg_match("/^(\d)$/", $step);

		if ($result===1) {
		}else{
			NTULog(" Vote-submit_ticket_single failed '$step' for step format");
			return 0;
		}

		$result=preg_match("/([A-Z][\d]+)-[\d]+/", $cid , $votelistmatch);

		if ($result===1) {
		}else{
			NTULog(" Vote-submit_ticket_single failed '$cid' for cid format");
			return 0;
		}


		$keyindex = get_keyindex($password) ;

		$votelist = Get_votelist($password);

		preg_match("/([A-Z])(\d)+/" , $votelist[$step] , $checkmulti);
		if ($checkmulti[1]=="B") {
			NTULog(" must be multi for password $password  step $step");
			return 0;
		}


		if ($votelistmatch[1]==$votelist[$step] ) {
			
			$checkresult = $this->Check_ticket($step , $password);
		 	
		 	if ($checkresult==-1 || $checkresult==1) {

				try {
					$SQL = "UPDATE `ticket` SET `step`='$step' where `keyindex`='$keyindex'";
					$this->query_row($SQL);
				} catch (Exception $e) {
					NTULog("warning submit_ticket_single MYSQL failed");
					return 0;
				}

				$this->Unlock_ticket($password);
				
				if (isset($candidate_data->{$cid})) {
					
					NTUvoteLog(" $cid");

					return 1;
				}else{

					NTULog("warning submit_ticket_single cid not found $cid");
					return 0;
				}


		 	}else{

				NTULog("warning submit_ticket_single Check_ticket failed");
				return 0;
		 	}




		}else{
			NTULog(" Vote-submit_ticket_single failed '$cid' for cid format match");
			return 0;
		}

		# code...
	}

	function getCidCount($step , $password){
		global $candidate_data;
		//check pwd
		$result=preg_match("/^([A-Z])(\d)[A-Z]{8}$/", $password , $matches);
		if ($result===1) {
		}else{
			NTULog(" Vote-getCidCount failed '$password' for password format");
			return 0;
		}

		$result=preg_match("/^(\d)$/", $step);

		if ($result===1) {
		}else{
			NTULog(" Vote-getCidCount failed '$step' for step format");
			return 0;
		}


		$votelist = Get_votelist($password);
		$count = 0;
		foreach ($candidate_data as $key => $value) {
			if ($value->{'rid'}==$votelist[$step]) {
				$count++;
			}
		}
		return $count;

	}


	function getCidList($step , $password){
		global $candidate_data;
		//check pwd
		$result=preg_match("/^([A-Z])(\d)[A-Z]{8}$/", $password , $matches);
		if ($result===1) {
		}else{
			NTULog(" Vote-getCidCount failed '$password' for password format");
			return 0;
		}

		$result=preg_match("/^(\d)$/", $step);

		if ($result===1) {
		}else{
			NTULog(" Vote-getCidCount failed '$step' for step format");
			return 0;
		}


		$votelist = Get_votelist($password);
		$count = 0;

		$cidlist = array();
		foreach ($candidate_data as $key => $value) {
			if ($value->{'rid'}==$votelist[$step]) {
				array_push($cidlist, $key);
				$count++;
			}
		}
		return $cidlist;

	}

	/*
		result_list:1,-1,0,1... for match each cid by password
	*/
	function submitTicketMulti($step , $password , $result_list){
		global $candidate_data;
		$result_list = explode(",",$result_list);

		if ($this->getCidCount($step,$password) != sizeof($result_list)) {
			NTULog(" Vote-submitTicketMulti failed '$password' '$step' '".json_encode($result_list)."' not match");
			return 0;
		}




		//check pwd
		$result=preg_match("/^([A-Z])(\d)[A-Z]{8}$/", $password , $matches);
		if ($result===1) {
		}else{
			NTULog(" Vote-submitTicketMulti failed '$password' for password format");
			return 0;
		}

		$result=preg_match("/^(\d)$/", $step);

		if ($result===1) {
		}else{
			NTULog(" Vote-submitTicketMulti failed '$step' for step format");
			return 0;
		}



		$votelist = Get_votelist($password);

		preg_match("/([A-Z])(\d)+/" , $votelist[$step] , $checkmulti);
		if ($checkmulti[1]=="D") {
			
		}else{
			NTULog(json_encode($checkmulti));
			NTULog(" must be single for password $password  step $step");
			return 0;
		}

		$cidlist = $this->getCidList($step , $password);

			
		$checkresult = $this->Check_ticket($step , $password);
	 	
	 	if ($checkresult==1) {


			try {
			$keyindex = get_keyindex($password) ;
				$SQL = "UPDATE `ticket` SET `step`='$step' where `keyindex`='$keyindex'";
				$this->query_row($SQL);
			} catch (Exception $e) {
				NTULog("warning submitTicketMulti MYSQL failed");
				return 0;
			}

			$this->Unlock_ticket($password);


	 		foreach ($cidlist as $cidlist_key => $cidlist_value) {
				NTUvoteLog(" ".$cidlist_value.":".$result_list[$cidlist_key]);

	 		}
			return 1;

	 	}else{

			NTULog("warning submitTicketMulti Check_ticket failed");
			return 0;
	 	}





	}



}


?>