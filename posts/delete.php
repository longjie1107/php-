<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>删除帖子 - 杭电英语论坛</title>
</head>
<body>
	<?php $id = $_GET['id']; ?>
	<?php require_once("../inc/head.php"); ?>
	<form action="destroy.php" method="post">
		<input type="hidden" name="id" value = <?php echo $id; ?>>
		是否删除ID为<?php echo $id ?>的帖子?
		<input type="submit" value="确定">
	</form> 
</body>
</html>