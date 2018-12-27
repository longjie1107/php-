<meta charset="utf-8">
<?php 
	//接受用户登陆时提交的验证码
	session_start();
	$_SESSION['admin']=NULL;
	//1. 获取到用户提交的验证码
	$captcha = $_POST["captcha"];
	require_once("../inc/db.php");
	require_once("../inc/common.php");
	$sql="select * from users where username = :username and password = :password";
	$query=$db->prepare($sql);
	$query->bindValue(":username",$_POST['username'],PDO::PARAM_STR);
	$query->bindValue(":password",md5("im".$_POST['password']."salt"),PDO::PARAM_STR);
	$query->execute();
	$post=$query->fetchobject();
	if($post&&$_SESSION["captcha"] == $captcha){
		echo "登陆成功";
		$_SESSION['admin']=true;	//该变量为true表示已登录
		$_SESSION['user_id']=$post->user_id;
		$_SESSION['nickname']=$post->nickname;
	}elseif (!$post) {
		echo "不存在该用户名或密码,用户名错误";
	}else{
		echo "验证码错误!";
	}
	echo "<br/><a href=\"../\">点击返回首页</a>";
 ?>