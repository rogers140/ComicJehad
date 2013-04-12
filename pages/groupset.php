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
	$sql = "select * from thegroup where username='$username'";
	$result = $db->query($sql);
	$row = $result->fetch_row();
	$orient = $row[3];
	$buddygroup = $row[4];
	$placenum = $row[5];
	$remark =  $row[6];	
	$area = $row[7];
	if($area==0){
		$area="纯本区";
		}
	else if($area==1){
		$area="综合区";
		}
	else{
		$area="手工周边";
		}
?>
<script src="../js/jquery.js" type="text/javascript"></script>
<script language="javascript">
	function start(){
		document.getElementsByTagName("select")[0].value="<?php echo $orient;?>";
		document.getElementsByTagName("select")[1].value="<?php echo $placenum;?>";
		}
       function finishsubmit(){
		   	
         var vorient=document.getElementById('select1').options[document.getElementById('select1').selectedIndex].value;
         var vbuddy=document.getElementById('buddy').value;
         var vnum=document.getElementById('select3').options[document.getElementById('select3').selectedIndex].value;
         var vremark=document.getElementById('remark').value;
		 var varea = 0;
	
          $.post("finishsubmit.php",{orient:vorient,buddygroup:vbuddy,placenum:vnum,remark:vremark,area:varea},function(msg){
           alert("参加活动成功，请等待管理员审核作品");
           window.location.href="benzi.php";
             });     
      }		

</script>
<body id="bg"  onload="start()">
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
            	<div id="header"><img src="../pic/header2.gif" /></div>
               <h2 align="center">参展社团属性</h2>
 
               <form name="form1" id="form1" action="" >
               <table align = "center" cellpadding = "5">
              
            		<tr>
            			<td>社团属性区域选择：</td>
            			<td> <select name="select1" id='select1'>
                            <option>宅</option><option >腐</option><option>大众</option>
                        </select></td>
            		</tr>
             
                <tr>

            			<td>连摊社团名：</td>
            			<td><input name="" type="text" id="buddy" value="<?php echo $buddygroup;?>"></td>
            		</tr>
                     <tr>
            			<td>摊位数量：</td>
            			 <td> <select name="select3" id='select3'>
                         	<option >0</option>
                            <option >1</option><option >2</option><option >3</option>
                            <option >4</option><option >5</option><option >6</option>
                            <option >7</option><option >8</option><option >9</option>
                            <option >10</option>
                        </select></td>
            		</tr>
                    <tr>
            			<td>备注信息：</td>
            			<td><input name="" type="text" id="remark" value="<?php echo $remark;?>"></td>
            		</tr>
                    <tr >
            		<td> <input type="button" value="继续上传作品" onclick="window.location.href='editbenzi.php'"></td>	
                    <td ><input type="button" value="确定提交"  onclick='finishsubmit()'/></td>
                    
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
