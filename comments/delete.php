<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>删除评论 - 杭电英语论坛</title>
</head>
<body>
	<?php require_once("../inc/head.php"); ?>
	<form action="destroy.php" method="post">
		<input type="hidden" name="id" value = <?php echo $_GET['id']; ?>>
		<input type="hidden" name="post_id" value = <?php echo $_GET['post_id']; ?>>
		是否删除ID为<?php echo $_GET['id'] ?>的评论?
		<input type="submit" value="确定">
	</form> 
</body>
</html>

<style type="text/css">
form
{
    width:260px;
    margin-top: 15%;
    margin-left: auto;
    margin-right: auto;
}
</style>