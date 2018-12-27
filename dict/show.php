<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>查询结果 - 杭电英汉辞典</title>
</head>
<body>
	<?php 
		require_once("../inc/db.php");
		if($_POST['fanyi']==1){
			$query=$db->prepare("select * from mydict where word = :word");
			$query->bindValue(":word",$_POST['word'],PDO::PARAM_STR);
			$query->execute();
			if($post=$query->fetchobject()){
				echo $post->explain;
			}else{
				echo "词库中无此单词";
			}
		}else{
			$query=$db->prepare("select * from mydict where `explain` like :explain");
			$query->bindValue(":explain",'%'.$_POST['word'].'%',PDO::PARAM_STR);
			$query->execute();
			if($post=$query->fetchobject()){
				while($post){
					echo str_replace(" ", "&nbsp", $post->word.'    '.$post->explain.'<br/>');
					$post=$query->fetchobject();
				}
			}else{
				echo "词库中无对应单词";
			}
		}
	 ?>
</body>