<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>新增帖子-杭电英语论坛</title>
</head>
<body>
<?php require_once("../inc/head.php"); ?>
<h1>新帖子</h1>
<form action="save.php" method="post" enctype="multipart/form-data">
	<label for="title">标题</label>
	<input type="text" name="title" value="" />
	<br/>
	<input type="hidden" name="user_id" value =<?php echo $_SESSION['user_id']; ?> />
	<input type="hidden" name="user_nickname" value =<?php echo $_SESSION['nickname']; ?> />
	<label for="body">内容</label>
	<textarea name="body"></textarea>
	<br/>
	<label for="catalog">分类</label>
	<select name="catalog">
		<option value="practice">练习</option>;
		<option value="lesson">课程</option>;
		<option value="QandA">问答</option>;
	</select><br/>
	<label for="file">文件名(gif,jpg,png且小于2MB)：</label>
    <input type="file" name="file" id="file"><br>
	<input type="submit" value="提交" />
</form>

</body>
</html>