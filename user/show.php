<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>个人信息 - 杭电英语论坛 </title>
</head>
<body>
	<?php 
		require_once("../inc/head.php");
		require_once("../inc/db.php");		//连接数据库
		$query = $db->prepare("select * from users where user_id = :id");
		$query->bindValue(":id",$_SESSION['user_id'],PDO::PARAM_INT);
		$query->execute();
		$user = $query->fetchobject();
	 ?>
	<h3>用户名: <?php echo $user->username ?></h3>
	<h3>昵称: <?php echo $user->nickname ?></h3>
	<h3>性别: <?php echo $user->gender ?></h3>
	<h3>邮箱: <?php echo $user->mail ?></h3>
	<h3>电话: <?php echo $user->tel ?></h3>
	<h3>权限: <?php echo $user->access ?></h3>
	<h3>生日: <?php echo $user->birth; ?></h3>
	<h3>注册时间: <?php echo date("Y-m-d",$user->created_at); ?></h3>
	<h3>简介: <?php echo $user->profile ?></h3>
	<a href="edit.php">编辑信息</a>
</body>
</html>