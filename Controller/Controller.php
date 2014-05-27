<?php
	class Controller {
        function view($file,$data=false){
			header('X-Frame-Options:DENY');
			require Views_DIR.$file.'.php';
			require Views_DIR.'foot.php';
        }
	}
?>
