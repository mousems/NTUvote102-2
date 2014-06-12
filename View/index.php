<!DOCTYPE html>
<html class='han-la' lang='zh-tw'>
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
        <form action="login" accept-charset="UTF-8" class="step1-form" method="post"><hgroup>
          <h1>102-2 NTU Vote</h1>
          <p>若您看到此頁面，代表目前不是有效的選舉日期內。</p>
          <p>研協代表、社科院會長、管院會長</p><p>補選時間：2014/06/13 9:00~17:00</p>
          <p>現在時間：<?=date("Y.m.d H:i:s");?></p>
        </hgroup>
        <!--fieldset>
          <div class='input'>
            <div class='label'>
              使用者 / Username
            </div>
            <div class='passwords'>
              <input name="username" id="username" maxlength="12" autofocus="autofocus" autocomplete="off" type="text" />
            </div>
            <br />

            <div class='label'>
              密碼 / Password
            </div>
            <div class='passwords'>
              <input name="password" id="password" maxlength="12" autocomplete="off" type="password" />
            </div>

          </div>
          <fieldset class="buttons"><input value="Login ›" class="button" type="submit" />
        </fieldset-->
        </form>
      </div>
    </div>
    <script src="js/all.js" type="text/javascript"></script>
  </body>
</html>
