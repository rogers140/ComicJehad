<?php
//加上session,获得username
session_start();
require('config.php');
$username = $_SESSION['username'];
$benziid = $_SESSION['benziid'];
$name = $_POST['name'];
$author =$_POST['author'];
$orient = trim($_POST['select3']);
$benziurl = $_POST['benziurl'];
$theme =$_POST['theme'];
$price = $_POST['price'];
$amount = $_POST['amount'];
$db=new mysqli($host,$user,$dbpassword,$database);
$db->query("set names 'utf8'");

	
		$sql = "select * from benzi where id='$benziid'";
		$result = $db->query($sql);
		$row = $result->fetch_row();
		$groupname = $row[2];
		$thepic=$row[5];
		$f=$_FILES['pic'];
		//echo GetFiletype($f['name']);
		//需要更新两张表，thegroup, benzi(groupurl)
		if($benziurl==""){//本子外链优先
			if(GetFiletype($f['name'])!='.'){//上传了头像
      			$dest_dir='../upload';//设定上传目录 
      			$timestamp=date("y m d h m s");
      			$filetype=GetFiletype($f['name']);
      			//$filename=iconv("utf-8","gbk",$f['name']); 
      			$thepic=$dest_dir.'/'.$timestamp.$filetype;//设置文件名为日期加上文件名避免重复 
      			$r=move_uploaded_file($f['tmp_name'],$thepic); 
      			chmod($thepic, 0755);//设定上传的文件的属性

				$sql1 = "UPDATE benzi SET name = '".$name."', author='".$author."', orient='".$orient."', benziurl='".$thepic."', theme='".$theme."',price='".$price."',amount='".$amount."' WHERE id='$benziid'";
				$result1=$db->query($sql1);
				if(($result1==null)){
					echo "<script>alert('数据库维护中...请稍后重试');</script>";
				}
				else{
					echo "<script>alert('success');</script>";
				}
			}
			else{//没有上传头像
				$sql1 =  "UPDATE benzi SET name = '".$name."', author='".$author."', orient='".$orient."', theme='".$theme."',price='".$price."',amount='".$amount."' WHERE id='$benziid'";
				$result1=$db->query($sql1);
				if($result1==null){
					echo "<script>alert('数据库维护中...请稍后重试');</script>";
				}
				else{
					echo "<script>alert('success');</script>";
				}
			
			}	 
		}
		else{//有外链
			$sql1 = "UPDATE benzi SET name = '".$name."', author='".$author."', orient='".$orient."', benziurl='".$benziurl."', theme='".$theme."',price='".$price."',amount='".$amount."' WHERE id='$benziid'";
			$result1=$db->query($sql1);
			if(($result1==null)){
				echo "<script>alert('数据库维护中...请稍后重试');</script>";
			}
			else{
				echo "<script>alert('success');</script>";
			}
		}
		  	
?>
<script>
	window.location.href="editwa.php";
</script>
