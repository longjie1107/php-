<?php 
	require_once("../inc/db.php");		//连接数据库
	require_once("../inc/common.php");
	$sql="select * from posts where post_id = :post_id";
	$array = array(':post_id' => $_GET['id']);
	$query = execute($sql,$db,$array);
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
	<h1 id = "h1"><?php echo $post->title ?></h1>
	<h5 id = "h5">作者:<?php echo $post->user_nickname ?></h2>
	<p id = "p"><?php echo $post->body ?></p>
	<?php 
		if($post->pic!="")
			echo "<audio id = \"audio\"src=\"$post->pic\" controls></audio>";
	 ?>
	<table id = "table" border="0">
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
				$sql="select * from comments where post_id=:post_id";
				$array = array(':post_id' => $_GET['id']);
				$query = execute($sql,$db,$array);
				while($comment = $query->fetchobject()){
			?>
			<tr>
				<td><?php echo $comment->comment_id; ?></td>
				<td><?php echo date('Y-m-d H:i:s',$comment->created_at); ?></td>
				<td><?php echo $comment->body; ?></a></td>
				<td><?php echo $comment->user_nickname; ?></td>
				<?php 
		        	if(isset($_SESSION['user_id'])&&$_SESSION['user_id']===$post->user_id){
		        		echo "<td><a href=\"../comments/delete.php?id=$comment->comment_id&post_id={$_GET['id']}\">删除</a></td>";	
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

<style type="text/css">
#h1
{
	width: 1500px;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
}
#h5
{
	width: 1500px;
	font-size: 20px;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
}
#p
{
	margin-top:100px;
}
#audio
{
	position:absolute;
	top:20%;
}
#table
{
	width: 1500px;
	margin-left: auto;
    margin-right: auto;
    text-align: center;
    margin-bottom: 100px;
    margin-top: 50px;
}
textarea
{
	width: 300px;
	height: 150px;
}
</style>