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
<script language="javascript">
	function check(){

		if(document.send.password.value==""){
				
			}
		if((document.send.password.value.length<6||document.send.password.value.length>20)&&document.send.password.value!=""){
			alert("密码的长度必须在6到20之间!");
			return false;
			}
		if(document.send.password.value != document.send.cpassword.value){
			alert("确认密码与密码不一致!");
			return false;
			}
		if(document.send.groupname.value == ""){
			alert("社团名称不能为空!");
			return false;
			}
		if(document.send.thename.value==""){
			alert("负责人信息不能为空!");
			return false;
			}
			var temp = document.getElementById("theEmail");
            //对电子邮件的验证
            var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
            if(!myreg.test(temp.value))
            {
                alert('对不起,您输入的email地址不合法!');
                return false;
           }		
	}
	
    function show(){
         }
</script>
<?php 
	if ($_SESSION['username']!="") 
	{ 
	} 
	else 
	{ 
		echo "对不起,您还没有<a href=enroll.php>登陆</a>!";
		exit;
	} 
	//连接到数据库
	require('config.php');
	$db=new mysqli($host,$user,$dbpassword,$database);
	if (mysqli_connect_errno()) 	
	{
		echo 'Error: Could not connect to database. Please try again later.';
		exit;
	}
	$db->query("set names 'utf8'");
	$username = $_SESSION['username'];
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
<script language="javascript">
	function start(){
		groupurl.innerHTML="<img src='"+info.groupurl+"' width='100' height='100'>";
		document.getElementsByTagName("select")[0].value="<?php echo $themonth;?>";
		document.getElementsByTagName("select")[1].value="<?php echo $theday;?>";
		document.getElementsByTagName("select")[2].value="<?php echo $thehobby;?>";
		}
    function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object
        if(files[0].size>400000){
            alert("文件大小超过300k！请重新选择！");
        }
        else{

        }
    }

</script>

<body id="bg"  onload="start()" >
	<div id = "container">
    	<div class ="top"><img src="../pic/TOP.gif" /></div>
        <div class = "main">
        	<div class = "left">
       		  <div class="logo" ><img id="bg" src="../pic/logo.gif" /></div>
           	  <div id="item" align="center" ><a href="info.php">最新情报</a></div>
              <div id="item" align="center" ><a href="enroll.php">社团报名</a></div>
              <div id="item" align="center"><a href="benzi.php">本子信息</a></div>
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
                <form name="send" id="send" method="post" action="loggedin3.php" onSubmit="return check() " enctype="multipart/form-data" >	
            	<table align="center" cellpadding = "5">
            		<tr>
            			<td>新密码：</td>
            			<td><input name="password" type="password"  id="password" value="<?php echo $password;?>"></td>
            		</tr>
            		<tr>
            			<td>确认新密码：</td>
            			<td><input name="cpassword" type="password"  id="cpassword" value="<?php echo $password;?>"></td>
            		</tr>
                    <tr>
                        <td>社团名称：</td>
                        <td><label><?php echo $groupname;?></label></td>
                    </tr>
                    <tr>
                        <td>负责人：</td>
                        <td><input type="text" name="thename" name="thename" value="<?php echo $thename;?>"></td>
                    </tr>
                    <tr>
                      <td>社团头像：</td>
                      <td id='groupurl'>
                        <img src="<?php echo $thepic;?>" width="100px" height="100px">
                      </td>
                      <td><input type="hidden" name="MAX_FILE_SIZE" value="500000" /><input name="pic" type="file" id="pic" multiple><font size='2' color='red'>[大小不超过300kb]</font></td>
                            <script type="text/javascript">
                            document.getElementById('pic').addEventListener('change', handleFileSelect, false);
                            </script>
                    </tr>
                    <tr>
                        <td>电话：</td>
                        <td><input type="text" name="thephone" id="thephone" value="<?php if($thephone!=0)echo $thephone;?>"></td>
                    </tr>
                    <tr>
                        <td>QQ：</td>
                        <td><input type="text" name="theQQ" id="theQQ" value="<?php if($theQQ!=0)echo $theQQ;?>"></td>
                    </tr>
                    <tr>
                        <td>Email：</td>
                        <td><input type="text" name="theEmail" id="theEmail" value="<?php echo $theEmail;?>"></td>
                    </tr>
                    <tr>
                        <td>负责人身份证号码：</td>
                        <td><input type="text" name="theID" id="ID" value="<?php if($theID!=0)echo $theID;?>"></td>
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
            		<tr>
            			<td colspan="2" id="forCenter"><input type="submit" name="btnSubmit" value="完成" id="signup" /></td>
            		</tr>
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
</html>
