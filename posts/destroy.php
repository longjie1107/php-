<?php 
	require_once("../inc/common.php");
	require_once("../inc/db.php");
	$sql = "select * from posts where post_id =:id";
	$array = array(':id' => $_POST['id']);
	$query = execute($sql,$db,$array);
	$post=$query->fetchobject();
	if($post->pic != ""){
		unlink($_SERVER["DOCUMENT_ROOT"].substr($post->pic, 21));		
	}
	$sql = "delete from posts where post_id=:id";
	$array = array(':id' => $_POST['id']);
	$bool = execute($sql,$db,$array)==false?0:1;
	error_redirect('./index.php?catalog=all',$bool)
 ?>