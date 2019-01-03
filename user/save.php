<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>注册 - 杭电英汉辞典</title>
</head>
<body>
	<?php 
		require_once("../inc/db.php");
		require_once("../inc/common.php");
		$sql="select * from users where username = :username";
		$array = array(':username' => $_POST['username']);
		$query=execute($sql,$db,$array);
		$post=$query->fetchobject();
		if($post){
			echo "已存在相同用户名,请另选用户名";
		}
		else if($_POST['password']!=$_POST['repwd']){
			echo "两次输入密码输入不一致";
		}
		else if($_POST['password']==""){
			echo "密码不能为空";
		}
		else{
			if($_POST['birthMonth']/10<1) $_POST['birthMonth']="0".$_POST['birthMonth'];
			if($_POST['birthDay']/10<1) $_POST['birthDay']="0".$_POST['birthDay'];
			$birth=$_POST['birthYear']."-".$_POST['birthMonth']."-".$_POST['birthDay'];
			$created_at=time();
			$sql = "insert into users (username,password,tel,mail,nickname,gender,birth,profile,created_at) values(:username,:password,:tel,:mail,:nickname,{$_POST['gender']},:birth,:profile,{$created_at})";
			$array = array(':username' => $_POST['username'], ':password' => md5("im".$_POST['password']."salt"),':birth' => $birth,':tel' => $_POST['tel'],':mail' => $_POST['mail'],':nickname' => $_POST['nickname'],':profile' => $_POST['profile']);
			$bool=execute($sql,$db,$array)==false?0:1;
			error_redirect("../",$bool);
		}
	 ?>
</body>
