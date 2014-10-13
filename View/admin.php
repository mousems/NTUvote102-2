<?php
@session_start();
// session_destroy();
    if ($_SESSION['admin'] != "1") {
        header("Location:/");
    }
?>
<!DOCTYPE html>
<html lang='zh-tw'>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta content='width=device-width, initial-scale=1.0, user-scalable=no' name='viewport'>
    <meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible'>
    <title>NTU Vote</title>
    <link href="css/all.css" rel="stylesheet" type="text/css" />
    <script src="js/modernizr.js" type="text/javascript"></script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-35851793-5', 'mousems.com');
      ga('send', 'pageview');

    </script>
  </head>
  <body class='step1'>
    <div class='wrapper'>
      <div class='content'>
        <form action="" accept-charset="UTF-8" class="step1-form" method="post"><hgroup>
          <h1>102-2 NTU Vote</h1>
          <p><?=base64_decode($_SESSION['realname']);?></p>
        </hgroup>
        <fieldset><div class='input'>
          <div class='passwords'>
            <?php

              $vote_username=str_replace("staff", "vote", $_SESSION['username']);

              if (file_exists("/var/log/NTUvote/stat/".$vote_username)) {
                
                $content = file_get_contents("/var/log/NTUvote/stat/".$vote_username);

                $content = explode("\n", $content);
                

                for ($i=0; $i < 5; $i++) { 
                  echo  "<p>".array_pop($content)."</p>";
                }



              }else{
                echo "目前沒有記錄存在。";
              }
            ?>
          </div>
        </div>
        </fieldset>
        <fieldset class="buttons"><input value="reload" class="button" type="submit" />
        </fieldset>
        </form>
      </div>
    </div>
    <script src="js/all.js" type="text/javascript"></script>
  </body>
</html>
