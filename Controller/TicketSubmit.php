
<?php

	ini_set('memory_limit', '256M');
	require_once("function.php");
	/**
	* 
	*/
	class TicketSubmit {
		
		function __construct(){
			global $loggerip;
			NTULog("https://".$loggerip."/testlink");
			$result = file_get_contents("https://".$loggerip."/testlink");

			if (!preg_match("/ok/" , $result)) {
				$this->errorMsg("無法連線到伺服器!cannot connect to server.");
			}

		}


		private function StoreTicket_single($selection , $r_id){
			global $ServerName;

			file_put_contents("/var/log/NTUticket/$r_id", date("Y.m.d H:i:s ").$selection."\n" , FILE_APPEND);
			NTUVoteLog("StoreTicket:".$r_id.":".$selection);

			$path = "/var/log/NTUticket/"; 
			chdir($path);
			exec('git config user.email "mousems.kuo@gmail.com"');
			exec('git config user.name "$ServerName"');
			exec("git add $r_id");  
			exec("git commit -m'submit ticket by ".$ServerName." automatically , ".$r_id."-".$selection."'");

		}

		private function StoreTicket_multi($resultlist , $r_id){
			global $ServerName;


			foreach ($resultlist as $result_cid => $result_value) {
				# code...

				file_put_contents("/var/log/NTUticket/$r_id", date("Y.m.d H:i:s ").$result_cid.":".$result_value."\n" , FILE_APPEND);
				NTUVoteLog("StoreTicket:".$result_cid.":".$result_value);

				$path = "/var/log/NTUticket/"; 
				chdir($path);
				exec('git config user.email "mousems.kuo@gmail.com"');
				exec('git config user.name "$ServerName"');
				exec("git add $r_id");  
				exec("git commit -m'submit ticket by ".$ServerName." automatically , ".$result_cid.":".$result_value."'");




			}





		}



		function Ticket_Single_Submit($selection , $r_id){
			global $loggerip;



			$c_id = $r_id."-".$selection;
			$result = file_get_contents("https://".$loggerip."/Controller/LoggerServer.php?action=submitTicketSingle&step=".$_SESSION['step']."&password=".$_SESSION['password']."&cid=".$c_id);			


			if ($result=="1") {
				$_SESSION['step']++;
				$this->StoreTicket_single($selection , $r_id);

				$authkey = get_keyindex($_SESSION['salt'].$_SESSION['step'].$_SESSION['password']);

				header("Location:vote?auth=".$authkey);

			}else{
				NTULog("Ticket_Single_Submit remote response not '1' ");
			}
		}

		function Ticket_Multi_Submit($post){
			global $loggerip;

			$votepage_main = new VotePage_main;
			$candidate_count = sizeof($votepage_main->getCidList($_SESSION['step'],$_SESSION['password']));


			if ($candidate_count ==0) {
				NTUVoteLog("Ticket_Multi_Submit candidate_count=0");
				$votepage_main->errorMsg("送出錯誤。Error.");
				return 0;
			}


			$candidate_select_id = array();
			$candidate_select_result = array();
			for ($i=1; $i <= $candidate_count; $i++) { 
				$optionid = "selection_".$post['r_id']."-".$i;
				array_push($candidate_select_id, $optionid);
				$candidate_select_result[$post['r_id']."-".$i] = $post[$optionid];
			}

			NTULog("Ticket_Multi_Submit - candidate_select_result:".json_encode($candidate_select_result));
			NTULog("Ticket_Multi_Submit - candidate_select_id:".json_encode($candidate_select_id));
			$resultlist = implode(",", $candidate_select_result);

			$result = file_get_contents("https://".$loggerip."/Controller/LoggerServer.php?action=submitTicketMulti&step=".$_SESSION['step']."&password=".$_SESSION['password']."&resultlist=".$resultlist);			


			if ($result=="1") {
				$_SESSION['step']++;
				$this->StoreTicket_multi($candidate_select_result , $post['r_id']);

				$authkey = get_keyindex($_SESSION['salt'].$_SESSION['step'].$_SESSION['password']);

				header("Location:vote?auth=".$authkey);

			}else{
				NTULog("Ticket_Single_Submit remote response not '1' ");
			}
		}
	}

?>