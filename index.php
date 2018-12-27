<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>首页 - 杭电英语论坛</title>
  <link rel="stylesheet" href="./css/background.css" type="text/css" />
</head>
<body>
	<?php 
		require_once("./inc/head.php"); 
	?>
	<form action="./dict/show.php" method="post">
		<select name="fanyi">
    		<option value="1">英译中</option>
    		<option value="2">中译英</option>
    	</select>
    	<input type="text" name='word' value=''>
		<input type="submit" value='查询'>
	</form>
	<?php echo "当前日期:".date("Y-m-d"); ?>
</body>