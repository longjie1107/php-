<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>登陆 - 杭电英语论坛</title>
</head>
<body>
	<?php require_once("../inc/head.php"); ?>
	<form action="./read.php" method="post">
		<table>
			<tr height="35px">
			    <td width="120px">用户名</td>
			    <td width="300px">
			        <input type="text" name="username" id="username" value="" />
			    </td>
			</tr>
			<tr height="35px">
			    <td >密码</td>
			    <td>
			        <input type="password" name="password" id="password" value="" />
			    </td>
			</tr>
			<tr>
				<td>
					<img src="image_captcha.php"  onclick="this.src='image_captcha.php?'+new Date().getTime();" width="100" height="100"><br/>
			        <input type="text" name="captcha" placeholder="请输入图片中的验证码"><br/>
				</td>
			</tr>
			<tr height="35px">
			    <td>
			        <input type="submit" id="submit" value="登陆" />
			    </td>
			</tr>
		</table>
	</form>
</body>