<?php
session_start();
$username = trim($_POST['username']);
$password = trim($_POST['pwd']);


//  注册登陆成功的 login 变量，并赋值 true
//  session_register("username"); 

  
$errmsg = '';

    $_SESSION['username'] = $_POST['username'];
    if($username=="soukou"&&$password=="670243zh"){
      ?>
      <script language="javascript">
        alert("登陆成功");
      </script>
      <?php
            
    }else{
      ?>
      <script language="javascript">
        alert("用户名或密码不正确 请重新输入!");
        history.back(-1);
      </script>
      <?php
      //使用php实现页面跳转
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>南京-ComicJehad</title>
<link href="../style/common.css" rel="stylesheet" type="text/css" />
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
            	<div id="header"><img src="../pic/header3.gif" />
                </div>
               <br>
            	<br>
            	<br>
            	<br>
            	<br>
            	<br>
				<div id="forCenter">
               <a  href="manageUser.php"><input type="submit" name="btnSubmit" value="管理用户" id="btnSubmit" /></a>
                &nbsp;&nbsp;
                &nbsp;&nbsp;
                <a href="manageBenzi.php"><input type="submit" name="btnSubmit" value="管理本子" id="btnSubmit" /></a>
                
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
