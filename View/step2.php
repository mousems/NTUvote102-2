<?php
// input c_id_arr for c_id list
// input c_name_arr for c_name list
// input title title_en for title
// input auth_key , r_id

if (!isset($c_id_arr) || !isset($c_name_arr) || !isset($title)) {
  header("vote-auth");
}

@session_start();
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
    <link href="/css/all.css" rel="stylesheet" type="text/css" />
    <script src="/js/modernizr.js" type="text/javascript"></script>
  </head>
  <body class='step2'>
    <div class='wrapper'>
      <div class='content'>
        <form action="vote_submit_single" accept-charset="UTF-8" class="step2-form" method="post"><hgroup>
          <h1>102-2 NTU Voting</h1>
          <h1><?=$title;?></h1>
          <h2><?=$title_en;?></h2>
        </hgroup>
        <input value="Submit" class="button" type="submit" />

        <input name="authkey" id="authkey" type="hidden" value="<?=$authkey;?>"/>

        <input name="r_id" id="r_id" type="hidden" value="<?=$r_id;?>"/>

        <input name="selection" id="selection" type="hidden" value="0"/>



<?php

        foreach ($c_id_arr as $c_id_key => $c_id_value) {

?>

        <section class='candidate selection'>
          <div class='id'><?=$c_id_key;?></div>
          <div class='pic'>
            <div class='img' style='background-image: url(/images/cimg/<?=$c_id_value;?>.jpg)'></div>
          </div>
          <h1 class='name'><?=$c_name_arr[$c_id_key];?></h1>
          <div class='elect'></div>
        </section>


<?php
        }
?>
        </form>
      </div>
    </div>
    <script src="/js/all.js" type="text/javascript"></script>
  </body>
</html>
