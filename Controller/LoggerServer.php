<?php
require_once("Vote.php");

if (isset($_GET['action']) && isset($_GET['step']) && isset($_GET['password'])) {
	switch ($_GET['action']) {
		case 'getTicket':
			$a = new Vote;
			$result = $a->Check_ticket($_GET['step'],$_GET['password']);
			if ($result==1) {
				$result = $a->Lock_ticket($_GET['password']);
				if ($result==1) {
					echo 1;
				}else{
					echo 0;
				}
			}else{
				echo 0;
			}
			break;
		
		case 'submitTicketSingle':
			if (!isset($_GET['cid'])) {

				header('HTTP/1.0 403 Forbidden');
			}else{

				$a = new Vote;

				$result = $a->submitTicketSingle($_GET['step'] ,$_GET['password'] ,$_GET['cid']);

				if ($result==1) {
					echo 1;
				}else{
					echo 0;
				}
			}


			break;

		case 'submitTicketMulti':
			if (!isset($_GET['step']) || !isset($_GET['password']) || !isset($_GET['resultlist'])) {

				header('HTTP/1.0 403 Forbidden');
			}else{

				$a = new Vote;

				$result = $a->submitTicketMulti($_GET['step'] ,$_GET['password'] ,$_GET['resultlist']);
				
				if ($result==1) {
					echo 1;
				}else{
					echo 0;
				}
			}
			break;
		default:
			header('HTTP/1.0 403 Forbidden');
			break;
	}
}else{
	header('HTTP/1.0 403 Forbidden');
}


?>