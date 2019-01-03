<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>首页 - 杭电英语论坛</title>
</head>
<body>
	<?php 
		require_once("./inc/head.php"); 
	?>
	<div id="logo">SEARCH</div>
	<div id="search_form">
		<form action="./dict/show.php" method="post">
			<select name="fanyi">
	    		<option value="1">英译中</option>
	    		<option value="2">中译英</option>
	    	</select>
	    	<input id="input" type="text" name='word' value=''>
			<input type="submit" value='查询'>
		</form>
	</div>
	
</body>
<style type="text/css">

#search_form
{
	height: 30px;
    width: 280px;
    margin-left: auto;
    margin-right: auto;
    position: relative;
    top: 200px;
}
#logo
{
	height: 100px;
    font-size: 80px;
    width: 300px;
    margin-left: auto;
    margin-right: auto;
    position: relative;
    top: 180px;

}
/*#input
{
	font-size:1.4em;
height:2.7em;
border-radius:4px;
border:1px solid #c8cccf;
color:#6a6f77;
}*/

</style>