<?php
session_start();
$username=$_SESSION['username'];
require("config.php");
$db=new mysqli($host,$user,$dbpassword,$database);
if (mysqli_connect_errno()) 
{
  echo 'Error: Could not connect to database. Please try again later.';
  exit;
}
$db->query("set names 'utf8'");
$sql = "select * from user where username='$username'";
$result = $db->query($sql);
$row = $result->fetch_assoc();
$groupname=$row['groupname'];
$groupurl=$row['thepic'];


$sql1="SELECT * FROM benzi WHERE type=0 AND groupname='".$groupname."'";//我的本子
$mybenzi=$db->query($sql1);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>南京-ComicJehad</title>
<link href="../style/common.css" rel="stylesheet" type="text/css" />
<script language="javascript">

</script>

</head>

<body id="bg"  >

	<div id = "container">
    	<div class ="top"><img src="../pic/TOP.gif" /></div>
        <div class = "main">
        	<div class = "left">
       		  <div class="logo" ><img id="bg" src="../pic/logo.gif" /></div>
           	  <div id="item" align="center" ><a href="info.php">最新情报</a></div>
              <div id="item" align="center" ><a href="enroll.php">社团报名</a></div>
              <div id="item" align="center"><a href="../pages/benzi.php">本子信息</a></div>
              <div id="item" align="center"><a href="../pages/review.html">历届回顾</a></div>
              <div id="item" align="center"><a href="aboutus.php">关于我们</a></div>
            </div>
            <div class = "content">
            	<div id="header"><img src="../pic/header2.gif" />
                </div>
               <br>
            	<br>
            	<br>
            	<br>
            	<br>
            	<br>
                <h2 align="center">社团审核状态</h2>
          <table border="1" align="center">
          <th>
          	<td>提交审核作品</td>
            <td>主题</td>
            <td>售价</td>
            <td>本数</td>
            <td>状态</td>
          </th>
          <?php
            while($row=$mybenzi->fetch_assoc()){
				echo "<tr>";
				echo "<td>";
				echo "</td>";
				echo "<td>";
				echo $row['name'];
				echo "</td>";
				echo "<td>";
				echo $row['theme'];
				echo "</td>";
				echo "<td>";
				echo $row['price'];
				echo "</td>";
				echo "<td>";
				echo $row['amount'];
				echo "</td>";
				echo "<td>";
				if($row['display']==0){
					echo "未提交";
				}
				else if($row['display']==1){
					echo "待审核";
				}
				else if($row['display']==2){
					echo "已通过";
				}
				echo "</td>";
				echo "</tr>";
			}
		  ?>
          </table>
          <br>
          <br>
          <div id="but" align="center">
          		<input type="button" value="继续添加" onclick="window.location.href='editbenzi.php'">
                <input type="button" value="返回上一页" onclick="window.location.href='enroll.php'">
          </div>
          </div>		
        </div>
        <div class="linker" align="center">
        	<div class="sublinker"></div>
            <div class="sublinker"></div>
            <div class="sublinker"></div>
            <div class="sublinker"></div>
            <div class="sublinker"></div>
            <div class="sublinker"></div>
            <div class="sublinker"></div>
            <div class="sublinker"></div>
            <div class="sublinker"></div>
            <div class="sublinker"></div>
            
        </div>
        <div class = "footer" align="center"><p>Copyright &copy; 2012. 苏ICP备13004753号 All Rights Reserved</p></div>
    </div>
</body>





</html>
