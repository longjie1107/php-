 <?php
$ROOT="http:\\\\".$_SERVER['HTTP_HOST']; 
session_start();
if(!isset($_SESSION['admin'])){
	$_SESSION['admin']=NULL;
	$_SESSION['user_id']=NULL;
	$_SESSION['nickname']=NULL;//初始化变量
}
if(isset($_SESSION['admin']) && $_SESSION['admin'] === true){			//判断是否已登录,根据判断不同输出不同
	echo <<<EOF
	<div id="a">
		<a href="../user/show.php">{$_SESSION['nickname']}</a>,欢迎您!
		<a href="$ROOT/user/logout.php">注销</a>
	</div> <br/>
EOF;
}
else{
	echo <<<EOF
	<a class="head" href="$ROOT/user/register.php">注册</a>
	<a class="head" href="$ROOT/user/logging.php">登陆</a> 
EOF;
}
echo <<<EOF
	<a class="head1" href="$ROOT">首页</a>
	<a class="head1" href="$ROOT/posts/index.php?catalog=all">帖子</a>
EOF;
 ?>

 <style type="text/css">
.head1
{
	float: left;
	width: 50px;
}
.head
{
	float: right;
	width: 50px;
}
#a
{
	float: right;
	width: 150px;
}
 </style>
