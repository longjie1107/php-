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
	$array = array(':username' => $_POST['username'], ':password'=>md5("im".$_POST['password']."salt"));
	$query=execute($sql,$db,$array);
	$post=$query->fetchobject();
	if($post&&$_SESSION["captcha"] == $captcha){
		echo "<h3>登陆成功</h3>";
		$_SESSION['admin']=true;	//该变量为true表示已登录
		$_SESSION['user_id']=$post->user_id;
		$_SESSION['nickname']=$post->nickname;
	}elseif (!$post) {
		echo "<h3>不存在该用户名或密码,用户名错误</h3>";
	}else{
		echo "<h3>验证码错误!</h3>";
	}
	echo "<br/><div id=\"a\"><a href=\"../\">点击返回首页</a></div>";
 ?>
 <style type="text/css">
h3
{
	width: 1500px;
	margin-top: 15%;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
}
#a
{
	width: 1500px;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
}
 </style>