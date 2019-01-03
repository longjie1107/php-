<?php 
	require_once("../inc/common.php");
	require_once("../inc/db.php");
	$sql="delete from comments where comment_id=:id";
	$array = array(':id' => $_POST['id']);
	$bool = execute($sql,$db,$array)==false?0:1;
	error_redirect('../posts/show.php?id='.$_POST['post_id'],$bool)
 ?>