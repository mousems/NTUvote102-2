<?php
	class Controller {
        function view($file,$data=false){
			require Views_DIR.$file.'.php';
        }
	}
?>