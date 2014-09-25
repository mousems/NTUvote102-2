<?php
// input c_id_arr for c_id list
// input c_name_arr for c_name list
// input title title_en for title
// input auth_key , r_id

if (!isset($c_id_arr) || !isset($c_name_arr) || !isset($title)) {
  header("Location:vote-auth");
}

@session_start();
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
    <script src="/js/modernizr.js" type="text/javascript"></script>
  </head>
  <body class='step3'>
    <div class='wrapper'>
      <div class='content'>
        <form action="vote_submit_multi" accept-charset="UTF-8" class="step3-form" method="post"><hgroup>
          <h1>NTU Vote 102-2</h1>
          <h1>學生代表社科院選區補選</h1>
          <h1><?=$title;?></h1>
          <h2><?=$title_en;?></h2>

          <p>✓ 同意/Approve；✕ 不同意/Reject；- 無意見/Neutral </p>
          <p>同額競選：每個候選人都可以選贊成或是反對。</p>
          <p>Uncontested election: You may approve or reject individual candidate. </p>
        </hgroup>

        <input value="Submit" class="button" type="submit" />

        <input name="authkey" id="authkey" type="hidden" value="<?=$authkey;?>"/>

        <input name="r_id" id="r_id" type="hidden" value="<?=$r_id;?>"/>


<?php

        foreach ($c_id_arr as $c_id_key => $c_id_value) {

?>


        <section class='candidate'>
          <div class='id'><?=$c_id_key;?></div>
          <div class='opinions'>
            <label>
              <input name="selection_<?=$c_id_value;?>" value="1" type="radio" />
              <div class='agree'>✓</div>
            </label>
            <label>
              <input name="selection_<?=$c_id_value;?>" value="0" checked="checked" type="radio" />
              <div class='none'>-</div>
            </label>
            <label>
              <input name="selection_<?=$c_id_value;?>" value="-1" type="radio" />
              <div class='disagree'>✕</div>
            </label>
          </div>
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
