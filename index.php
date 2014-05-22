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

	switch ($e_REDIRECT_URL[0]) {
		case 'testlink':
			echo "ok";
			break;


		case 'vote-auth':
			//page for input password
			$Controller->view("step1");
			break;
		case 'password_check':
			//page for password form post destination
			$votepage = new Vote_pwd_check;
			$votepage->checkpassword($_POST);
			break;

		case 'vote':
			//page for voting
			break;

		case 'vote_submit':
			//page for vote result form post destination

			break;
		case 'login':
			$user = new User_Model;
			$user->Login($_POST);
			break;

		case 'logout':
			session_destroy();
			header("location:/");
			break;
		default:
			$Controller->view("index");
			break;
	}


?>




