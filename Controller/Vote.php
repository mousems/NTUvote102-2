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
		$json='{"A1-0":{"rname":"\u5ee2\u7968","rid":"A1","no":"0","dept":"na","name":"na"},"A1-1":{"rname":"\u5b78\u751f\u6703\u6703\u9577","rid":"A1","no":"1","dept":"\u570b\u767c\u78a9\u4e00","name":"\u6c6a\u8208\u5bf0"},"A1-2":{"rname":"\u5b78\u751f\u6703\u6703\u9577","rid":"A1","no":"2","dept":"\u4e2d\u6587\u4e8c","name":"\u738b\u65e5\u6684"},"A1-3":{"rname":"\u5b78\u751f\u6703\u6703\u9577","rid":"A1","no":"3","dept":"\u54f2\u5b78\u4e09","name":"\u90ed\u6de8\u6e90"},"B1-1":{"rname":"\u6587\u5b78\u9662\u5b78\u4ee3","rid":"B1","no":"1","dept":"\u6b77\u53f2\u4e8c","name":"\u6d82\u6b23\u51f1"},"B1-2":{"rname":"\u6587\u5b78\u9662\u5b78\u4ee3","rid":"B1","no":"2","dept":"\u5716\u8cc7\u4e00","name":"\u59da\u67cf\u5b87"},"B1-3":{"rname":"\u6587\u5b78\u9662\u5b78\u4ee3","rid":"B1","no":"3","dept":"\u54f2\u5b78\u4e8c","name":"\u90b1\u5b50\u8ed2"},"B1-4":{"rname":"\u6587\u5b78\u9662\u5b78\u4ee3","rid":"B1","no":"4","dept":"\u4eba\u985e\u4e00","name":"\u8521\u4f73\u6607"},"B2-1":{"rname":"\u7406\u5b78\u9662\u5b78\u4ee3","rid":"B2","no":"1","dept":"\u5fc3\u7406\u4e09","name":"\u6d2a\u5b50\u921e"},"B2-2":{"rname":"\u7406\u5b78\u9662\u5b78\u4ee3","rid":"B2","no":"2","dept":"\u7269\u7406\u4e09","name":"\u6797\u5b50\u7fd4"},"B3-1":{"rname":"\u793e\u79d1\u9662\u5b78\u4ee3","rid":"B3","no":"1","dept":"\u653f\u6cbb\u78a9\u4e00","name":"\u8a31\u5bb6\u777f"},"B3-2":{"rname":"\u793e\u79d1\u9662\u5b78\u4ee3","rid":"B3","no":"2","dept":"\u7d93\u6fdf\u4e09","name":"\u5f6d\u6cbb\u9f4a"},"B3-3":{"rname":"\u793e\u79d1\u9662\u5b78\u4ee3","rid":"B3","no":"3","dept":"\u570b\u767c\u78a9\u4e09","name":"\u97d3\u4fca\u8ce2"},"B3-4":{"rname":"\u793e\u79d1\u9662\u5b78\u4ee3","rid":"B3","no":"4","dept":"\u7d93\u6fdf\u4e09","name":"\u9673\u79b9\u7af9"},"B3-5":{"rname":"\u793e\u79d1\u9662\u5b78\u4ee3","rid":"B3","no":"5","dept":"\u570b\u767c\u78a9\u4e8c","name":"\u5f90\u4f51\u6607"},"B4-1":{"rname":"\u91ab\u5b78\u9662\u5b78\u4ee3","rid":"B4","no":"1","dept":"\u91ab\u5b78\u4e8c","name":"\u8521\u70ab\u9321"},"B4-2":{"rname":"\u91ab\u5b78\u9662\u5b78\u4ee3","rid":"B4","no":"2","dept":"\u91ab\u5b78\u4e09","name":"\u6797\u6602\u9821"},"B4-3":{"rname":"\u91ab\u5b78\u9662\u5b78\u4ee3","rid":"B4","no":"3","dept":"\u8b77\u7406\u4e8c","name":"\u5433\u4f73\u73b2"},"B4-4":{"rname":"\u91ab\u5b78\u9662\u5b78\u4ee3","rid":"B4","no":"4","dept":"\u7269\u6cbb\u4e8c","name":"\u6797\u70b3\u9a30"},"B4-5":{"rname":"\u91ab\u5b78\u9662\u5b78\u4ee3","rid":"B4","no":"5","dept":"\u91ab\u5b78\u4e00","name":"\u738b\u7d2b\u8b93"},"B4-6":{"rname":"\u91ab\u5b78\u9662\u5b78\u4ee3","rid":"B4","no":"6","dept":"\u91ab\u5b78\u4e8c","name":"\u9ec3\u5e8f\u7acb"},"B5-1":{"rname":"\u5de5\u5b78\u9662\u5b78\u4ee3","rid":"B5","no":"1","dept":"\u6a5f\u68b0\u4e09","name":"\u9ad8\u7ae0\u741b"},"B5-2":{"rname":"\u5de5\u5b78\u9662\u5b78\u4ee3","rid":"B5","no":"2","dept":"\u57ce\u9109\u78a9\u4e00","name":"\u8cf4\u6afb\u82b3"},"B5-3":{"rname":"\u5de5\u5b78\u9662\u5b78\u4ee3","rid":"B5","no":"3","dept":"\u5316\u5de5\u4e09","name":"\u937e\u653f\u9716"},"B5-4":{"rname":"\u5de5\u5b78\u9662\u5b78\u4ee3","rid":"B5","no":"4","dept":"\u571f\u6728\u78a9\u4e00","name":"\u65bd\u6b63\u502b"},"B6-1":{"rname":"\u751f\u8fb2\u9662\u5b78\u4ee3","rid":"B6","no":"1","dept":"\u751f\u5de5\u56db","name":"\u4faf\u745e\u745c"},"B6-2":{"rname":"\u751f\u8fb2\u9662\u5b78\u4ee3","rid":"B6","no":"2","dept":"\u8fb2\u7d93\u4e8c","name":"\u912d\u4f51\u5ba3"},"B6-3":{"rname":"\u751f\u8fb2\u9662\u5b78\u4ee3","rid":"B6","no":"3","dept":"\u68ee\u6797\u4e8c","name":"\u6234\u52ad\u82b8"},"B6-4":{"rname":"\u751f\u8fb2\u9662\u5b78\u4ee3","rid":"B6","no":"4","dept":"\u6606\u87f2\u4e8c","name":"\u5f35\u5bb6\u8c6a"},"B6-5":{"rname":"\u751f\u8fb2\u9662\u5b78\u4ee3","rid":"B6","no":"5","dept":"\u751f\u50b3\u4e8c","name":"\u6797\u627f\u8ce2"},"B7-1":{"rname":"\u7ba1\u9662\u5b78\u4ee3","rid":"B7","no":"1","dept":"\u5de5\u7ba1\u4e8c","name":"\u738b\u8000\u589e"},"B7-2":{"rname":"\u7ba1\u9662\u5b78\u4ee3","rid":"B7","no":"2","dept":"\u5de5\u7ba1\u4e09","name":"\u984f\u5d07\u76ca"},"B7-3":{"rname":"\u7ba1\u9662\u5b78\u4ee3","rid":"B7","no":"3","dept":"\u6703\u8a08\u4e8c","name":"\u8607\u9756\u5bcc"},"B7-4":{"rname":"\u7ba1\u9662\u5b78\u4ee3","rid":"B7","no":"4","dept":"\u5de5\u7ba1\u4e09","name":"\u6797\u6615\u92d2"},"B7-5":{"rname":"\u7ba1\u9662\u5b78\u4ee3","rid":"B7","no":"5","dept":"\u6703\u8a08\u4e8c","name":"\u9673\u6620\u5112"},"B8-1":{"rname":"\u516c\u885b\u9662\u5b78\u4ee3","rid":"B8","no":"1","dept":"\u516c\u885b\u4e8c","name":"\u9673\u5ba3\u7af9"},"B8-2":{"rname":"\u516c\u885b\u9662\u5b78\u4ee3","rid":"B8","no":"2","dept":"\u516c\u885b\u4e00","name":"\u66fe\u9756\u8ed2"},"B9-1":{"rname":"\u96fb\u8cc7\u9662\u5b78\u4ee3","rid":"B9","no":"1","dept":"\u96fb\u6a5f\u4e09","name":"\u5433\u8ed2\u5b87"},"B9-2":{"rname":"\u96fb\u8cc7\u9662\u5b78\u4ee3","rid":"B9","no":"2","dept":"\u96fb\u6a5f\u4e8c","name":"\u9f94\u664f\u5fb5"},"B9-3":{"rname":"\u96fb\u8cc7\u9662\u5b78\u4ee3","rid":"B9","no":"3","dept":"\u96fb\u6a5f\u4e09","name":"\u6731\u5e0c\u5e73"},"B9-4":{"rname":"\u96fb\u8cc7\u9662\u5b78\u4ee3","rid":"B9","no":"4","dept":"\u96fb\u6a5f\u4e09","name":"\u694a\u7267\u8861"},"B9-5":{"rname":"\u96fb\u8cc7\u9662\u5b78\u4ee3","rid":"B9","no":"5","dept":"\u96fb\u6a5f\u4e09","name":"\u65bd\u4fdd\u5168"},"B9-6":{"rname":"\u96fb\u8cc7\u9662\u5b78\u4ee3","rid":"B9","no":"6","dept":"\u8cc7\u5de5\u4e09","name":"\u99ae\u786f"},"B9-7":{"rname":"\u96fb\u8cc7\u9662\u5b78\u4ee3","rid":"B9","no":"7","dept":"\u96fb\u6a5f\u4e8c","name":"\u8f9b\u723e\u5eb7"},"B10-1":{"rname":"\u6cd5\u5b78\u9662\u5b78\u4ee3","rid":"B10","no":"1","dept":"\u6cd5\u5f8b\u4e09","name":"\u90b1\u4e1e\u6b63"},"B10-2":{"rname":"\u6cd5\u5b78\u9662\u5b78\u4ee3","rid":"B10","no":"2","dept":"\u6cd5\u5f8b\u4e09","name":"\u8b1d\u5b5f\u7487"},"B10-3":{"rname":"\u6cd5\u5b78\u9662\u5b78\u4ee3","rid":"B10","no":"3","dept":"\u6cd5\u5f8b\u4e8c","name":"\u5468\u6613"},"C1-0":{"rname":"na","rid":"C1","no":"0","dept":"na","name":"na"},"C1-1":{"rname":"\u7814\u5354\u6703\u6703\u9577","rid":"C1","no":"1","dept":"\u570b\u767c\u78a9\u4e00","name":"\u9673\u4e59\u68cb"},"C1-2":{"rname":"\u7814\u5354\u6703\u6703\u9577","rid":"C1","no":"2","dept":"\u570b\u767c\u78a9\u4e8c","name":"\u5468\u82b7\u8431"},"C2-0":{"rname":"na","rid":"C2","no":"0","dept":"na","name":"na"},"C2-1":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"1","dept":"\u5927\u6c23\u78a9\u4e00","name":"\u9673\u6881\u653f"},"C2-2":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"2","dept":"\u6d77\u6d0b\u78a9\u4e00","name":"\u8607\u742c\u5a77"},"C2-3":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"3","dept":"\u96fb\u4fe1\u78a9\u4e00","name":"\u9ec3\u67cf\u5b87"},"C2-4":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"4","dept":"\u690d\u5fae\u78a9\u4e00","name":"\u76e7\u6f54"},"C2-5":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"5","dept":"\u7d93\u6fdf\u78a9\u4e00","name":"\u912d\u660e\u54f2"},"C2-6":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"6","dept":"\u5712\u85dd\u78a9\u4e00","name":"\u5289\u80b2\u52f3"},"C2-7":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"7","dept":"\u96fb\u5b50\u78a9\u4e00","name":"\u738b\u5247\u60df"},"C2-8":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"8","dept":"\u570b\u4f01\u78a9\u4e00","name":"\u95d5\u6109\u5a1f"},"C2-9":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"9","dept":"\u571f\u6728\u6240","name":"\u65bd\u6b63\u502b"},"C2-10":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"10","dept":"\u79d1\u6cd5\u78a9\u4e00","name":"\u9673\u6587\u8473"},"C2-11":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"11","dept":"\u570b\u767c\u78a9\u4e8c","name":"\u9127\u7dad\u8fb2"},"C2-12":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"12","dept":"\u96fb\u5b50\u78a9\u4e00","name":"\u5289\u4f73\u741b"},"C2-13":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"13","dept":"\u570b\u767c\u78a9\u4e8c","name":"\u66fe\u53cb\u5db8"},"C2-14":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"14","dept":"\u7378\u91ab\u78a9\u4e8c","name":"\u8303\u6b63\u4e00"},"C2-15":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"15","dept":"\u6a5f\u68b0\u78a9\u4e00","name":"\u5f35\u54f2\u7dad"},"C2-16":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"16","dept":"\u4eba\u985e\u78a9\u4e8c","name":"\u738b\u921e\u745c"},"D1-0":{"rname":"\u5ee2\u7968","rid":"D1","no":"0","dept":"na","name":"na"},"D1-1":{"rname":"\u793e\u79d1\u9662\u5b78\u751f\u6703\u9577","rid":"D1","no":"1","dept":"\u653f\u6cbb\u4e8c","name":"\u8521\u627f\u7ff0"},"D2-0":{"rname":"\u5ee2\u7968","rid":"D2","no":"0","dept":"na","name":"na"},"D2-1":{"rname":"\u5de5\u5b78\u9662\u5b78\u751f\u6703\u9577","rid":"D2","no":"1","dept":"\u5de5\u79d1\u4e8c","name":"\u9b4f\u4e1e\u9d3b"},"D3-0":{"rname":"\u5ee2\u7968","rid":"D3","no":"0","dept":"na","name":"na"},"D3-1":{"rname":"\u751f\u8fb2\u5b78\u9662\u5b78\u751f\u6703\u6703\u9577","rid":"D3","no":"1","dept":"\u8fb2\u7d93\u4e8c","name":"\u5433\u6c76\u931a"},"D3-2":{"rname":"\u751f\u8fb2\u5b78\u9662\u5b78\u751f\u6703\u6703\u9577","rid":"D3","no":"2","dept":"\u8fb2\u85dd\u4e8c","name":"\u5433\u5764\u80b2"},"D4-0":{"rname":"\u5ee2\u7968","rid":"D4","no":"0","dept":"na","name":"na"},"D4-1":{"rname":"\u7ba1\u9662\u5b78\u751f\u6703\u9577","rid":"D4","no":"1","dept":"\u6703\u8a08\u4e8c","name":"\u66f8\u5176\u6690"},"D5-0":{"rname":"\u5ee2\u7968","rid":"D5","no":"0","dept":"na","name":"na"},"D5-1":{"rname":"\u6cd5\u5b78\u9662\u5b78\u751f\u6703\u9577","rid":"D5","no":"1","dept":"\u6cd5\u5f8b\u4e8c","name":"\u674e\u5fc3\u6bc5"},"D5-2":{"rname":"\u6cd5\u5b78\u9662\u5b78\u751f\u6703\u9577","rid":"D5","no":"2","dept":"\u6cd5\u5f8b\u4e00","name":"\u6797\u5b9b\u6f7c"}}';
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
		if ($checkmulti[1]=="B") {
			
		}else{
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