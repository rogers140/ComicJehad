<?php 
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>南京-ComicJehad</title>
<link href="../style/common.css" rel="stylesheet" type="text/css" />
</head>
<?php

$username = trim($_POST['username']);
$password = trim($_POST['pwd']);
setcookie('user',$_POST['username'],time()+2592000);//保存帐号1个月
setcookie('pw',$_POST['pwd'],time()+2592000);//保存密码一个月
//  注册登陆成功的 login 变量，并赋值 true
//  session_register("username"); 

  
$errmsg = '';
if(!empty($username)){
  //用户填写了数据才执行操作
  if(empty($username)){
    $errmsg = '数据输入不完整';
    }
  if(empty($errmsg)){
    //$error为空说明前面的验证通过
    //连接到数据库
  require('config.php');
  $db=new mysqli($host,$user,$dbpassword,$database);
  
  if (mysqli_connect_errno())   
  {
    echo 'Error: Could not connect to database. Please try again later.';
    exit;
  }
    $db->query("set names 'utf8'");
    $sql = "select * from user where username='$username' and pwd='$password'";
    $db->query($sql);
    $result = $db->query($sql);
    $row = $result->fetch_row();
    
    $_SESSION['username'] = $_POST['username'];

    if($result&&$result->num_rows){
			 echo "<script>alert('登陆成功');</script>";
						
		  }else{
		 echo "<script>alert('用户名或密码输入错误,请重新输入!');</script>";
			//使用php实现页面跳转
			$url = "enroll.php";
			echo "<script language='javascript' type='text/javascript'>";
			echo "window.location.href='$url'";
			echo "</script>";
			}
			}
	}
	//echo "<font color='red' size='5' >用户:".$username." ".$errmsg." </font>"
?>
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
            	<table align="center">
                    <tr>
                      <td><img src="<?php echo $row[5];?>" width="150px" height="150px"></td>
                    </tr>
                    <tr>
                        <td>社团名称：</td>
                        <td><p><?php echo $row[3] ?></p></td>
                    </tr>
                    <tr>
                        <td>负责人：</td>
                        <td><p><?php echo $row[4] ?></p></td>
                    </tr>
            	</table>
				<div id="forCenter">
               <a  href="./editprofile.php?s_id=<?php echo session_id();?>"><input type="submit" name="btnSubmit" value="修改信息" id="btnSubmit" /></a>
                &nbsp;&nbsp;
                 <!-- 1000
              <select name = "myselect" onchange="location.href=this.options[this.selectedIndex].value;">
                	<option value="" selected="selected">参加活动</option>
                    <option value="editbenzi.php">上传本子</option>
                    <option value="editwa.php">上传周边</option>
                </select>
                -->
                <button onclick="window.location.href='editbenzi.php';">点击报名</button>
                &nbsp;&nbsp;
                <a href="enroll.php"><input type="submit" name="btnSubmit" value="注销登陆" id="btnSubmit" /></a>
                 &nbsp;&nbsp;
                 <button onclick="window.location.href='shenhe.php';">审核状态</button>
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
