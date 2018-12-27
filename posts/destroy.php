<?php 
	require_once("../inc/common.php");
	require_once("../inc/db.php");
	$id = $_POST['id'];
	$query = $db->query("select * from posts where post_id ={$id}");
	$post=$query->fetchobject();
	if($post->pic != ""){
		unlink($_SERVER["DOCUMENT_ROOT"].substr($post->pic, 21));		
	}
	$query = $db->query("delete from comments where post_id={$id}");
	$sql="delete from posts where post_id=:id";
	$query = $db->prepare($sql);
	$query->bindValue(":id",$id,PDO::PARAM_INT);
	if(!$query->execute()){
		echo "删除失败:".$query->errorInfo();
	}else{
		http_redirect_to('./index.php?catalog=all');
	}
 ?>