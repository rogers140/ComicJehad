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
require('config.php');
$db=new mysqli($host,$user,$dbpassword,$database);
if (mysqli_connect_errno()) {
  echo 'Error: Could not connect to database. Please try again later.';
  exit;
}
$db->query("set names 'utf8'");
$sql1="SELECT * FROM benzi WHERE display=1;";//查询所有提交的作品
$sql2="SELECT * FROM benzi WHERE display=2;";//查询通过的本子
$submitted=$db->query($sql1);
$passed=$db->query($sql2);

echo "
  <script>
    var submittedArray=[];
    var passedArray=[];
  </script>
";
while($row=$submitted->fetch_assoc()){
    echo "
      <script>
      var info=new Object();
      info.id=".$row['id'].";
      info.name='".$row['name']."';
      info.groupname='".$row['groupname']."';
      info.groupurl='".$row['groupurl']."';
      info.author='".$row['author']."';
      info.benziurl='".$row['benziurl']."';
      info.time='".$row['time']."';
      info.orient='".$row['orient']."';
      info.type=".$row['type'].";
      info.proxy=".$row['proxy'].";
	  info.addurl='".$row['addurl']."';
      info.theme='".$row['theme']."';
      info.price=".$row['price'].";
      info.amount=".$row['amount'].";
      info.display=".$row['display'].";
      submittedArray.push(info);
      </script>
    ";
}
while($row=$passed->fetch_assoc()){
  echo "
      <script>
      var info=new Object();
      info.id=".$row['id'].";
      info.name='".$row['name']."';
      info.groupname='".$row['groupname']."';
      info.groupurl='".$row['groupurl']."';
      info.author='".$row['author']."';
      info.benziurl='".$row['benziurl']."';
      info.time='".$row['time']."';
      info.orient='".$row['orient']."';
      info.type=".$row['type'].";
      info.proxy=".$row['proxy'].";
      info.theme='".$row['theme']."';
      info.price=".$row['price'].";
	  info.addurl='".$row['addurl']."';
      info.amount=".$row['amount'].";
      info.display=".$row['display'].";
      passedArray.push(info);
      </script>
    ";
}
//echo "<script>alert(passedArray.length);</script>";
//echo $passed->num_rows;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>南京-ComicJehad</title>
<link href="../style/common.css" rel="stylesheet" type="text/css" />
<link href="../style/editbenzi.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery.js" type="text/javascript"></script>
</head>

