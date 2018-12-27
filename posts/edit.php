<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>修改帖子 - 杭电英语论坛 </title>
</head>
<body>
	<?php 
		require_once("../inc/head.php");
		require_once("../inc/db.php");		//连接数据库
		$query = $db->prepare("select * from posts where post_id = :id");
		$query->bindValue(":id",$_GET['id'],PDO::PARAM_INT);
		$query->execute();
		$post = $query->fetchobject();
	 ?>
	<h1>编辑帖子: <?php echo $post->post_id ?></h1>

	<form action="update.php" method="post" enctype="multipart/form-data">		
		<input type="hidden" name="id" value =<?php echo $_GET['id'] ?> />
		<input type="hidden" name="user_id" value =<?php echo $post->user_id ?> />
		<label for="title">标题</label>
		<input type="text" name="title" value=<?php echo $post->title ?> />
		<br/>
		<label for="body">内容</label>
		<textarea name="body"><?php echo $post->body; ?>
		</textarea>
		<br/>
		<label for="catalog">分类</label>
		<select name="catalog">
			<option value="practice">练习</option>;
			<option value="lesson">课程</option>;
			<option value="QandA">问答</option>;
		</select><br/>
		<img src="<?php echo $post->pic; ?>"><br/>
		<input type="hidden" name="pic" value =<?php echo $_SERVER["DOCUMENT_ROOT"].substr($post->pic, 21); ?> />
		<label for="file">文件名(gif,jpg,png且小于2MB)：</label>
	    <input type="file" name="file" id="file"><br/>
	    <input type="hidden" name="delpic" value='0'/>
	    <?php if($post->pic){ ?>
		 是否删除图片?
		 <select name="delpic">
    		<option value="0">不删</option>;
    		<option value="1">删除</option>;
    	</select><br/>
		<?php } ?>
		<input type="submit" value="提交" />
	</form>

</body>
</html>