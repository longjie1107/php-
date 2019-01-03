<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>新增帖子-杭电英语论坛</title>
</head>
<body>
<?php require_once("../inc/head.php"); ?>
<h1>新帖子</h1>
<div id="middlepage">
	<form action="save.php" method="post" enctype="multipart/form-data">
		<label class="line" for="title">标题</label>
		<input class ="line" type="text" name="title" value="" /><br/>
		<input type="hidden" name="user_id" value =<?php echo $_SESSION['user_id']; ?> />
		<input type="hidden" name="user_nickname" value =<?php echo $_SESSION['nickname']; ?> />
		<label id="content" class="line" for="body">内容</label>
		<textarea class="line" name="body"></textarea>
		<br/>
		<label class="line" for="catalog">分类</label>
		<select class="line" name="catalog">
			<option value="practice">练习</option>;
			<option value="lesson">课程</option>;
			<option value="QandA">问答</option>;
		</select><br/>
		<label class="line" for="file">听力资料(mp3且小于50MB)：</label>
	    <input class="line" type="file" name="file" class="file"><br>
		<input class="line" type="submit" value="提交" />
	</form>
</div>

</body>
</html>
<style type="text/css">
h1
{
	width: 1500px;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
}
#middlepage
{
	width: 500px;
	position: relative;
	left: 40%;
	top: 50px;
}
.line
{
	margin-bottom: 30px;
}
textarea
{
	position: relative;
	top: 10px;
	margin-bottom: 10px;
}
#content
{
	position: relative;
	bottom: 30px;
}
</style>