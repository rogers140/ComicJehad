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
	//include_once "DB.php"; 
	require_once('check_safe.php');
	//trim()函数可以截去头尾的空白字符
	
	if (isset($_SESSION['username'])) 
	{ 
        //echo "hello,";
        //echo "<a href=logout.php>退出登陆</a><br/>"; 
	} 
	else 
	{ 
		echo "对不起,您还没有<a href=enroll.php>登陆</a>!";
		exit;
	} 
	$username = $_SESSION['username'];
	$password = $_POST['password'];
	$cpassword =$_POST['cpassword'];
	$theEmail = trim($_POST['theEmail']);
	//$groupname = trim($_POST['groupname']);
	$thename = trim($_POST['thename']);
	$thephone = trim($_POST['thephone']);
	$theQQ = trim($_POST['theQQ']);
	$theID = trim($_POST['theID']);
	$themonth = trim($_POST['select1']);
	$theday = trim($_POST['select2']);
	$thehobby = trim($_POST['select3']);
	$thepic="";//头像路径
	//数据是否为空检验
	/*
	if(empty($username)||empty($password)||empty($cpassword)||empty($theEmail)){
		echo "data invalid!";
		exit;
		}
		
	//密码长度判断
	if(strlen($password)<6||strlen($password)>20){
		echo "password invalid";
		exit;
		}
		*/
	//连接到数据库
	//连接到数据库
	require('config.php');
	$db=new mysqli($host,$user,$dbpassword,$database);
	$db->query("set names 'utf8'");
	if (mysqli_connect_errno()) 	
	{
		echo 'Error: Could not connect to database. Please try again later.';
		exit;

	}
	//查询数据库，看填写的用户名是否已经存在
	//$sql = "select * from user where username = "; 
	//$result = $db->query($sql);
	//if (DB::isError($result) ){ 
	//	echo "数据库错误：".DB::errorMessage($result); 
	//	exit(); 
	//} 
	
	
	else{
		//rogers edit on 9.8 
		$sql = "select * from user where username='$username'";
		$result = $db->query($sql);
		$row = $result->fetch_row();
		$groupname = $row[3];
		$thepic=$row[5];
		$f=$_FILES['pic'];
		//echo GetFiletype($f['name']);
		//需要更新两张表，thegroup, benzi(groupurl)
		if(GetFiletype($f['name'])!='.'){//上传了头像
			//echo "<script>alert('上传了头像');</script>"; 
      		$dest_dir='../headphoto';//设定上传目录 
      		$timestamp=date("y m d h m s");
      		$filetype=GetFiletype($f['name']);
      		//$filename=iconv("utf-8","gbk",$f['name']); 
      		$thepic=$dest_dir.'/'.$timestamp.$filetype;//设置文件名为日期加上文件名避免重复 
      		$r=move_uploaded_file($f['tmp_name'],$thepic); 			
      		chmod($thepic, 0755);//设定上传的文件的属性
			
			$sql1 = "UPDATE user SET pwd = '".$password."', thename='".$thename."', thepic='".$thepic."', thephone='".$thephone."', theQQ='".$theQQ."',theEmail='".$theEmail."',theID='".$theID."', themonth='".$themonth."',theday='".$theday."',thehobby='".$thehobby."' WHERE username='$username'";
			$result1=$db->query($sql1);
			$sql2="UPDATE benzi SET groupurl='".$thepic."' where groupname='".$groupname."'";
			//$sql2="UPDATE benzi SET groupurl='".$thepic."'";
			$result2=$db->query($sql2);
			if(($result1==null)||($result2==null)){
				echo "<script>alert('数据库维护中...请稍后重试');</script>";
			}
			else{
				echo "<script>alert('修改成功！');</script>";
			}
		}	
		else{//没有上传头像
			//echo "<script>alert('没有上传头像');</script>";
			$sql1 = "UPDATE user SET pwd = '".$password."', thename='".$thename."', thephone='".$thephone."', theQQ='".$theQQ
			."',theEmail='".$theEmail."',theID='".$theID."', themonth='".$themonth."',theday='".$theday."',thehobby='".$thehobby."' WHERE username='$username'";
			$result1=$db->query($sql1);
			if($result1==null){
				echo "<script>alert('数据库维护中...请稍后重试');</script>";
			}
			else{
				echo "<script>alert('修改成功！');</script>";
			}
			
		}
      	
		//rogers edit on 9.8

		
		//将社团信息插入数据库的group表
		// $sql1 = "UPDATE thegroup SET groupname = '".$groupname."' WHERE username='$username'";
		
		// $result1 = $db->query($sql1);

		// if($result1&&$result1->num_rows&&$groupname!=""){
		
		// //查询数据库，看填写的社团名是否已经存在
		// 	echo "<script language='javascript'>
  //     	  		alert('社团名已存在!');
		// 		history.back(-1);
  //       		</script>";
  //   	}
  
		// else{//社团名不存在，可以更改
		// 	echo "<script>alert('got!');</script>";
		// 	if($_FILES['thepic']!=null){
		// 		echo "<script>alert('got!');</script>";
		// 		$f=$_FILES['thepic']; 
  //     			$dest_dir='../headphoto';//设定上传目录 
  //     			$timestamp=date("y m d h m s");
  //     			$filetype=GetFiletype($f['name']);
  //     			//$filename=iconv("utf-8","gbk",$f['name']); 
  //     			$thepic=$dest_dir.'/'.$timestamp.$filetype;//设置文件名为日期加上文件名避免重复 
  //     			$r=move_uploaded_file($f['tmp_name'],$thepic); 
  //     			chmod($thepic, 0755);//设定上传的文件的属性
		// 	}
		
		// 	//将用户信息插入数据库的user表
		// 	//$sql2 = "UPDATE user SET pwd = '".$password."', groupname = '".$groupname."', thename='".$thename."', thepic='".$thepic."', thephone='".$thephone."', theQQ='".$theQQ."',theEmail='".$theEmail."',theID='".$theID."', themonth='".$themonth."',theday='".$theday."',thehobby='".$thehobby."' WHERE username='$username'";
		// 	$sql2 = "UPDATE user SET pwd = '".$password."', thename='".$thename."', thepic='".$thepic."', thephone='".$thephone."', theQQ='".$theQQ."',theEmail='".$theEmail."',theID='".$theID."', themonth='".$themonth."',theday='".$theday."',thehobby='".$thehobby."' WHERE username='$username'";

		// 	$result2= $db->query($sql2);

		// 	if(!$result2){
		// 		echo '数据库记录插入失败！';
		// 		exit;
		// 	}
		// 	if($username!=""){
		// 		echo "<script language='javascript'>
		
  //     	 			alert('恭喜您修改成功!'');
		// 		</script>";
		// 	}
		// }
	}
	?>
<body id="bg"  >
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
            	<table align="center">
            		<tr>
            			<td><img src="<?php echo $thepic;?>" width="150px" height="150px"></td>
            		</tr>
                    <tr>
					
                        <td>社团名称：</td>
                        <td><p><?php echo $groupname ?></p></td>
                    </tr>
                    <tr>
                        <td>负责人：</td>
                        <td><p><?php echo $thename ?></p></td>
                    </tr>
            	</table>
				<div id="forCenter">
                <a  href="./editprofile.php"><input type="submit" name="btnSubmit" value="修改信息" id="btnSubmit" /></a>
                &nbsp;&nbsp;
                 <!-- 1000
              <select name = "myselect" onchange="location.href=this.options[this.selectedIndex].value;">
                	<option value="" selected="selected">参加活动</option>
                    <option value="editbenzi.php">上传本子</option>
                    <option value="editwa.php">上传周边</option>
                </select>
                -->
                <button onclick="window.location.href='editbenzi.php';">点击报名</button>

                &nbsp;&nbsp;
                <a href="enroll.php"><input type="submit" name="btnSubmit" value="注销登陆" id="btnSubmit" /></a>
  				&nbsp;&nbsp;
                 <button onclick="window.location.href='shenhe.php';">审核状态</button>
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
