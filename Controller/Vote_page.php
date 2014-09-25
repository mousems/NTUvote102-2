<?php
/**
*
*/
require_once("function.php");


class Vote_pwd_check {
	function __construct(){
		global $loggerip;
		$result = file_get_contents("https://".$loggerip."/testlink");

		if (!preg_match("/ok/" , $result)) {
			$this->errorMsg("無法連線到伺服器! Could not connect to server.");
		}

	}


	function checkpassword($post_data){
		global $loggerip;
		$password = $post_data['password1'].$post_data['password2'].$post_data['password3'];
		$password = strtoupper($password);

		$result=preg_match("/^([A-Z])(\d)[A-Z]{8}$/", $password , $matches);
		if ($result===1) {
		}else{
			$this->errorMsg("密碼格式錯誤！ Invalid password format.");
			header("Location:/vote-auth");
			return 0;
		}
		$result = file_get_contents("https://".$loggerip."/Controller/LoggerServer.php?action=getTicket&step=".$post_data['step']."&password=".$password);
		NTULog("getTicket:$result");

		$_SESSION['step'] = $post_data['step'];
		$_SESSION['password'] = $password;
		if ($result=="1") {
			header("Location:vote?auth=".get_keyindex($post_data['step'].$password));

		}else{

			$step_in_db = file_get_contents("https://".$loggerip."/Controller/LoggerServer.php?action=Get_Ticket_step&step=".$post_data['step']."&password=".$password);
			NTULog("https://".$loggerip."/Controller/LoggerServer.php?action=Get_Ticket_step&step=".$post_data['step']."&password=".$password);
			NTULog("step_in_db:$step_in_db");
			if ($step_in_db!=-1) {


				$_SESSION['step'] = (int)($step_in_db)+1;
				$_SESSION['password'] = $password;



				header("Location:vote?auth=".get_keyindex($_SESSION['step'].$_SESSION['password']));
			}else{

				$this->errorMsg("密碼認證失敗！ Login failed.");
				header("Location:/vote-auth");
				return 0;


			}





		}
	}

	function errorMsg($string) {
		header('Content-Type: text/html; charset=utf-8');
        echo '<noscript>'.$string.'</noscript>';
		echo '<script language="javascript">';
  	    echo 'alert("'.$string.'");';
  	    echo 'history.back();';
  	    echo '</script>';
	}

}






class VotePage_main {
	var $candidate_data , $region_data;



	function __construct(){
		global $candidate_data , $region_data;
		$candidate_data = new stdClass;
		$json='{"C1-1":{"rname":"\u5b78\u751f\u4ee3\u8868","rid":"C1","no":"1","dept":"\u570b\u767c\u78a9\u4e09","name":"\u5f90\u4f51\u6607"}}';
		$candidate_data = json_decode($json);


		$region_data = new stdClass;
		$json='{"C1":{"title":"\u793e\u6703\u79d1\u5b78\u9662\u5b78\u751f\u4ee3\u8868","title_en":"Student Representative of College of Social Sciences"}}';
		$region_data = json_decode($json);
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

	}

	function vote_single($r_id){


		global $candidate_data , $region_data;

		$c_id_arr = array();
		$c_name_arr = array();
		$authkey = get_keyindex($_SESSION['step'].$_SESSION['password'].$r_id);


		foreach ($candidate_data as $candidate_cid => $candidate_value) {
			if ($candidate_value->{'rid'} == $r_id and $candidate_value->{'no'}!=0) {
				$no = $candidate_value->{'no'};
				$c_id_arr[$no] = $candidate_cid;
				$c_name_arr[$no] = $candidate_value->{'name'};
			}
		}
		$title=$region_data->{$r_id}->{'title'};
		$title_en=$region_data->{$r_id}->{'title_en'};

		require("View/step2.php");
	}

	function vote_multi($r_id){

		global $candidate_data , $region_data;

		$c_id_arr = array();
		$c_name_arr = array();
		$authkey = get_keyindex($_SESSION['step'].$_SESSION['password'].$r_id);


		foreach ($candidate_data as $candidate_cid => $candidate_value) {
			if ($candidate_value->{'rid'} == $r_id and $candidate_value->{'no'}!=0) {
				$no = $candidate_value->{'no'};
				$c_id_arr[$no] = $candidate_cid;
				$c_name_arr[$no] = $candidate_value->{'name'};
			}
		}
		$title=$region_data->{$r_id}->{'title'};
		$title_en=$region_data->{$r_id}->{'title_en'};

		require("View/step3.php");
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


	function errorMsg($string) {
        echo '<noscript>'.$string.'</noscript>';
		echo '<script language="javascript">';
  	    echo 'alert("'.$string.'");';
  	    echo 'history.back();';
  	    echo '</script>';
	}


}
