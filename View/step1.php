<?php
@session_start();
// session_destroy();
    if ($_SESSION['uid'] == NULL) {
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
  </head>
  <body class='step1'>
    <div class='wrapper'>
      <div class='content'>
        <form action="password_check" accept-charset="UTF-8" class="step1-form" method="post"><hgroup>

          <input name="step" id="step" type="hidden" value="1" />
          <h1>102-2 NTU Vote</h1>
        </hgroup>
        <fieldset><div class='input'>
          <div class='label'>
            授權碼 / Auth Code
          </div>
          <div class='passwords'>
            <input name="password1" id="password1" maxlength="4" autofocus="autofocus" autocomplete="off" type="text" />
            <span>-</span>
            <input name="password2" id="password2" maxlength="3" autocomplete="off" type="text" />
            <span>-</span>
            <input name="password3" id="password3" maxlength="3" autocomplete="off" type="text" />
          </div>
        </div>
        </fieldset>

        <fieldset class="buttons">
          <p>授權碼為十位亂數，僅第二位為數字，其餘為大寫英文字母。</p>
          <p>Auth code consists of 9 uppercase letters and ONLY 1 digit on the second place.</p>

          <input value="Proceed ›" class="button" type="submit" />
        </fieldset>


        </form>
      </div>
    </div>
    <script src="js/all.js" type="text/javascript"></script>
  </body>
</html>
