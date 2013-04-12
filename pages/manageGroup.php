<?php
session_start();
if ($_SESSION['username']=="soukou") 
  { 

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
	function fun(){
		window.location.href = "manageBenzi.php";
	}
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
  //echo "<script>alert('".$username."');</script>";
	$sql = "select * from thegroup where username='$username'";
	$result = $db->query($sql);
	$row = $result->fetch_row();
	$groupname = $row[2];
	$orient = $row[3];
	$buddygroup = $row[4];
	$placenum = $row[5];
	$remark =  $row[6];	
	$area = $row[7];
	$sql1="SELECT * FROM benzi WHERE display=1 AND groupname='".$groupname."'";//查询我的娃
	$sql2="SELECT * FROM benzi WHERE display=2 AND groupname='".$groupname."'";//查询参加活动的娃
	$mybenzi=$db->query($sql1);
	$displaybenzi=$db->query($sql2);
	if($mybenzi==null||$displaybenzi==null){
  		echo "search error";
	}
	else{
 	 	$benzinum=$mybenzi->num_rows;
 		 $displaynum=$displaybenzi->num_rows;
		 
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
<body id="bg" >
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
                      <h2>本届参展社团</h2>
                <div id="leftDiv">
                	<form name="send" method="post" action=""  >	
                    <select name="select11" size="20" id="select11"  >
   						
						<?php 
							$zero = 0;
							$sql = "
							SELECT *
							FROM user
							WHERE groupname
							IN (
								SELECT groupname
								FROM benzi
								WHERE display <>0
							)";
							$result = $db->query($sql);
							// 当数据库存在用户数据时 予以显示
							while($row = $result->fetch_row()){
							 echo "<option value='$row[1]'>$row[1] $row[3]</option>";
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
					<table align = "center" cellspacing="5"> 
            		<tr>
            			<td>社团区域选择：</td>
            			<td><input name="orient"  type="text" id="orient" value="<?php echo $orient;?>" /></td>
            		</tr>
            		<tr>
            			<!--<td>摊位区域选择：</td>
            			<td><input name="area" type="text" id="area" value="<?php echo $area;?>" /></td>
                  -->
            		</tr>
                    <tr>
                        <td>连摊社团名：</td>
                        <td><input name="buddygroup" type="text" id="buddygroup" value="<?php echo $buddygroup;?>" /></td>
                    </tr>
                    <tr>
                        <td>摊位数量：</td>
                        <td><input name="placenum" type="text" id="placenum" value="<?php echo $placenum;?>" /></td>
                    </tr>
                    <tr>
                        <td>备注信息：</td>
                        <td><input name="remark" type="text" id="remark" value="<?php echo $remark;?>"/></td>
                    </tr>
                   <tr>
                   		<td>*注1 :摊位区域数字：0代表纯本区；1代表综合区；2代表手工周边区</td>
                       </tr>
            	</table>
                <table>
                	<tr>
                    	<td align="center">未通过本子</td>
                    	<td align="center">已通过审核本子</td>
                    </tr>
                    <tr>
                    <td align="center"> 
               	  <select name="leftS" size="5" id="select11"  >
						<?php 
							// 当数据库存在用户数据时 予以显示
                    	    for($i=0;$i<$benzinum;$i++){
                     	       echo "<option><script>document.write(namelist1[".$i."])</script></option>";
                       	 }
							?>
                    </select>
                    </td>
                    <td align="center">	
                    <select name="rightS" size="5" id="rightselect">
                        <?php
                      for($i=0;$i<$displaynum;$i++){
                            echo "<option><script>document.write(namelist2[".$i."])</script></option>";
                        }
                        ?>
                    </select>
                    </td>
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
