<?php
@session_start();
NTULog(json_encode($_SESSION));
    if ($_SESSION['uid'] == NULL) {
        header("Location:/");
    }
?>

<!DOCTYPE html>
<html lang='zh-tw'>
  <head>
    <meta charset='utf-8'>
    <meta content='width=device-width, initial-scale=1.0, user-scalable=no' name='viewport'>
    <meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible'>
    <title>NTU Voting</title>
    <link href="css/all.css" rel="stylesheet" type="text/css" />
    <script src="js/modernizr.js" type="text/javascript"></script>
  </head>
  <body class='step1'>
    <div class='wrapper'>
      <div class='content'>
        <form action="password_check" accept-charset="UTF-8" class="step1-form" method="post"><hgroup>

          <input name="step" id="step" type="hidden" value="1" />
          <h1>102-2 NTU Voting</h1>
        </hgroup>
        <fieldset><div class='input'>
          <div class='label'>
            Password
          </div>
          <div class='passwords'>
            <input name="password1" id="password1" maxlength="4" autofocus="autofocus" type="text" />
            <span>-</span>
            <input name="password2" id="password2" maxlength="3" type="text" />
            <span>-</span>
            <input name="password3" id="password3" maxlength="3" type="text" />
          </div>
        </div>
        </fieldset>
        <fieldset class="buttons"><input value="Proceed ›" class="button" type="submit" />
        </fieldset>
        </form>
      </div>
    </div>
    <script src="js/all.js" type="text/javascript"></script>
  </body>
</html>
