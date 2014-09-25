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
		$json='{"C2-0":{"rname":"na","rid":"C2","no":"0","dept":"na","name":"na"},"C2-1":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"1","dept":"\u5927\u6c23\u78a9\u4e00","name":"\u9673\u6881\u653f"},"C2-2":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"2","dept":"\u6d77\u6d0b\u78a9\u4e00","name":"\u8607\u742c\u5a77"},"C2-3":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"3","dept":"\u96fb\u4fe1\u78a9\u4e00","name":"\u9ec3\u67cf\u5b87"},"C2-4":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"4","dept":"\u690d\u5fae\u78a9\u4e00","name":"\u76e7\u6f54"},"C2-5":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"5","dept":"\u7d93\u6fdf\u78a9\u4e00","name":"\u912d\u660e\u54f2"},"C2-6":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"6","dept":"\u5712\u85dd\u78a9\u4e00","name":"\u5289\u80b2\u52f3"},"C2-7":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"7","dept":"\u96fb\u5b50\u78a9\u4e00","name":"\u738b\u5247\u60df"},"C2-8":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"8","dept":"\u570b\u4f01\u78a9\u4e00","name":"\u95d5\u6109\u5a1f"},"C2-9":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"9","dept":"\u571f\u6728\u6240","name":"\u65bd\u6b63\u502b"},"C2-10":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"10","dept":"\u79d1\u6cd5\u78a9\u4e00","name":"\u9673\u6587\u8473"},"C2-11":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"11","dept":"\u570b\u767c\u78a9\u4e8c","name":"\u9127\u7dad\u8fb2"},"C2-12":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"12","dept":"\u96fb\u5b50\u78a9\u4e00","name":"\u5289\u4f73\u741b"},"C2-13":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"13","dept":"\u570b\u767c\u78a9\u4e8c","name":"\u66fe\u53cb\u5db8"},"C2-14":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"14","dept":"\u7378\u91ab\u78a9\u4e8c","name":"\u8303\u6b63\u4e00"},"C2-15":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"15","dept":"\u6a5f\u68b0\u78a9\u4e00","name":"\u5f35\u54f2\u7dad"},"C2-16":{"rname":"\u7814\u7a76\u751f\u4ee3\u8868","rid":"C2","no":"16","dept":"\u4eba\u985e\u78a9\u4e8c","name":"\u738b\u921e\u745c"},"D1-1":{"rname":"\u793e\u79d1\u9662\u5b78\u751f\u6703\u9577","rid":"D1","no":"1","dept":"\u653f\u6cbb\u4e8c","name":"\u8521\u627f\u7ff0"},"D4-1":{"rname":"\u7ba1\u9662\u5b78\u751f\u6703\u9577","rid":"D4","no":"1","dept":"\u6703\u8a08\u4e8c","name":"\u66f8\u5176\u6690"},"F1-1":{"rname":"\u6587\u5b78\u9662\u5b78\u751f\u6703\u9577","rid":"F1","no":"1","dept":"\u6b77\u53f2\u56db","name":"\u7fc1\u699b\u61b6"}}';
		$candidate_data = json_decode($json);


		$region_data = new stdClass;
		$json='{"A1":{"title":"\u5b78\u751f\u6703\u6703\u9577","title_en":"President of Student Association"},"B1":{"title":"\u6587\u5b78\u9662\u5b78\u751f\u4ee3\u8868","title_en":"Student Representative of College of Liberal Arts"},"B2":{"title":"\u7406\u5b78\u9662\u5b78\u751f\u4ee3\u8868","title_en":"Student Representative of College of Science"},"B3":{"title":"\u793e\u6703\u79d1\u5b78\u9662\u5b78\u751f\u4ee3\u8868","title_en":"Student Representative of College of Social Sciences"},"B4":{"title":"\u91ab\u5b78\u9662\u5b78\u751f\u4ee3\u8868","title_en":"Student Representative of College of Medicine"},"B5":{"title":"\u5de5\u5b78\u9662\u5b78\u751f\u4ee3\u8868","title_en":"Student Representative of College of Engineering"},"B6":{"title":"\u751f\u7269\u8cc7\u6e90\u66a8\u8fb2\u5b78\u9662\u5b78\u751f\u4ee3\u8868","title_en":"Student Representative of College of Bio-Resources & Agriculture"},"B7":{"title":"\u7ba1\u7406\u5b78\u9662\u5b78\u751f\u4ee3\u8868","title_en":"Student Representative of College of Management"},"B8":{"title":"\u516c\u5171\u885b\u751f\u5b78\u9662\u5b78\u751f\u4ee3\u8868","title_en":"Student Representative of College of Public Health"},"B9":{"title":"\u96fb\u6a5f\u8cc7\u8a0a\u5b78\u9662\u5b78\u751f\u4ee3\u8868","title_en":"Student Representative of College of EE & CS"},"B10":{"title":"\u6cd5\u5f8b\u5b78\u9662\u5b78\u751f\u4ee3\u8868","title_en":"Student Representative of College of Law"},"C1":{"title":"\u7814\u7a76\u751f\u5354\u6703\u6703\u9577","title_en":"President of Graduate Student Association"},"C2":{"title":"\u7814\u7a76\u751f\u5b78\u751f\u4ee3\u8868","title_en":"Student Representative of Graduate Student Association"},"D1":{"title":"\u793e\u6703\u79d1\u5b78\u9662\u5b78\u751f\u6703\u9577","title_en":"President of College of Social Sciences Student Association"},"D2":{"title":"\u5de5\u5b78\u9662\u5b78\u751f\u6703\u9577","title_en":"President of Engineering Student Association"},"D3":{"title":"\u751f\u7269\u8cc7\u6e90\u66a8\u8fb2\u5b78\u9662\u5b78\u751f\u6703\u6703\u9577","title_en":"President of College of Bio-Resources & Agriculture Student Association"},"D4":{"title":"\u7ba1\u7406\u5b78\u9662\u5b78\u751f\u6703\u9577","title_en":"President of College of Management Student Association"},"D5":{"title":"\u6cd5\u5f8b\u5b78\u9662\u5b78\u751f\u6703\u9577","title_en":"President of College of Law Student Association"},"F1":{"title":"\u6587\u5b78\u9662\u5b78\u751f\u6703\u9577","title_en":"President of Student Association"}}';
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
