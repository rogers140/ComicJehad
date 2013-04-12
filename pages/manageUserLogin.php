<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>南京-ComicJehad</title>
<link href="../style/common.css" rel="stylesheet" type="text/css" />
<script src="../style/common.js" type="text/javascript"></script>
<script language='javascript' src='check_data.js'></script>
<script language='javascript'>
	function check(){
		if(document.login.username.value==""){
			alert('请输入你的用户名!');
			return false;;
			}
		if(document.login.pwd.value==""){
			alert('请输入你的密码!');
			return false;
			}
		if(document.login.username.value.length<2){
			alert('用户名的长度必须大于2!');
			return false;
			}
		if(document.login.pwd.value.length<6){
			alert('密码的长度不足6位!');
			return false;
			}
		}
</script>
</style>
</head>
<body id="bg"  >
	<div id = "container">
    	<div class ="top"><img src="../pic/TOP.gif" /></div>
        <div class = "main">
        	<div class = "left">
       		  <div class="logo" ><img id="bg" src="../pic/logo.gif" /></div>
           	  <div id="item" align="center" ><a href="info.php">最新情报</a></div>
              <div id="item" align="center" ><a href="enroll.php">社团报名</a></div>
              <div id="item" align="center"><a href="benzi.php">本子信息</a></div>
              <div id="item" align="center"><a href="review.html">历届回顾</a></div>
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
            	<br>
            	<br>
				<form name="login" method="post" action="manageLogined.php" onsubmit="return check();">
            	<table class="tbByA" align="center">
					<tr><td class="tabL">

					用户名：

					</td><td>

					<input name="username" type="text" id="username" />

					</td></tr><tr><td class="tabL">
					密码：
					</td><td>

					<input name="pwd" type="password" id="pwd" />

					</td></tr><tr><td colspan="2" class="tabC" align="center">
					
                    
                   
                    				<input type="submit" name="btnSubmit" value="登录" id="btnSubmit" />
					&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="signup.php"><input type="button" value="注册" /></a>

					</td></tr><tr><td colspan="2">

					<span id="msgLogin"></span>

					</td></tr>

					</table>
                    </form>

            	
               
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</html>
