<?php 
	require_once("../inc/db.php");		//连接数据库
	$query = $db->prepare("select * from posts where post_id = :post_id");
	$query->bindValue(":post_id",$_GET['id'],PDO::PARAM_INT);
	$query->execute();
	$post=$query->fetchobject();
 ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $post->title; ?></title>
</head>
<body>
	<?php 
		require_once("../inc/head.php"); 
	?>
	<h1><?php echo $post->title ?></h1>
	<h5>作者:<?php echo $post->user_nickname ?></h2>
	<p><?php echo $post->body ?></p>
	<img src="<?php echo $post->pic; ?>">
	<table border="1">
	    <caption><h1>评论列表</h1></caption>
	    <thead>
	      <tr>
	        <th>id</th>
	        <th>创建日期</th>
	        <th>内容</th>
	        <th>作者</th>
	        <?php 
	        	if(isset($_SESSION['user_id'])&&$_SESSION['user_id']===$post->user_id){
	        		echo "<th>操作</th>";	
	        	}
	         ?>     
	      </tr>
	    </thead>
	    <tbody>
			<?php 
				require_once("../inc/db.php");
				$query = $db->query("select * from comments where post_id={$_GET['id']}");
				while($comment = $query->fetchobject()){
			?>
			<tr>
				<td><?php echo $comment->comment_id; ?></td>
				<td><?php echo date('Y-m-d H:i:s',$comment->created_at); ?></td>
				<td><?php echo $comment->body; ?></a></td>
				<td><?php echo $comment->user_nickname; ?></td>
				<?php 
		        	if(isset($_SESSION['user_id'])&&$_SESSION['user_id']===$post->user_id){
		        		echo "<td><a href=\"../comments/delete.php?id=$comment->comment_id\">删除</a></td>";	
		        	}
	         	?>
			</tr>
	        <?php } ?>
	    </tbody>
	</table>
	<h2>新增评论</h2>
	<form action="../comments/save.php" method="post">
		<input type="hidden" name="post_id" value =<?php echo $_GET['id'] ?> />
		<?php 
			if(isset($_SESSION['admin']) && $_SESSION['admin']===true){		//判断是否登录,未登录则匿名发表评论
				echo "<input type=\"hidden\" name=\"user_id\" value ={$_SESSION['user_id']} />";
				echo "<input type=\"hidden\" name=\"user_nickname\" value ={$_SESSION['nickname']} />";
			}else{
				echo "<input type=\"hidden\" name=\"user_id\" value =2 />";
				echo "<input type=\"hidden\" name=\"user_nickname\" value ='匿名' />";
			}
		 ?>
		<textarea name="body"></textarea>
		<br/>
		<input type="submit" value="确定" />
	</form>
</body>
</html>