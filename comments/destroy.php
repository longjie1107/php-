<?php 
	require_once("../inc/common.php");
	require_once("../inc/db.php");
	$id = $_POST['id'];
	$sql="delete from comments where comment_id=:id";
	$query = $db->prepare($sql);
	$query->bindValue(":id",$id,PDO::PARAM_INT);
	if(!$query->execute()){
		echo "删除失败:".$query->errorInfo();
	}else{
		http_redirect_to('../posts/index.php?catalog=all');
	}
 ?>