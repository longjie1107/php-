<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>修改帖子 - 杭电英语论坛 </title>
</head>
<body>
	<?php 
		require_once("../inc/head.php");
		require_once("../inc/db.php");		//连接数据库\
		require_once("../inc/common.php");
		$sql = "select * from posts where post_id = :id";
		$array = array(':id' => $_GET['id']);
		$query = execute($sql,$db,$array);
		$post = $query->fetchobject();
	 ?>
	<h1>编辑帖子: <?php echo $post->post_id ?></h1>

	<form action="update.php" method="post" enctype="multipart/form-data">		
		<input type="hidden" name="id" value =<?php echo $_GET['id'] ?> />
		<input type="hidden" name="user_id" value =<?php echo $post->user_id ?> />
		<div id="middlepage">
			<label class="line" >标题</label>
			<input class="line" type="text" name="title" value=<?php echo $post->title ?> />
			<br/>
			<label class="line" id="content" for="body">内容</label>
			<textarea class="line" name="body"><?php echo $post->body; ?>
			</textarea>
			<br/>
			<label class="line" for="catalog">分类</label>
			<select class="line" name="catalog">
				<option value="practice">练习</option>;
				<option value="lesson">课程</option>;
				<option value="QandA">问答</option>;
			</select><br/>
			<audio class="line" src="<?php echo $post->pic; ?>" controls></audio><br/>
			<input class="line" type="hidden" name="pic" value =<?php echo $_SERVER["DOCUMENT_ROOT"].substr($post->pic, 21); ?> />
			<label class="line" for="file">听力资料(mp3且小于50MB)：</label>
		    <input class="line" type="file" name="file" id="file"><br/>
		    <input class="line" type="hidden" name="delpic" value='0'/>
		    <?php if($post->pic){ ?>
			 是否删除音频?
			 <select class="line" name="delpic">
	    		<option value="0">不删</option>;
	    		<option value="1">删除</option>;
	    	</select><br/>
			<?php } ?>
			<input class="line" type="submit" value="提交" />
		</div>
		
	</form>

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