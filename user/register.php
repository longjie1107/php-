<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>注册 - 杭电英汉辞典</title>
</head>
<body>
    <?php require_once("../inc/head.php"); ?>
	<div id="middlepage">
        <form action="./save.php" method="post">
             <table >
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
                <tr height="35px">
                    <td >确认密码</td>
                    <td>
                        <input type="password" name="repwd" id="repwd" value="" />
                    </td>
                </tr>
                <tr height="35px">
                    <td >手机号</td>
                    <td>
                        <input type="text" name="tel" id="tel" value="" />
                    </td>
                </tr>
                <tr height="35px">
                    <td >邮箱</td>
                    <td>
                        <input type="text" name="mail" id="mail" value="" />
                    </td>
                </tr>
                <tr height="35px">
                    <td >昵称</td>
                    <td>
                        <input type="text" name="nickname" id="nickname" value="" />
                    </td>
                </tr>
                <tr height="35px">
                    <td>性别</td>
                    <td>
                        <select name="gender">
                            <option value="1">男</option>
                            <option value="2">女</option>
                        </select>
                    </td>
                </tr>
                <tr height="35px">
                    <td>出生日期</td>
                    <td>
                        <select name="birthYear">
                            <?php 
                                for($i=1900;$i<=date("Y");$i++){
                                    echo "<option value=\"$i\">$i</option>";
                                }
                             ?>
                        </select>年
                        <select name="birthMonth">
                            <?php 
                                for($i=1;$i<=12;$i++){
                                    echo "<option value=\"$i\">$i</option>";
                                }
                             ?>
                        </select>月
                        <select name="birthDay">
                            <?php 
                                for($i=1;$i<=31;$i++){
                                    echo "<option value=\"$i\">$i</option>";
                                }
                             ?>
                        </select>日
                    </td>
                </tr>
                <tr height="35px">
                    <td>个人介绍</td>
                    <td>
                        <textarea name="profile" rows="8" cols="30"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" id="" value="注册"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
<style type="text/css">
#middlepage
{
    width: 500px;
    position: relative;
    left: 40%;
    top: 50px;
}
</style>