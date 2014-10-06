<?php
	@session_start();

	define('DS', DIRECTORY_SEPARATOR);
	define('APP_DIR',dirname(__FILE__));
	define('Models_DIR', APP_DIR.DS.'Model'.DS);
	define('Controllers_DIR', APP_DIR.DS.'Controller'.DS);
	define('Views_DIR', APP_DIR.DS.'View'.DS);

    require_once('host-config.php');
    date_default_timezone_set("Asia/Taipei");
    require_once(Controllers_DIR.'function.php');
    require_once(Controllers_DIR.'Controller.php');
    require_once(Controllers_DIR.'Vote.php');
    require_once(Controllers_DIR.'Vote_page.php');
    require_once(Controllers_DIR.'TicketSubmit.php');
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

	NTULog("now on URL:".$e_REDIRECT_URL[0]);


	$value1 = "2014.10.15 09:00:00";
	// $value1 = "2014.06.12 16:46:00";
	preg_match("/([\d]+)\.([\d]+)\.([\d]+)\s([\d]+)\:([\d]+)\:([\d]+)/", $value1 , $matches);

	$settime_from = mktime($matches[4],$matches[5],$matches[6],$matches[2],$matches[3],$matches[1]);
	
	$value2 = "2014.10.15 17:00:00";
	// $value2 = "2014.06.12 17:20:15";
	preg_match("/([\d]+)\.([\d]+)\.([\d]+)\s([\d]+)\:([\d]+)\:([\d]+)/", $value2 , $matches);

	$settime_end = mktime($matches[4],$matches[5],$matches[6],$matches[2],$matches[3],$matches[1]);
	
	if (date("U") > $settime_from && date("U") < $settime_end ) {
		
		
	}else{
		$e_REDIRECT_URL[0] = 'timeout';
	}

	switch ($e_REDIRECT_URL[0]) {
		case 'testlink':
			echo "ok";
			break;


		case 'vote-auth':
			//page for input password
			$_SESSION['password'] = "";
			$_SESSION['step'] = "";
			$Controller->view("step1");
			break;

		case 'admin':
			//page for input password
			if ($_SESSION['admin']==1) {
				$Controller->view("admin");
			}else{
				header("location:/");
			}
			
			break;
		case 'success':
			//page for input password


			$username = $_SESSION['username'];
			$username = explode("-", $username);


			file_put_contents("/var/log/NTUvote/stat/".$username[0], date("Y.m.d H:i:s")."\n" , FILE_APPEND);

			$_SESSION['password'] = "";
			$_SESSION['step'] = "";
			$Controller->view("step0");
			break;
		case 'password_check':
			//page for password form post destination
			$votepage = new Vote_pwd_check;
			$votepage->checkpassword($_POST);
			break;

		case 'vote':
			//page for voting
			NTULog("password ".$_SESSION['password']." step[1,".sizeof(Get_votelist($_SESSION['password']))."]");
			if (!isset($_SESSION['password'])) {
				NTULog("vote page authkey not match for SESSION data.");
				header("Location:vote-auth");
			}
			$authkey = get_keyindex($_SESSION['step'].$_SESSION['password']);
			NTULog("index vote password:".$_SESSION['password']);

			if ($authkey!=$_GET['auth']) {
				NTULog("vote page authkey not match for SESSION data.");
				header("Location:vote-auth");
			}else{
				//pass csrf

				if (sizeof(Get_votelist($_SESSION['password'])) < $_SESSION['step'] ){
					header("Location:success");
					return 0;
				}
				$vote_r_id = Get_votelist($_SESSION['password']);
				$vote_r_id = $vote_r_id[$_SESSION['step']];
				//vote region

				$votepage = new VotePage_main;

				if (substr($vote_r_id, 0,1) == "C") {
					//multi
					$votepage->vote_multi($vote_r_id);
				}else{
					//single
					$votepage->vote_single($vote_r_id);
				}





			}

			break;

		case 'vote_submit_single':			
			NTULog(json_encode($_POST));

			//page for vote result form post destination
			if (!isset($_SESSION['password'])) {
				NTULog("vote page authkey not match for SESSION data.");
				header("Location:vote-auth");
			}
			NTULog($_SESSION['step']."/".$_SESSION['password']."/".$_POST['r_id']);
			$authkey = get_keyindex($_SESSION['step'].$_SESSION['password'].$_POST['r_id']);
			if ($authkey!=$_POST['authkey']) {
				NTULog("vote_submit_single page authkey not match for SESSION data.");
				header("Location:vote-auth");
			}else{
				if (isset($_POST['selection'])) {
					

					if (preg_match("/^\d+$/", $_POST['selection'])==0) {
						NTULog("vote_submit page selection variables not match for integer.");
						$selection = 0;						
					}else{
						$selection = $_POST['selection']; // int
					}

				}else{
					$selection = 0;
				}



				$thcketsubmit = new TicketSubmit;
				$thcketsubmit->Ticket_Single_Submit($selection , $_POST['r_id']);
				
			}
			break;


		case 'vote_submit_multi':
			NTULog(json_encode($_POST));
			//page for vote result form post destination
			if (!isset($_SESSION['password'])) {
				NTULog("vote page authkey not match for SESSION data.");
				header("Location:vote-auth");
			}
			$authkey = get_keyindex($_SESSION['step'].$_SESSION['password'].$_POST['r_id']);
			if ($authkey!=$_POST['authkey']) {
				NTULog("vote_submit_multi page authkey not match for SESSION data.");
				header("Location:vote-auth");
			}else{

					NTULog("Ticket_Multi_Submit _POST:".json_encode($_POST));
					$thcketsubmit = new TicketSubmit;
					$thcketsubmit->Ticket_Multi_Submit($_POST);
				

				
			}
			break;
		case 'login':
			$user = new User_Model;
			$user->Login($_POST);
			break;

		case 'logout':

			session_destroy();
			header("location:/");
			break;
		case 'timeout':
		    $Controller->view("index");
			break;
		case '':
			$Controller->view("index");

			// $user = new User_Model;
			// $user->Login(array("username"=>"vote1" , "password"=>"p69KBCggy"));

			break;
		default:
			
	}


?>




