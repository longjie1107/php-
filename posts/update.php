<meta charset="utf-8">
<?php 
	require_once("../inc/common.php");	//连接函数库
	require_once("../inc/db.php");		//连接数据库
	if($_POST["delpic"]==1){
		$sql = "update posts set title =:title,body =:body,created_at =:time,pic=:pic,catalog=:catalog where post_id =:id";
		$query = $db->prepare($sql);
		$query->bindValue(":title",$_POST['title'],PDO::PARAM_STR);
		$query->bindValue(":body",$_POST['body'],PDO::PARAM_STR);
		$query->bindValue(":time",time(),PDO::PARAM_INT);
		$query->bindValue(":id",$_POST['id'],PDO::PARAM_INT);
		$query->bindValue(":pic","",PDO::PARAM_STR);
		$query->bindValue(":catalog",$_POST['catalog'],PDO::PARAM_STR);
		if(!$query->execute()){
			print_r($query->errorInfo());
		}else{
			unlink($_POST["pic"]);
			http_redirect_to("./show.php?id={$_POST['id']}");		//http重定向,若post失败,返回edit页面,否则定向到show.php
		}
	}else{
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);        // 获取文件后缀名
		if ($_FILES["file"]["error"] ==0)
		{
			if ((($_FILES["file"]["type"] == "image/gif")
			|| ($_FILES["file"]["type"] == "image/jpeg")
			|| ($_FILES["file"]["type"] == "image/jpg")
			|| ($_FILES["file"]["type"] == "image/pjpeg")
			|| ($_FILES["file"]["type"] == "image/x-png")
			|| ($_FILES["file"]["type"] == "image/png"))
			&& ($_FILES["file"]["size"] < 1024*1024*2)    // 小于 2 MB
			&& in_array($extension, $allowedExts))
			{
				unlink($_POST['pic']);
				if (file_exists("../upload/" . $_FILES["file"]["name"]))
		        {
		            echo $_FILES["file"]["name"] . " 文件已经存在。 ";
		        }
		        else
		        {
		            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
		            move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/" . $_FILES["file"]["name"]);
					$sql = "update posts set title =:title,body =:body,created_at =:time,pic=:pic,catalog=:catalog where post_id =:id";
					$query = $db->prepare($sql);
					$query->bindValue(":title",$_POST['title'],PDO::PARAM_STR);
					$query->bindValue(":body",$_POST['body'],PDO::PARAM_STR);
					$query->bindValue(":time",time(),PDO::PARAM_INT);
					$query->bindValue(":id",$_POST['id'],PDO::PARAM_INT);
					$query->bindValue(":pic","http://".$_SERVER['HTTP_HOST']."/upload/".$_FILES["file"]["name"],PDO::PARAM_STR);
					$query->bindValue(":catalog",$_POST['catalog'],PDO::PARAM_STR);
					if(!$query->execute()){
						print_r($query->errorInfo());
					}else{
						http_redirect_to("./show.php?id={$_POST['id']}");		//http重定向,若post失败,返回edit页面,否则定向到show.php
					}
				}
			}
			else
			{
			    echo "非法的文件格式或文件过大";
			}
	    }
	    elseif($_FILES["file"]["error"]==4){
	    	$sql = "update posts set title =:title,body =:body,created_at =:time,catalog=:catalog where post_id =:id";
			$query = $db->prepare($sql);
			$query->bindValue(":title",$_POST['title'],PDO::PARAM_STR);
			$query->bindValue(":body",$_POST['body'],PDO::PARAM_STR);
			$query->bindValue(":time",time(),PDO::PARAM_INT);
			$query->bindValue(":id",$_POST['id'],PDO::PARAM_INT);
			$query->bindValue(":catalog",$_POST['catalog'],PDO::PARAM_STR);
			if(!$query->execute()){
				print_r($query->errorInfo());
			}else{
				http_redirect_to("./show.php?id={$_POST['id']}");		//http重定向,若post失败,返回edit页面,否则定向到show.php
			}
	    }
	    else{
	    	echo "错误：: " . $_FILES["file"]["error"] . "<br>";
	    }
	}
 ?>