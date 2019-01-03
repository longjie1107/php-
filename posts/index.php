<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>帖子 - 杭电英语论坛</title>
</head>

<body>
  <?php require_once("../inc/head.php"); ?>
  <caption><h1 id="title" >帖子列表</h1></caption><br/>
  <div id="catalog">
      <a href="index.php?catalog=all">全部</a>|
      <a href="index.php?catalog=practice">练习</a> |
      <a href="index.php?catalog=lesson">课程</a> |
      <a href="index.php?catalog=QandA">问答</a> 
    </div>
  
    

    <table border="2">
        <thead>
      <tr>
        <th>id</th>
        <th>标题</th>
        <th>修改日期</th>
        <th>作者</th> 
        <th>操作</th>        
      </tr>
    </thead>
    <tbody>
       <?php 
          require_once("../inc/db.php");
            $catalog=isset($_GET['catalog'])?$_GET['catalog']:"all";
          if($catalog=='all'||!$catalog){
            $query = $db->query("select count(*) as amount from posts");
            $posts_amount = $query->fetchobject()->amount;
            $sql_catalog = "";
          }else{
            $query = $db->query("select count(*) as amount from posts where catalog = \"{$catalog}\"");
            $posts_amount = $query->fetchobject()->amount;
            $sql_catalog = " where catalog = \"{$catalog}\"";
          }
          $page_size = 2;
          $page_amount = ceil($posts_amount/$page_size);
          $page_current = isset($_GET['page'])?$_GET['page']:1;
          if(!is_numeric($page_current)) $page_current = 1;
          else if($page_current > $page_amount) $page_current = $page_amount;
          else if($page_current < 1) $page_current = 1;
          //生成上一页、下一页
          if($page_current <= 1 )
            $page_previous = 1 ;
          else
            $page_previous = $page_current - 1;
          if($page_current >= $page_amount )
            $page_next = $page_amount ;
          else
            $page_next = $page_current + 1 ;
          $params = $_GET;
          $params['page'] = 1;
          $page_first_q =  http_build_query($params);
          $params['page'] = $page_previous;
          $page_previous_q =  http_build_query($params);
          $params['page'] = $page_next;
          $page_next_q =  http_build_query($params);
          $params['page'] = $page_amount;
          $page_last_q =  http_build_query($params);
          //计算返回纪录的起点与记录数
          $row_base= ($page_current-1) * $page_size;
          $sql_page = "LIMIT {$page_size} OFFSET {$row_base}";
          $sql =  "select * from posts $sql_catalog $sql_page";
          $query  = $db->query($sql);
          while($post = $query->fetchobject()){
        ?>
          <tr>
            <td><?php echo $post->post_id; ?></td>
            <td><a href="show.php?id=<?php echo $post->post_id; ?>"><?php echo $post->title; ?></a></td>
            <td><?php echo date('Y-m-d H:i:s',$post->created_at); ?></td>
            <td><?php echo $post->user_nickname; ?></td>
            <td>
              <?php 
                if(isset($_SESSION['admin'])&&$_SESSION['admin']===true&&$post->user_id==$_SESSION['user_id']) {
                  //判断是否已登录且为本人操作
                  echo "<a href=\"edit.php?id=$post->post_id\">编辑</a>&nbsp";
                  echo "<a href=\"delete.php?id=$post->post_id\">删除</a>";
                }else{
                  echo "无操作权限";
                }
              ?>
            </td>
          </tr>
        <?php } ?>
    </tbody>
     </table>

    
 
  <?php 
    if(isset($_SESSION['admin'])&&$_SESSION['admin']===true){   //已登录才可以新增帖子
      echo "<a class=\"tip\" href=\"new.php\">新增帖子</a>";
    }
    else{
      echo "<div class=\"tip\">登录后可新建帖子</div>";
    }
   ?>
  <div id="pager" class="tips"> 
    <a href="?<?php echo $page_first_q ?> ">首页</a>
    <a href="?<?php echo $page_previous_q ?>">上一页</a>
    <a href="?<?php echo $page_next_q ?>">下一页</a>    
    <a href="?<?php echo $page_last_q ?>">末页</a><br/>
    <form action="page_turn_to.php" method="post">
      <span>当前第 <?php echo $page_current ?>  页</span>
      <span>总共 <?php echo $page_amount ?> 页, 跳至</span>
      <select name="page">   
        <?php 
          for($i=1;$i<=$page_amount;$i++){
            echo "<option value=\"$i\" selected=\"selected\">$i</option>";
          }
         ?>
      </select>
      <span>页</span>
      <input type="submit" id="" value="确定"/>
    </form>
  </div>
</body>
</html>

<style type="text/css">
#title
{
  position: absolute;
    right: 45.5%;
    top: 10px;
}
#catalog
{
  width: 190px;
    position: absolute;
    top: 90px;
    left: 45%;
}
table
{
    width: 500px;
    position: absolute;
    top: 170px;
    left: 34%;
}
.tips
{
      position: absolute;
    bottom: 100px;
    left: 40%;
}
.tip
{
    position: absolute;
    bottom: 150px;
    left: 40%;
}
</style>