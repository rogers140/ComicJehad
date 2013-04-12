<?php
session_start();
if ($_SESSION['username']=="soukou") 
  { 
        //echo "hello,";
     
        //echo "<a href=logout.php>退出登陆</a><br/>"; 
  } 
  else 
  { 
    echo "对不起,您还没有<a href=enroll.php>登陆</a>!";
    exit;
  } 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>南京-ComicJehad</title>
<link href="../style/common.css" rel="stylesheet" type="text/css" />
<link href="../style/benzi.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#leftDiv{
	width:400px;
	float:left;
	}
#rightDiv{
	width:400px;
	float:right;	
	}

</style>
<script language="javascript">
	function deleteUser(){
	<?php
		$username = $_POST['select11'];
		echo $username;
	?>
	}

function fun(){
	window.location.href = "manageBenzi.php";
};
function G(id){
    return document.getElementById(id);
};
function GC(t){
   return document.createElement(t);
};
String.prototype.trim = function(){
          return this.replace(/(^\s*)|(\s*$)/g, '');
};
function isIE(){
      return (document.all && window.ActiveXObject && !window.opera) ? true : false;
} 
     var loginDivWidth = 300;
var sign_in_flow = '<div style="background:#FF9900;">登陆</div><div>用户名:*</div><div>'
       + '<input type="text" id="sign_email" maxlength="64" size="30"/>'
       + '</div><div>密码:*</div><div><input type="password" id="sign_pwd" size="30"/>'
        + '</div><div><input type="button" value="登陆" onclick="logincheck();" id="sign_button"/>'
;
var myislogin = 0;
function logincheck(){
	if(G("sign_email").value=="soukou"&&G("sign_pwd").value=="670243zh"){
		myislogin = 1;
		cancelSign();
		}
	else{
		alert("您输入的用户名和密码不正确,请重新输入!");
		}
	}
function loadSignInFlow(){
   G("sign_div").innerHTML = sign_in_flow;
    G("sign_email").focus();
};
var sign_up_flow = '<div style="background:#CCFF00;">Create New Account</div><div>e-mail:*</div><div>'
       + '<input type="text" id="sign_email" maxlength="64" size="30"/>'
       + '</div><div>password:*</div><div><input type="password" id="sign_pwd" size="30"/>'
        + '</div><div>password again:*</div><div><input type="password" id="sign_repwd" size="30"/>'
        + '</div><div><input type="button" value="creat account" onclick="signFlow(0);" id="sign_button"/> '
        + ' <input type="button" value="cancel" onclick="cancelSign();"/></div>'
        + '<p><a href="javascript:loadSignInFlow();">login</a></p>';
function loadSignUpFlow(){
   G("sign_div").innerHTML = sign_up_flow;
    G("sign_email").focus();
};
function cancelSign(){
    G("sign_div").style.display = 'none';
    G("cover_div").style.display = 'none';
   document.body.style.overflow = '';
};
var forget_pwd_flow = '<div style="background:#FF99FF;">Forget Password</div><div>e-mail:*</div><div>'
       + '<input type="text" id="sign_email" maxlength="64" size="30"/>'
        + '</div><div><input type="button" value="sent pwd to e_mail" onclick="signFlow(2);" id="sign_button"/>   '
        + '   <input type="button" value="cancel" onclick="cancelSign();"/></div>';
