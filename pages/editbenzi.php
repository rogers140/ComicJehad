<?php
session_start();
$username=$_SESSION['username'];
//通过用户名查出groupname
//在session中的用户名
require("config.php");
//获取保存
$db=new mysqli($host,$user,$dbpassword,$database);
if (mysqli_connect_errno()) 
{
echo 'Error: Could not connect to database. Please try again later.';
exit;
}
$db->query("set names 'utf8'");
//echo $username;
//
$sql = "select * from user where username='".$username."';";
$result = $db->query($sql);
//echo $result->num_rows;
$row = $result->fetch_assoc();
$groupname=$row['groupname'];
//echo $groupname;
//$groupname='小花事务所';//从数据库获取groupname
//

$sql1="SELECT * FROM benzi WHERE type=0 AND groupname='".$groupname."'";//查询我的本子
$sql2="SELECT * FROM benzi WHERE display<>0 AND type=0 AND groupname='".$groupname."'";//查询参加活动的本子
$mybenzi=$db->query($sql1);
$displaybenzi=$db->query($sql2);
if($mybenzi==null||$displaybenzi==null){
 // echo "search error";
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
<script type="text/javascript">
     function tiaozhuan()
                 {
                    window.location.href="editprofile.php";
             
                }
				   function deletebenzi(){
                  var index=document.getElementById('leftselect').selectedIndex;
                  var vid=idlist1[document.getElementById('leftselect').selectedIndex];
				 
                  if(vid==null){
                    alert("请先在我的本子里选择！");
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

                function takepartin(){
                  $.post("takepartin.php",{list1:idlist1,list2:idlist2},function(msg){
					  if(msg==0){
                    	alert("您尚未提交参展作品审核!");
					}
					else{
                    window.location.href="groupset.php";
					}
				  });
				}
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
                    function movetoleft(){//变更
                       var index=document.getElementById('rightselect').selectedIndex;
                       document.getElementById('rightselect').options.remove(index);
                       idlist2.splice(index,1);
                       namelist2.splice(index,1);
                    }
               function show(a){
				   	if(a.checked){
						  add.innerHTML="<td>网上授权地址</td><td><input type='text' name='addurl'></td><font size='2' color='red'>[作者公式站或者是官方微博页面上有授权参加信息]</font>"
					}
					else{
						  add.innerHTML=""
						}
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
</head>
<body id="bg"  >

      <div class ="top"><img src="../pic/TOP.gif" /></div>
        <div class = "main">
          <div class = "left">
            <div class="logo" ><img id="bg" src="../pic/logo.gif" /></div>
              <div id="item" align="center" ><a href="../info.html">最新情报</a></div>
              <div id="item" align="center" ><a href="../pages/enroll.php">社团报名</a></div>
              <div id="item" align="center"><a href="../pages/benzi.php">本子信息</a></div>
              <div id="item" align="center"><a href="../pages/review.html">历届回顾</a></div>
              <div id="item" align="center"><a href="aboutus.php">关于我们</a></div>
            </div>
            <div class = "content">
              <div id="header"><img src="../pic/header2.gif" />
                </div>
              <div id="topDiv">
                <div id="i1" align="center"><b>社团作品&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></div>  
                <div id="i2" align="center"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;需提交审核的作品</b></div>
              </div>
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
                 	<input type="button" value="删除作品" onclick='return deletebenzi()'>
              	  </td>
                </tr>
                <tr>
                	<td align="center">
                    	<input type="button" value="编辑作品" onclick='return editbenzi()'>

                    </td>
                </tr> 
              </table>
              </div>
              <div id="rightDiv">
                    <select name="rightS" size="5" id="rightselect" ondblclick="alert(this.value)">
                        <?php
                        for($i=0;$i<$displaynum;$i++){
                            echo "<option><script>document.write(namelist2[".$i."])</script></option>";
                        }
                        ?>
                    </select>
              </div>
                <br><br><br>

              <div id="mainDiv">
                <form enctype="multipart/form-data" action="submitbenzi.php" method="post">
                  <table align="center">
                    <tr>
                     <td>作品名称：</td>
                     <td><input type="text" name='name'/></td>
                    </tr>
                    <tr>
                      <td>原作品：</td>
                      <td><input type="text" name='author'></td>
                        <td><font size='2' color='red'>[某某作品的同人，如果是原创请注明]</font></td>
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
                      <td>封面图片上传：</td>
                      <td><input type="hidden" name="max_file_size" value="400000"><input type="file" name='fmfile' id='fmfile' multiple></td>
                      <script>
                            document.getElementById('fmfile').addEventListener('change', handleFileSelect, false);
                      </script>
                      <td><font size='2' color='red'>[大小不超过300kb,否则请外链]</font></td>
                    </tr>
                    <tr id='url'>
                      <td>封面图片外链：</td>
                      <td><input type="text" name='fmurl'></td>
                       <td><font size='2' color='red'>[两种图片上传方式任选其一,无图将不会通过审核]</font></td>
                    </tr>
                   <tr id='add'>

                   </tr>
                    <tr>
                        <td>主题：</td>
                        <td><input type="text" name='theme' /></td>
                      <td><font color="red" size="2">[例如：什么CP之类的关键词或者是什么中心本]</font></td>
                    </tr>
                    <tr>
                    <td>价格：</td>
                    <td><input type="text" name='price'/></td>
                    <td><font color="red" size="2">[如果没有确定，可写大概价格]</font></td>
                    </tr>
                    </tr>
                    <tr>
                        <td>数量：</td>
                        <td><input type="text" name='amount'/></td>
                    <td><font color="red" size="2">[如果没有确定，可写大概，不得低于15本]</font></td>
                    </tr>
                    <tr>
                        <td align="center"><input type="submit" value="登陆新本子"></td>
                        <td align="center"><input type='button' value="参加活动"  onclick="takepartin()"></td>
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
