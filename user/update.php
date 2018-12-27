<?php 
	require_once("../inc/db.php");
	require_once("../inc/common.php");
	session_start();
	if($_POST['birthMonth']/10<1) $_POST['birthMonth']="0".$_POST['birthMonth'];
	if($_POST['birthDay']/10<1) $_POST['birthDay']="0".$_POST['birthDay'];
	$birth=$_POST['birthYear']."-".$_POST['birthMonth']."-".$_POST['birthDay'];
	$created_at=time();
	//更新用户表
	$sql = "update users set tel=:tel,mail=:mail,nickname=:nickname,gender={$_POST['gender']},birth=:birth,profile=:profile where user_id=:id";
	$query = $db->prepare($sql);
	$query->bindValue(":birth",$birth,PDO::PARAM_STR);
	$query->bindValue(":tel",$_POST['tel'],PDO::PARAM_INT);
	$query->bindValue(":mail",$_POST['mail'],PDO::PARAM_STR);
	$query->bindValue(":nickname",$_POST['nickname'],PDO::PARAM_STR);
	$query->bindValue(":profile",$_POST['profile'],PDO::PARAM_STR);
	$query->bindValue(":id",$_SESSION['user_id'],PDO::PARAM_INT);
	if(!$query->execute()){
		print_r($query->errorInfo());	
	}
	//更新帖子表
	$sql="update posts set user_nickname=:nickname where user_id=:id";
	$query = $db->prepare($sql);
	$query->bindValue(":nickname",$_POST['nickname'],PDO::PARAM_STR);
	$query->bindValue(":id",$_SESSION['user_id'],PDO::PARAM_INT);
	if(!$query->execute()){
		print_r($query->errorInfo());	
	}
	//更新评论表
	$sql="update comments set user_nickname=:nickname where user_id=:id";
	$query = $db->prepare($sql);
	$query->bindValue(":nickname",$_POST['nickname'],PDO::PARAM_STR);
	$query->bindValue(":id",$_SESSION['user_id'],PDO::PARAM_INT);
	if(!$query->execute()){
		print_r($query->errorInfo());	
	}else{
		$_SESSION['nickname']=$_POST['nickname'];
		http_redirect_to("show.php");
	}
?>