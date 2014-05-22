
<?php

	require_once("function.php");
	/**
	* 
	*/
	class TicketSubmit {
		
		function __construct(){
			global $loggerip;
			$result = file_get_contents("https://".$loggerip."/testlink");

			if (!preg_match("/ok/" , $result)) {
				$this->errorMsg("無法連線到伺服器!cannot connect to server.");
			}

		}


		private function StoreTicket($selection , $r_id){
			global $ServerName;

			file_put_contents("/var/log/NTUticket/$r_id", date("Y.m.d H:i:s ").$selection."\n" , FILE_APPEND);
			NTUVoteLog("StoreTicket:".$r_id.":".$selection);

			$path = "/var/log/NTUticket/"; 
			chdir($path);
			exec('git config user.email "mousems.kuo@gmail.com"');
			exec('git config user.name "$ServerName"');
			exec("git add $r_id");  
			exec("git commit -m'submit ticket by ".$ServerName." automatically , selection:".$selection."'");

		}

		function Ticket_Single_Submit($selection , $r_id){
			global $loggerip;



			$c_id = $r_id."-".$selection;
			$result = file_get_contents("https://".$loggerip."/Controller/LoggerServer.php?action=submitTicketSingle&step=".$_SESSION['step']."&password=".$_SESSION['password']."&cid=".$c_id);			


			if ($result=="1") {
				$_SESSION['step']++;
				$this->StoreTicket($selection , $r_id);

				$authkey = get_keyindex($_SESSION['step'].$_SESSION['password']);

				header("Location:vote?auth=".$authkey);

			}else{
				NTULog("Ticket_Single_Submit remote response not '1' ");
			}
		}
	}

?>