<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>新增帖子-杭电英语论坛</title>
</head>
<?php 
	require_once("../inc/common.php");	//连接函数库
	require_once("../inc/db.php");		//连接数据库
	$allowedExts = array("mp3");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);        // 获取文件后缀名
	if (($_FILES["file"]["type"] == "audio/mp3"
		&& ($_FILES["file"]["size"] < 1024*1024*50)    // 小于 50 MB
		&& in_array($extension, $allowedExts))
		||$_FILES["file"]["error"] == 4)
	{
        if ($_FILES["file"]["error"] == 0){
        	move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/" . $_FILES["file"]["name"]);
        	$pic = "http://".$_SERVER['HTTP_HOST']."/upload/".$_FILES["file"]["name"];
        }
        //如果没上传文件
        elseif($_FILES["file"]["error"] == 4){
        	$pic = "";
        }
        $sql = "insert into posts (title,user_id,user_nickname,body,created_at,pic,catalog) values(:title,:user_id,:user_nickname,:body,:time,:pic,:catalog)";	
		$array = array(":title"=>$_POST['title'],":user_id"=>$_POST['user_id'],":user_nickname"=>$_POST['user_nickname'],":body"=>$_POST['body'],":time"=>time(),":pic"=>$pic,":catalog"=>$_POST['catalog']);
		$bool = execute($sql,$db,$array)==false?0:1;
		error_redirect("./index.php?catalog=all",$bool);
	}
	else
	{
	    echo "<a href=\"new.php\">非法的文件格式或文件过大,点击返回</a>";
	}
?>