function loadForgetPwdFlow(){
   G("sign_div").innerHTML = forget_pwd_flow;
    G("sign_email").focus();
};
function checkEmail(){
   if((G("sign_email").value.indexOf('@')<=0)||(G("sign_email").value.indexOf('.')<=0)){
    return '<div style="color:#FF0000";">Sorry, unrecognized e_mail.</div>';
   }
   return '';
}
function checkPwd(){
   if(G("sign_pwd").value.trim() == ''){
    return '<div style="color:#FF0000";">Password field is required.</div>';
   }
   return '';
}
function checkRePwd(){
   if(G("sign_pwd").value.trim() != G("sign_repwd").value.trim()){
    return '<div style="color:#FF0000";">The specified passwords do not match.</div>';
   }
   return '';
}
function signFlow(isSignIn){
    var error = checkEmail();
    var htmlText = null;
    if (isSignIn == 1) {
     if (error == ''){
      error = checkPwd();
     }
     htmlText = sign_in_flow;
    } else if (isSignIn == 0) {
     if (error == ''){
      error = checkPwd();
      if (error == ''){
       error = checkRePwd();
      }
     }
     htmlText = sign_up_flow;
    } else if (isSignIn == 2) {
    htmlText = forget_pwd_flow;
    }
    var eMailValue = G("sign_email").value.trim();
   if (error == '') {
    } else {
    G("sign_div").innerHTML = error + htmlText;
    G("sign_email").value = eMailValue; 
    }
};	
function popCoverDiv(){
   if (G("cover_div")) {
    G("cover_div").style.display = '';
   } else {
    var coverDiv = GC('div');
    document.body.appendChild(coverDiv);
    coverDiv.id = 'cover_div';
    with(coverDiv.style) {
     position = 'absolute';
     background = '#CCCCCC';
     left = '0px';
     top = '0px';
     var bodySize = getBodySize();
     width = bodySize[0] + 'px'
     height = bodySize[1] + 'px';
     zIndex = 98;
     if (isIE()) {
      filter = "Alpha(Opacity=60)";
     } else {
      opacity = 0.6;
     }
    }
   }
}
function getBodySize(){
   var bodySize = [];
   with(document.documentElement) {
    bodySize[0] = (scrollWidth>clientWidth)?scrollWidth:clientWidth;
    bodySize[1] = (scrollHeight>clientHeight)?scrollHeight:clientHeight;
   }
   return bodySize;
}
function popSign(isLogin){
   if (G("sign_div")) {
    G("sign_div").style.display = '';
   } else {
    var signDiv = GC('div');
    document.body.appendChild(signDiv);
    signDiv.id = 'sign_div';
    signDiv.align = "center";
    signDiv.onkeypress = function(evt){
          var e = window.event?window.event:evt;
          if (e.keyCode==13 || e.which==13) {
           if (G("sign_button")) {
            G("sign_div").focus();
            G("sign_button").click();
           }
          }
         };
    with (signDiv.style) {
     position = 'absolute';
     left = (document.documentElement.clientWidth - loginDivWidth)/2 + 'px';
     top = (document.documentElement.clientHeight - 300)/2 + 'px';
     width = loginDivWidth + 'px';
     zIndex = 99;
     background = '#FFFFFF';
     border = '#66CCFF solid 1px';
    }
   }
   if(isLogin) {
    G("sign_div").innerHTML = sign_in_flow;
   } else {
    G("sign_div").innerHTML = change_pwd_flow;
   }
  
}
function popSignFlow(isLogin) {
   popCoverDiv();  
   popSign(isLogin);  
   document.body.style.overflow = "hidden";
     
      if(isLogin) {
       G("sign_email").focus();
      } else {
       G("old_pwd").focus();
      }
		
}
function changePwd(){
    var error = checkOldPwd();
    if (error == ''){
     error = checkPwd();
    }
   if (error == ''){
    error = checkRePwd();
   }

    var oldPwd = G("old_pwd").value.trim();
    var newPwd = G("sign_pwd").value.trim();
   if (error == '') {
     var url = basePath + "?q=tripuser/tripuser_change_pwd_ajax/" + oldPwd + "/" + newPwd;
     exeRequest(url, getSignText, null);
    } else {
    G("sign_div").innerHTML = error + change_pwd_flow;
    }
};
function checkOldPwd(){
   if(G("old_pwd").value.trim() == ''){
    return '<div style="color:#FF0000";">Old Password field is required.</div>';
   }
   return '';
}
var change_pwd_flow = '<div style="background:#33FFFF;">Change Your Password</div><div>old password:*</div><div>'
       + '<input type="password" id="old_pwd" size="30"/>'
       + '</div><div>new password:*</div><div><input type="password" id="sign_pwd" size="30"/>'
        + '</div><div>new password again:*</div><div><input type="password" id="sign_repwd" size="30"/>'
        + '</div><div><input type="button" value="change password" onclick="changePwd();" id="sign_button"/> '
        + ' <input type="button" value="cancel" onclick="cancelSign();"/></div>';

</script>
</head>
<?php 
	//连接到数据库
require('config.php');
$db=new mysqli($host,$user,$dbpassword,$database);
if (mysqli_connect_errno()){
		echo 'Error: Could not connect to database. Please try again later.';
		exit;
	}
$db->query("set names 'utf8'");
?>
<?php 
	$username = $_POST['select11'];
	$sql = "select * from user where username='$username'";
	$result = $db->query($sql);
	$row = $result->fetch_row();
	$password = $row[2];
	$groupname = $row[3];
	$thename = $row[4];
	$thepic =  $row[5];	
	$thephone = $row[6];
	$theQQ = $row[7];
	$theEmail = $row[8];
	$theID = $row[9];
	$themonth = $row[10];
	$theday = $row[11];
	$thehobby = $row[12];
	?>
