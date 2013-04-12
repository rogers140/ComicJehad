<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>南京-ComicJehad</title>
<link href="../style/common.css" rel="stylesheet" type="text/css" />
    <script language="javascript">
	function check(){
		if(document.send.username.value == ""){
			alert("请输入用户名!");
			return false;
			}
		if(document.send.username.value.length<2){
			alert("用户名的长度必须在2到20之间!");
			return false;
			}
		if(document.send.password.value==""){
			alert("请输入密码!");
			return false;
			}
		if(document.send.password.value.length<6||document.send.password.value.length>20){
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
		   if(!document.send.isagree.checked){
			   alert('对不起,您还未同意ComicJehad用户协议')
			   }			
	}
    function refresh_code()
 	{
 		 send.imgcode.src="verifycode.php?a="+Math.random();
	}
    //obj 需要传入的参数为Input的对象
    function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object
        if(files[0].size>400000){
            alert("文件大小超过300k！请重新选择！");
        }
        else{

        }
    }
    //document.getElementById('thepic').addEventListener('change', handleFileSelect, false);
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
                <form name="send" id="send" method="post" action="loggedin.php" onSubmit="return check()"  enctype="multipart/form-data">		
                	
            	<table align = "center" cellpadding = "5"> 
                <tr><td colspan="2" align="center">带<font color="#ff6699">*</font>为必填项</td></tr>
            		<tr>
            			<td>用户名：</td>
            			<td><input name="username"  type="text" id="username" /><font color="#FF6699">*</font></td>
            		</tr>
            		<tr>
            			<td>密码：</td>
            			<td><input name="password" type="password" id="password" ><font color="#FF6699">*</font></td>
            		</tr>
            		<tr>
            			<td>确认密码：</td>
            			<td><input name="cpassword" type="password"  id="cpassword" ><font color="#FF6699">*</font></td>
            		</tr>
                    <tr>
                        <td>社团名称：</td>
                        <td><input name="groupname" type="text" id="groupname" ><font color="#FF6699">*</font></td>
                    </tr>
                    <tr>
                        <td>负责人：</td>
                        <td><input name="thename" type="text" id="thename"><font color="#FF6699">*(请填写真实姓名 否则不通过审核)</font></td>
                    </tr>
                      <tr>
                         <td>社团头像上传</td>
                         
                         <td><input type="hidden" name="MAX_FILE_SIZE" value="400000" /><input name="thepic" type="file" id="thepic" multiple/><font size='2' color='red'>[大小不超过300kb]</font></td>
                            <script type="text/javascript">
                            document.getElementById('thepic').addEventListener('change', handleFileSelect, false);
                            </script>
                    </tr>
                    <tr>
                        <td>手机：</td>
                        <td><input name="thephone" type="text" id="thephone"><font color="#FF6699">*</font></td>
                    </tr>
                    <tr>
                        <td>QQ：</td>
                        <td><input name="theQQ" type="text" id="theQQ"></td>
                    </tr>
                    <tr>
                        <td>Email：</td>
                        <td><input name="theEmail" type="text" id="theEmail"><font color="#FF6699">*</font></td>
                    </tr>
                    <tr>
                        <td>身份证号码：</td>
                        <td><input name="theID" type="text" id="theID"></td>
                    </tr>
                     <tr>
                        <td>生日：</td>
                        <td>
                        <select name="select1">
                            <option >01</option><option >02</option><option >03</option>
                            <option >04</option><option >05</option><option >06</option>
                            <option >07</option><option >08</option><option >09</option>
                            <option >10</option><option >11</option><option >12</option>
                        </select>月
                        &nbsp;
                        <select name='select2'>
                            <option >01</option><option >02</option><option >03</option>
                            <option >04</option><option >05</option><option >06</option>
                            <option >07</option><option >08</option><option >09</option>
                            <option >10</option><option >11</option><option >12</option>
                            <option >13</option><option >14</option><option >15</option>
                            <option >16</option><option >17</option><option >18</option>
                            <option >19</option><option >20</option><option >21</option>
                            <option >22</option><option >23</option><option >24</option>
                            <option >25</option><option >26</option><option >27</option>
                            <option >28</option><option >29</option><option >30</option>
                            <option >31</option>
                        </select>日
                        </td>
                    </tr>
                    <tr>
                        <td>向性：</td>
                        <td>
                        <select name="select3">
                            <option >宅</option><option >腐</option><option >大众</option>
                        </select>
                        </td>
                    </tr>
                    <tr>
                    	<td>请输入验证码</td>
                        <td><input name="code" type="text" id="code">
                        	<img src="VerifyCode.php" alt="验证码" id="imgcode"/>
                             <a href="javascript:refresh_code()">看不清？换一个</a>

                        </td>
                    </tr>
                    <tr>
                    	<td>
                    	<input id="isagree" type="checkbox" checked="" style="vertical-align:middle;*height:14px" name="isagree" tabindex="6">
						</td>
                        <td>	
                            <span>
								我已阅读并接受
							<a target="_blank" href="cj12_new2.html" id="hengxian">《ComicJehad用户协议》</a>
							</span>
                        </td> 
                    </tr>
            		<tr>
            			<a href='loggedin.php'><td colspan="2" align="center"><input type="submit" name="Submit" value="注册" id="signup"  /></td></a>
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
        <div class = "footer" align="center"><p>Copyright &copy; 2012. All Rights Reserved</p></div>
    </div>
</body>





</html>
