<meta charset="utf-8">
<?php 
	require_once("../inc/common.php");	//连接函数库
	require_once("../inc/db.php");		//连接数据库
	//删除原音频
	if($_POST["delpic"]==1){
		$sql = "update posts set title =:title,body =:body,created_at =:time,pic=:pic,catalog=:catalog where post_id =:id";
		$array = array(":title"=>$_POST['title'],":body"=>$_POST['body'],":time"=>time(),":id"=>$_POST['id'],":pic"=>"",":catalog"=>$_POST['catalog']);
		$bool = execute($sql,$db,$array)==false?0:1;
		error_redirect("./show.php?id={$_POST['id']}",$bool);
		unlink($_POST["pic"]);
	//不删除原音频或更换原音频
	}else{
		$allowedExts = array("mp3");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);        // 获取文件后缀名
		if (($_FILES["file"]["type"] == "audio/mp3"
		&& ($_FILES["file"]["size"] < 1024*1024*50)    // 小于 50 MB
		&& in_array($extension, $allowedExts))
		||$_FILES["file"]["error"] == 4)
		{
        	if ($_FILES["file"]["error"] == 0){
        		unlink($_POST['pic']);		//更换音频
        		move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/" . $_FILES["file"]["name"]);	
        		$pic="http://".$_SERVER['HTTP_HOST']."/upload/".$_FILES["file"]["name"];
			}
			elseif($_FILES["file"]["error"] == 4){
				$sql = "select * from posts where post_id = :id";
				$array = array(":id"=>$_POST['id']);
				$query = execute($sql,$db,$array);
				$post=$query->fetchobject();
				$pic = $post->pic;		//不更换原音频,故令其地址为原地址
			}
			$sql = "update posts set title =:title,body =:body,created_at =:time,pic=:pic,catalog=:catalog where post_id =:id";
			$array = array(":title"=>$_POST['title'],":body"=>addslashes($_POST['body']),":time"=>time(),":id"=>$_POST['id'],":pic"=>$pic,":catalog"=>$_POST['catalog']);
			$bool = execute($sql,$db,$array)==false?0:1;
			error_redirect("./show.php?id={$_POST['id']}",$bool);
		}
		else
		{
		    echo "非法的文件格式或文件过大";
		}
	}
 ?>