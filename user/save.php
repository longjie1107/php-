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
		$query=$db->prepare($sql);
		$query->bindValue(":username",$_POST['username'],PDO::PARAM_STR);
		$query->execute();
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
			$sql2 = "insert into users (username,password,tel,mail,nickname,gender,birth,profile,created_at) values(:username,:password,:tel,:mail,:nickname,{$_POST['gender']},:birth,:profile,{$created_at})";
			$query = $db->prepare($sql2);
			$query->bindValue(":username",$_POST['username'],PDO::PARAM_STR);
			$query->bindValue(":password",md5("im".$_POST['password']."salt"),PDO::PARAM_STR);
			$query->bindValue(":birth",$birth,PDO::PARAM_STR);
			$query->bindValue(":tel",$_POST['tel'],PDO::PARAM_INT);
			$query->bindValue(":mail",$_POST['mail'],PDO::PARAM_STR);
			$query->bindValue(":nickname",$_POST['nickname'],PDO::PARAM_STR);
			$query->bindValue(":profile",$_POST['profile'],PDO::PARAM_STR);
			if(!$query->execute()){
				print_r($query->errorInfo());	
			}else{
				http_redirect_to("../");
			}
		}
	 ?>
</body>
