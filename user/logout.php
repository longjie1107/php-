<meta charset="utf-8">
<?php 
	session_start();
	session_destroy();
	echo "<div id=\"a\"><a href=\"../\">已注销,点击返回首页</a></div>";
 ?>
<style type="text/css">
#a
{
	width: 1500px;
	margin-top: 15%;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
}
 </style>
