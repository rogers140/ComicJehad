<?php
session_start(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>南京-ComicJehad</title>
<link href="../style/common.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../style/thickbox.css" type="text/css" media="screen" />
</head>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/thickbox.js">
    
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
	$id=$_SESSION['id'];
	$_SESSION['benziid'] = $id;
    //edit on 9.19
    $benziurl=$_POST['benziurl'];
    echo "ok".$benziurl;
    //edit on 9.19
	$sql = "select * from benzi where id='$id'";
	$result = $db->query($sql);
	$row = $result->fetch_row();
	$name = $row[1];
	$groupname = $row[2];
	$groupurl = $row[3];
	$author	 = $row[4];
	$thepic =  $row[5];	
	$orient = $row[7];
	$proxy = $row[9];
	$theme	 = $row[10];
	$price = $row[11];
	$amount = $row[12];
	$display = $row[13];
    
?>
<script language="javascript">
	function start(){
		//groupurl.innerHTML="<img src='"+info.groupurl+"' width='100' height='100'>";
		document.getElementsByTagName("select")[0].value="<?php echo $orient;?>";
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
                <form name="send" id="send" method="post" action="finisheditbenzi.php" enctype="multipart/form-data" >	
            	<table align="center" cellpadding = "5">
            		<tr>
            			<td>作品名称：</td>
            			<td><input name="name" type="text"  id="name" value="<?php echo $name;?>"></td>
            		</tr>
            		<tr>
            			<td>原作品：</td>
            			<td><input name="author" type="text"  id="author" value="<?php echo $author;?>"></td>
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
                      <td>本子封面图片：</td>
                      <td id='groupurl'>
                        <img src="<?php echo $thepic;?>" width="100px" height="100px">
                      </td>
                     <td><input type="hidden" name="MAX_FILE_SIZE" value="500000" /><input name="pic" type="file" id="pic" multiple><font size='2' color='red'>[大小不超过300kb]</font></td>
                            <script type="text/javascript">
                            document.getElementById('pic').addEventListener('change', handleFileSelect, false);
                            </script>
                    </tr>
                    <tr><td>新外链:</td><td><input type='text' name='benziurl'></td></tr>
                    <tr>
                        <td>主题：</td>
                        <td><input type="text" name="theme" id="theme" value="<?php echo $theme;?>"></td>
                    </tr>
                    <tr>
                        <td>价格：</td>
                        <td><input type="text" name="price" id="price" value="<?php echo $price;?>"></td>
                    </tr>
                    <tr>
                        <td>数量：</td>
                        <td><input type="text" name="amount" id="amount" value="<?php echo $amount;?>"></td>
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
