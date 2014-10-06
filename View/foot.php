<HR>

<?php
if (isset($_SESSION['realname'])) {
	if ($_SESSION['admin']==1) {
		$footinfo = base64_decode($_SESSION['realname'])." - <a href='/admin'>管理員</a> |";
		# code...
	}else{

		$footinfo = base64_decode($_SESSION['realname'])." - 使用者 | ";
	}
}else{
	$footinfo="";
}
?>

<p><?=$footinfo;?> NTUvote102-2 | 國立臺灣大學學生會選舉罷免執行委員會</p>