<body id="bg"  >
	<div id = "container">
    	<div class ="top"><img src="../pic/TOP.gif" /></div>
        <div class = "main">
        	<div class = "left">
       		  <div class="logo" ><img id="bg" src="../pic/logo.gif" /></div>
           	  <div id="item" align="center" ><a href="info.php">最新情报</a></div>
              <div id="item" align="center" ><a href="../pages/enroll.php">社团报名</a></div>
              <div id="item" align="center"><a href="../pages/benzi.php">本子信息</a></div>
              <div id="item" align="center"><a href="../pages/review.html">历届回顾</a></div>
              <div id="item" align="center"><a href="../pages/aboutus.html">关于我们</a></div>
            </div>
            <div class = "content">
            	<div id="header"><img src="../pic/header3.gif" />
              </div>
              <div id="topDiv">
                <div id="i1" align="center"><b>提交作品</b></div>  
                <div id="i2" align="center"><b>审核通过</b></div>
              </div>
                <div id="leftDiv">
                    <select name="leftS" size="10" id="submitselect" ondblclick="show(this)">
                      <?php
                      for($i=0;$i<$submitted->num_rows;$i++){
                        echo "<option><script>document.write(submittedArray[".$i."].name);</script></option>";
                      }
                      ?>
                    </select>
                    <script>
                    function show(sel){
                      var index=sel.selectedIndex;
                      if(sel.id=='submitselect'){
                        var info=submittedArray[index];
                      }
                      else{
                        var info=passedArray[index];
                      }
                      benziname.innerHTML=info.name;
                      benziurl.innerHTML="<img src='"+info.benziurl+"' width='200' height='200'>";
                      author.innerHTML=info.author;
                      orient.innerHTML=info.orient;
                      if(info.proxy==1){
                        proxy.innerHTML="代理";
                      }
                      else{
                        proxy.innerHTML="非代理";
                      }
                      groupname.innerHTML=info.groupname;
                      groupurl.innerHTML="<img src='"+info.groupurl+"' width='100' height='100'>";
                      theme.innerHTML=info.theme;
					  addurl.innerHTML=info.addurl;
                      price.innerHTML=info.price+" RMB";
                      amount.innerHTML=info.amount;
                     
                    }
                    </script>
                </div>
                <div id="rightDiv">
                    <select name="rightS" size="10" id="passselect" ondblclick="show(this)">
                      <?php
                      for($i=0;$i<$passed->num_rows;$i++){
                        echo "<option><script>document.write(passedArray[".$i."].name);</script></option>";
                      }
                      ?>
                    </select>
                </div>
                <br><br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" value="右移" onclick='movetoright()'>
                <input type="button" value="左移" onclick='movetoleft()'>
                <script>
                    function movetoright(){
                      var index=document.getElementById('submitselect').selectedIndex
                      var info=submittedArray[index];
                      var name=info.name;
                      for(var i=0;i<passedArray.length;i++){
                        if(info.id==passedArray[i].id){
                          alert('该作品已经通过审核！');
                          return;
                        }
                      }
                      document.getElementById('passselect').options.add(new Option(name,name));
                      passedArray.push(info);
                      //8.31 test
                      document.getElementById('submitselect').options.remove(index);
                      submittedArray.splice(index,1);
                      //8.31 test
                    }
                    function movetoleft(){
                       var index=document.getElementById('passselect').selectedIndex;
                       document.getElementById('passselect').options.remove(index);
                       
                       //8.31 test
                       var info= passedArray[index];
                       var name=info.name;
                       submittedArray.push(info);
                       document.getElementById('submitselect').options.add(new Option(name,name));

                       //8.31 test
                       passedArray.splice(index,1);
                    }
                </script>
                <div id="mainDiv">
                <form enctype="multipart/form-data" action="submitbenzi.php" method="post">
                  <table align="center">
                    <tr>
                     <td>作品名称：</td>
                     <td><label id='benziname'><label/></td>
                    </tr>
                      <tr>
                        <td>作品图片：</td>
                        <td id='benziurl'><img src=""></td>
                          
                    </tr>
                    <tr>
                      <td>作者：</td>
                      <td><label id='author'><label/></td>
                    </tr>
                    <tr>
                      <td>向性：</td>
                      <td>
                        <label id='orient'><label/>
                      </td>
                    </tr>
                    <tr>
                      <td>代理：</td>
                      <td><label id='proxy'></label></td>
                    </tr>
                    <!--新增加的授权地址，如果有则显示，没有则不显示 -->
                    <tr>
                    	<td>授权地址：</td>
                        <td><label id='addurl'></label></td>
                    </tr>
                    <tr>
                      <td>社团名称：</td>
                      <td><label id='groupname'></label></td>
                    </tr>
                    <tr>
                      <td>社团头像：</td>
                      <td id='groupurl'>
                        <img src="">
                      </td>
                    </tr>
                    <tr>
                        <td>主题：</td>
                        <td><label id='theme'></label></td>
                    </tr>
                    <tr>
                      <td>价格：</td>
                      <td><label id='price'></label></td>
                    </tr>
                    <tr>
                        <td>数量：</td>
                        <td><label id='amount'></label></td>
                    </tr>
                  </table>
                  <br><br>
                   <input type='button' style= "width:200px; height:80px;" value="用户管理" align='center' onclick="user()">
                  <input type='button' style= "width:200px; height:80px;" value="完成" align='center' onclick="done()">
                   <input type='button' style= "width:200px; height:80px;" value="社团管理" align='center' onclick="group()">
                </form>
                
                <script>
                function done(){
                  $.post('pass.php',{submitted:submittedArray,passed:passedArray},function(msg){
                    alert('处理完成，将转到作品页面！');
                    window.location.href="benzi.php";
                  });
                }
				
				function user(){
                  $.post('pass.php',{submitted:submittedArray,passed:passedArray},function(msg){
                    alert('处理完成，将转到用户管理页面！');
                    window.location.href="manageUser.php";
                  });
                }
			   function group(){
                  $.post('pass.php',{submitted:submittedArray,passed:passedArray},function(msg){
                    alert('处理完成，将转到社团管理页面！');
                    window.location.href="manageGroup.php";
                  });
                }
				
                </script> 
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
