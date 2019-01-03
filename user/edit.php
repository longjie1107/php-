<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>编辑个人信息 - 杭电英语论坛 </title>
</head>
<body>
	<?php 
		require_once("../inc/head.php");
        require_once("../inc/common.php");
		require_once("../inc/db.php");		//连接数据库
        $sql = "select * from users where user_id = :id";
		$array = array(':id'=>$_SESSION['user_id']);
        $query = execute($sql,$db,$array);
		$user = $query->fetchobject();
	 ?>
	<form action="./update.php" method="post">
		 <table >
            <tr height="35px">
                <td >手机号</td>
                <td>
                    <input type="text" name="tel" id="tel" value=<?php echo $user->tel ?> />
                </td>
            </tr>
            <tr height="35px">
                <td >邮箱</td>
                <td>
                    <input type="text" name="mail" id="mail" value=<?php echo $user->mail ?> />
                </td>
            </tr>
            <tr height="35px">
                <td >昵称</td>
                <td>
                    <input type="text" name="nickname" id="nickname" value=<?php echo $user->nickname ?> />
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
                                if($i==substr($user->birth,0,4))
                                    echo "<option value=\"$i\" selected=\"selected\">$i</option>";
                                else
                				    echo "<option value=\"$i\">$i</option>";
                			}
                		 ?>
                	</select>年
					<select name="birthMonth">
                		<?php 
                			for($i=1;$i<=12;$i++){
                                if($i==substr($user->birth,5,2))
                                    echo "<option value=\"$i\" selected=\"selected\">$i</option>";
                                else    
                				    echo "<option value=\"$i\">$i</option>";
                			}
                		 ?>
                	</select>月
					<select name="birthDay">
                		<?php 
                			for($i=1;$i<=31;$i++){
                                if($i==substr($user->birth,8,2))
                                    echo "<option value=\"$i\" selected=\"selected\">$i</option>";
                                else
                				    echo "<option value=\"$i\">$i</option>";
                			}
                		 ?>
                	</select>日
                </td>
            </tr>
            <tr height="35px">
                <td>个人介绍</td>
                <td>
                    <textarea name="profile" rows="8" cols="30" ><?php echo $user->profile ?></textarea>
                </td>
            </tr>
            <tr>
                <td>
					<input type="submit" id="" value="提交"/>
                </td>
            </tr>
        </table>
	</form>
</body>
</html>

<style type="text/css">
form
{
    width:260px;
    margin-top: 5%;
    margin-left: auto;
    margin-right: auto;
}
</style>