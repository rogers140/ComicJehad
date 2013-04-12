<?php
session_start();
$username=$_SESSION['username'];
//通过用户名查出groupname
//在session中的用户名
require('config.php');
//获取保存

$db=new mysqli($host,$user,$dbpassword,$database);
if (mysqli_connect_errno()) 
{
echo 'Error: Could not connect to database. Please try again later.';
exit;
}
$db->query("set names 'utf8'");

//
$sql = "select * from user where username = '".$username."'"; 
$result = $db->query($sql);
$row = $result->fetch_assoc();
$groupname=$row['groupname'];
$groupurl=$row['thepic'];
//$groupname="小花事务所";
//$groupurl="../pic/test1.jpg";
//从数据库获取groupname
//以下的，除了链接之外，不要修改

if($_POST['proxy']!=null){//使用了代理
  if(($_FILES['sqfile']!=null)||$_POST['squrl']!=null){
    $name=$_POST['name'];
    $author=$_POST['author'];//原作者
    $orient=$_POST['orient'];
    $theme=$_POST['theme'];
    $price=$_POST['price'];
    $amount=$_POST['amount'];

    if($_FILES['sqfile']!=null){//上传了文件
      $f=$_FILES['sqfile']; 
      $dest_dir='../upload';//设定上传目录 
      $timestamp=date("y m d h m s");
      $filetype=GetFiletype($f['name']);
      //$filename=iconv("utf-8","gbk",$f['name']); 
      //$dest=$dest_dir.'/'.$timestamp.$f['name'];//设置文件名为日期加上文件名避免重复 
      $dest=$dest_dir.'/'.$timestamp.$filetype;
      $r=move_uploaded_file($f['tmp_name'],$dest); 
      chmod($dest, 0755);//设定上传的文件的属性
      $benziurl=$dest;
    }
    else{//链接
      $benziurl=$_POST['squrl'];
    }
    if((!is_numeric($price))||(!is_numeric($amount))){
      echo "<script>alert('价格和数量请输入数字！');</script>";
    }
    else{
      $sqlAdd="INSERT INTO benzi (name,groupname,groupurl,author,benziurl,time,orient,type, proxy,theme, price, amount, display)
      VALUES ('".$name."','".$groupname."', '".$groupurl."','".$author."','".$benziurl."','".$timestamp."', '".$orient."', 2, 1,'".$theme."', ".$price.", ".$amount.", 0);";
      $db->query($sqlAdd);
    }
    
  }
  else{
    echo "<script>alert('请上传授权截图和或填写授权截图链接');</script>";
  }
}
else {//没有使用代理
  if(($_FILES['fmfile']!=null)||$_POST['fmurl']!=null){
    $name=$_POST['name'];
    $author=$_POST['author'];//原作者
    $orient=$_POST['orient'];
    $theme=$_POST['theme'];
    $price=$_POST['price'];
    $amount=$_POST['amount'];
    if($_FILES['fmfile']!=null){//上传文件
      $f=$_FILES['fmfile']; 
      $dest_dir='../upload';//设定上传目录
      $timestamp=date("y m d h m s");
      $filetype=GetFiletype($f['name']);
      //$filename=iconv("utf-8","gbk",$f['name']); 
      //$dest=$dest_dir.'/'.$timestamp.$f['name'];//设置文件名为日期加上文件名避免重复  
      $dest=$dest_dir.'/'.$timestamp.$filetype;
      $r=move_uploaded_file($f['tmp_name'],$dest); 
      chmod($dest, 0755);//设定上传的文件的属性
      $benziurl=$dest;
    }
    else{//链接
      $benziurl=$_POST['fmurl'];
    }
   /* $i->version=1;
    $i->authorurl=$groupurl;
    $i->benziurl=$benziurl;
    $i->origin=$author;
    $info=json_encode($i);*/
    if((!is_numeric($price))||(!is_numeric($amount))){
      echo "<script>alert('价格和数量请输入数字！');</script>";
    }
    else{
      $sqlAdd="INSERT INTO benzi (name,groupname,groupurl,author,benziurl,time,orient,type, proxy,theme, price, amount, display)
      VALUES ('".$name."','".$groupname."', '".$groupurl."','".$author."','".$benziurl."','".$timestamp."', '".$orient."', 2, 0,'".$theme."', ".$price.", ".$amount.", 0);";
      $db->query($sqlAdd);
    }
    
  }
  else{
    echo "<script>alert('请上传封面图片和或填写封面图片链接');</script>";
  }
}
/**/