<body id="bg"  onload="start()" >
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
            	<div id="header"><img src="../pic/header3.gif" /></div>
                      <h2>用户</h2>
                <div id="leftDiv">
                	<form name="send" method="post" action=""  >	
                    <select name="select11" size="20" id="select11"  >
   						
						<?php 
						$sql = "select * from user";
						$result = $db->query($sql);
						// 当数据库存在用户数据时 予以显示
						while($row = $result->fetch_row()){
							 echo "<option value='$row[1]'>$row[1]     $row[3]</option>";
						}
						?>
                    </select>		
                  	 <br />	                 			
                    &nbsp;&nbsp;&nbsp;
                     <input type="hidden" name="yourhiddeninfo" value="111">
                 <input type="submit" value="详情" onclick="start()" >
                 &nbsp;&nbsp;
					<input type='button' onclick='fun()' value='管理本子' />

                     
                    </form>
                    
                   


                </div>
               
                <div id="rightDiv">

 <script language="javascript">
 		function start(){
		document.getElementsByTagName("select")[1].value="<?php echo $themonth;?>";
		document.getElementsByTagName("select")[2].value="<?php echo $theday;?>";
		document.getElementsByTagName("select")[3].value="<?php echo $thehobby;?>";
		}
	
</script>
					<table align = "center" cellspacing="5"> 
            		<tr>
            			<td>用户名：</td>
            			<td><input name="username"  type="text" id="username" value="<?php echo $username;?>" /><font color="#FF6699">*</font></td>
            		</tr>
            		<tr>
            			<td>密码：</td>
            			<td><input name="password" type="password" id="password" value="<?php echo $password;?>" /><font color="#FF6699">*</font></td>
            		</tr>
                    <tr>
                        <td>社团名称：</td>
                        <td><input name="groupname" type="text" id="groupname" value="<?php echo $groupname;?>" /><font color="#FF6699">*</font></td>
                    </tr>
                    <tr>
                        <td>负责人：</td>
                        <td><input name="thename" type="text" id="thename" value="<?php echo $thename;?>" /><font color="#FF6699">*</font></td>
                    </tr>
                      <tr>
                         <td>社团头像缩略图</td>
                         <td><input name="thepic" type="file" id="thepic"></td>
                    </tr>
                    <tr>
                        <td>手机：</td>
                        <td><input name="thephone" type="text" id="thephone" value="<?php echo $thephone;?>"/></td>
                    </tr>
                    <tr>
                        <td>QQ：</td>
                        <td><input name="theQQ" type="text" id="theQQ" value="<?php echo $theQQ;?>" /></td>
                    </tr>
                    <tr>
                        <td>Email：</td>
                        <td><input name="theEmail" type="text" id="theEmail" value="<?php echo $theEmail;?>"/><font color="#FF6699">*</font></td>
                    </tr>
                    <tr>
                        <td>身份证号码：</td>
                        <td><input name="theID" type="text" id="theID" value="<?php echo $theID;?>"/></td>
                    </tr>
                     <tr>
                        <td>生日：</td>
                        <td>
                        <select id="select1" name="select1">
                            <option value = "01">01</option><option value = "02">02</option><option value = "03">03</option>
                            <option value = "04">04</option><option value = "05">05</option><option value = "06">06</option>
                            <option value = "07">07</option><option value = "08">08</option><option value = "09">09</option>
                            <option value = "10">10</option><option value = "11">11</option><option value = "12">12</option>
                        </select>月
                        &nbsp;
                        <select  id="select2" name="select2">
                            <option value = "01" >01</option><option value = "02">02</option><option value = "03">03</option>
                            <option value = "04">04</option><option value = "05">05</option><option value = "06">06</option>
                            <option value = "07">07</option><option value = "08">08</option><option value = "09">09</option>
                            <option value = "10">10</option><option value = "11">11</option><option value = "12">12</option>
                            <option value = "13">13</option><option value = "14">14</option><option value = "15">15</option>
                            <option value = "16">16</option><option value = "17">17</option><option value = "18">18</option>
                            <option value = "19">19</option><option value = "20">20</option><option value = "21">21</option>
                            <option value = "22">22</option><option 	value = "23">23</option><option value = "24">24</option>
                            <option value = "25">25</option><option value = "26">26</option><option value = "27">27</option>
                            <option value = "28">28</option><option value = "29">29</option><option value = "30">30</option>
                            <option value = "31">31</option>
                        </select>日
                        </td>
                    </tr>
                    <tr>
                        <td>向性：</td>
                        <td>
                        <select id="select3" name="select3">
                            <option value="宅">宅</option><option value="腐">腐</option><option value="大众">大众</option>
                        </select> 
                        </td>
                    </tr>
            	</table>
                </div>
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
