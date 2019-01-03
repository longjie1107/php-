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
				echo "<h3>$post->explain</h3>";
			}else{
				echo "<h3>词库中无此单词</h3>";
			}
		}else{
			$query=$db->prepare("select * from mydict where `explain` like :explain limit 20");
			$query->bindValue(":explain",'%'.$_POST['word'].'%',PDO::PARAM_STR);
			$query->execute();
			if($post=$query->fetchobject()){
				while($post){
					$str=str_replace(" ", "&nbsp", $post->word.'    '.$post->explain.'<br/>');
					echo "<h4>$str</h4>";
					$post=$query->fetchobject();
				}
			}else{
				echo "词库中无对应单词";
			}
		}
	 ?>
</body>
<style type="text/css">
h3
{
	width: 1500px;
	margin-top: 15%;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
}
</style>