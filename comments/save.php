<?php 
	require_once("../inc/common.php");	//连接函数库
	require_once("../inc/db.php");		//连接数据库
	//还未实现识别当前用户
	$sql = "insert into comments (user_id,user_nickname,post_id,body,created_at) values(:user_id,:user_nickname,:post_id,:body,:time)";	
	$query = $db->prepare($sql);
	$query->bindValue(":user_id",$_POST['user_id'],PDO::PARAM_STR);
	$query->bindValue(":user_nickname",$_POST['user_nickname'],PDO::PARAM_STR);
	$query->bindValue(":post_id",$_POST['post_id'],PDO::PARAM_INT);
	$query->bindValue(":body",$_POST['body'],PDO::PARAM_STR);
	$query->bindValue(":time",time(),PDO::PARAM_INT);
	if(!$query->execute()){
		print_r($query->errorInfo());	
	}else{
		http_redirect_to("../posts/show.php?id=".$_POST['post_id']);
	}
?>