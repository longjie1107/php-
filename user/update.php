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
	$array = array(":birth" => $birth, ":tel"=>$_POST['tel'],":mail"=>$_POST['mail'],":nickname"=>$_POST['nickname'],":profile"=>$_POST['profile'],":id"=>$_SESSION['user_id']);
	$_SESSION['nickname'] = $_POST['nickname'];
	execute($sql,$db,$array);
	//更新帖子表
	$sql="update posts set user_nickname=:nickname where user_id=:id";
	$array = array(":nickname"=>$_POST['nickname'],":id"=>$_SESSION['user_id']);
	execute($sql,$db,$array);
	//更新评论表
	$sql="update comments set user_nickname=:nickname where user_id=:id";
	$array = array(":nickname"=>$_POST['nickname'],":id"=>$_SESSION['user_id']);
	$bool = execute($sql,$db,$array)==false?0:1;
	error_redirect('show.php',$bool)
?>