$sql1="SELECT * FROM benzi WHERE type=2 AND groupname='".$groupname."'";//查询我的娃
$sql2="SELECT * FROM benzi WHERE display<>0 AND type=2 AND groupname='".$groupname."'";//查询参加活动的娃
$mybenzi=$db->query($sql1);
$displaybenzi=$db->query($sql2);
if($mybenzi==null||$displaybenzi==null){
  echo "search error";
}
else{
  $benzinum=$mybenzi->num_rows;
  $displaynum=$displaybenzi->num_rows;
  //echo $benzinum;
  //echo $displaynum;
  echo "<script type='text/javascript'>
            var idlist1=[];
            var namelist1=[];
            var idlist2=[];
            var namelist2=[];
        </script>";
  while($row=$mybenzi->fetch_assoc()){
    echo "<script type='text/javascript'>
        idlist1.push(".$row['id'].");
        namelist1.push('".$row['name']."')
    </script>";
  }
  while($row=$displaybenzi->fetch_assoc()){
    echo "<script type='text/javascript'>
        idlist2.push(".$row['id'].");
        namelist2.push('".$row['name']."')
    </script>";
  }
  //echo "<script type='text/javascript'>alert(idlist2.length);</script>";
}
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
              <div id="item" align="center"><a href="aboutus.php">关于我们</a></div>
            </div>
            <div class = "content">
            	<div id="header"><img src="../pic/header2.gif" />
                </div>
              <div id="topDiv"><div id="i1" align="center"><b>我的本子</b></div>	<div id="i2" align="center"><b>参加本子</b></div></div>
                <div id="leftDiv">
            		<select name="leftS" size="5" id="leftselect" ondblclick= "alert(this.value)">
                        <?php
                        for($i=0;$i<$benzinum;$i++){
                            echo "<option><script>document.write(namelist1[".$i."])</script></option>";
                        }
                        ?>
                        
                    </select>
                    
            	</div>
               <div id="zhanwei">
              </div>
              <div id="midDiv">
              <table>
              <br>
              <br>
              <br>
            
              <tr>
              	<td align="center">
            		<input  type="button" value="右移" onclick='movetoright()'>
               	</td>
               </tr>
               	<td align="center">
                 	<input type="button" value="左移" onclick='movetoleft()'>
                 </td>
                </tr>
                <tr>
                 <td align="center">
                 	<input type="button" value="删除本子" onclick='return deletebenzi()'>
              	 </td>
                 </tr>
                  <tr>
                	<td align="center">
                    	<input type="button" value="编辑本子" onclick='return editbenzi()'>
                    </td>
                </tr> 
              </table>
              </div>
                <div id="rightDiv">
            		<select name="rightS" size="5" id="rightselect">
                        <?php
                        for($i=0;$i<$displaynum;$i++){
                            echo "<option><script>document.write(namelist2[".$i."])</script></option>";
                        }
                        ?>
                    </select>
            	</div>
                <br><br><br>
                
                 <script>
                    function movetoright(){
                     var name=document.getElementById('leftselect').options[document.getElementById('leftselect').selectedIndex].value;
                     var id=idlist1[document.getElementById('leftselect').selectedIndex];
                     for(var i=0;i<idlist2.length;i++){
                      if(id==idlist2[i]){
                        alert('该本子已经参加活动！');
                        return;
                      }
                     }
                     document.getElementById('rightselect').options.add(new Option(name,name));
                     idlist2.push(id);
                     namelist2.push(name);

                    }
                    function movetoleft(){
                       var index=document.getElementById('rightselect').selectedIndex;
                       document.getElementById('rightselect').options.remove(index);
                       idlist2.splice(index,1);
                       namelist2.splice(index,1);
                    }
                    </script>
            	<div id="mainDiv">
                <form enctype="multipart/form-data" action="submitwa.php" method="post">
            	  <table align="center">
                    <tr>
            			   <td>作品名称：</td>
            			   <td><input type="text" name='name'/></td>
            		    </tr>
                    <tr>
                      <td>设计者：</td>
                      <td><input type="text" name='author'></td>
                        <td><font size='2' color='red'>[必填]</font></td>
                    </tr>
                    <tr>
                      <td>向性：</td>
                      <td>
                        <select name='orient'>
                        <option >宅</option><option >腐</option><option >大众</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>代理：</td>
                      <td><input type="checkbox" name='proxy' onclick='show(this)'></td>
                    </tr>
                    <tr id='file'>
                      <td>实物图片上传</td>
                      <td><input type="hidden" name="max_file_size" value="407200"><input type="file" name='fmfile'></td>
                      <td><font size='2' color='red'>[大小不超过300kb,否则请外链]</font></td>
                    </tr>
                    <tr id='url'>
                      <td>实物图片外链：</td>
                      <td><input type="text" name='fmurl'></td>
                       <td><font size='2' color='red'>[两种图片上传方式任选其一,无图将不会通过审核]</font></td>
                    </tr>


                    <script type="text/javascript">
                      function show(a){
                        
                        if(a.checked){
                          file.innerHTML="<td>授权截图上传</td><td><input type='hidden' name='max_file_size' value='407200'><input type='file' name='sqfile'></td><td><font size='2' color='red'>[大小不超过300kb,否则请外链]</font></td>";
                          url.innerHTML="<td>授权截图外链：</td><td><input type='text' name='squrl'></td>";
                        }
                        else{
                          file.innerHTML="<td>实物图片上传</td><td><input type='hidden' name='max_file_size' value='407200'><input type='file' name='fmfile'></td><td><font size='2' color='red'>[大小不超过300kb,否则请外链]</font></td>";
                          url.innerHTML="<td>实物图片外链：</td><td><input type='text' name='fmurl'></td>";
                        
                        }
                      }
                    </script>
                   
                    <tr>
                        <td>原作品：</td>
                        <td><input type="text" name='theme'></td>
                        <td><font size='2' color='red'>[请注明什么作品的同人物,或者原创]</font></td>
                    </tr>
                    <tr>
            			<td>价格：</td>
            			<td><input type="text" name='price'/></td>
            		</tr>
                    <tr>
                        <td>数量：</td>
                        <td><input type="text" name='amount'/></td>
                    </tr>
                     <tr>
                        <td><input type="submit" value="登陆新作品"></td>
                         <td align="center"><input type='button' value="参加活动"  onclick="takepartin()"></td>
                      
                    </tr>
            	</table>
              </form>
              <script>
               function deletebenzi(){
                  var index=document.getElementById('leftselect').selectedIndex;
                  var vid=idlist1[document.getElementById('leftselect').selectedIndex];
                  if(vid==null){
                    alert("请先在社团作品里选择！");
                  }
                  else{
                    $.post("deletebenzi.php",{id:vid},function(){
                      idlist1.splice(index,1);
                      namelist1.splice(index,1);
                      document.getElementById('leftselect').options.remove(index);
                      for (var i = 0; i <idlist2.length; i++) {
                        if(vid==idlist2[i]){
                          idlist2.splice(i,1);
                          namelist2.splice(i,1);
                          document.getElementById('rightselect').options.remove(i);
                          break;
                        }
                      };
                      
                    });
                  }
                }
				function editbenzi(){
				  var index=document.getElementById('leftselect').selectedIndex;
                  var vid=idlist1[document.getElementById('leftselect').selectedIndex];
                  if(vid==null){
                    alert("请先在我的本子里选择！");
                  }
                  else{
                    $.post("temp.php",{id:vid},function(){
                   		window.location.href="editmybenzi.php";
                      
                    });
                  }
					}
              </script>  
           
              <script>
              function takepartin(){
                $.post("takepartin.php",{list1:idlist1,list2:idlist2},function(msg){
                  alert('您的'+msg+'件展品提交成功，请等待审核');
                  window.location.href="groupset.php";
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
