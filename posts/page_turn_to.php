<?php 
	require_once("../inc/common.php");
	$url = $_SERVER['HTTP_REFERER'];
	$pos = strrpos($url, "page=");
	if(!$pos)
		$url = $url . "&page=" . $_POST['page'];
	else
		$url = substr($url,0,$pos+5). $_POST['page'];
	http_redirect_to($url);
 ?>