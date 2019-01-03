<?php 
	require_once("../inc/common.php");	//连接函数库
	require_once("../inc/db.php");		//连接数据库
	$sql = "insert into comments (user_id,user_nickname,post_id,body,created_at) values(:user_id,:user_nickname,:post_id,:body,:time)";	
	$array = array(':user_id' => $_POST['user_id'], ':user_nickname' => $_POST['user_nickname'],':post_id' => $_POST['post_id'],':body' => $_POST['body'],':time' => time());
	$bool = execute($sql,$db,$array)==false?0:1;
	error_redirect("../posts/show.php?id=".$_POST['post_id'],$bool)
?>