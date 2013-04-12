<?php
//加上session,获得username
require('config.php');

session_start();
$username=$_SESSION['username'];
//获得groupname

//$idlist1=$_POST['list1'];
//$idlist2=$_POST['list2'];
$db=new mysqli($host,$user,$dbpassword,$database);
$db->query("set names 'utf8'");
$sql = "SELECT * FROM user WHERE username='".$username."';";
$result=$db->query($sql);

//echo $result;
$row=$result->fetch_row();
$groupname=$row[3];

//$groupname="小花事务所";//通过数据库找到
$orient=$_POST['orient'];
$buddygroup=$_POST['buddygroup'];
$placenum=$_POST['placenum'];
$remark=$_POST['remark'];
$area=$_POST['area'];
if($area==0){//纯本区将其提交的非本子display改为0
	$sql="UPDATE benzi SET display=0 WHERE type<>0 AND groupname='".$groupname."';";
	$db->query($sql);
}
$sql="UPDATE thegroup SET area=".$area.",orient='".$orient."',buddygroup='".$buddygroup."',placenum=".$placenum.",remark='".$remark."' WHERE username='".$username."';";
//$sql="UPDATE thegroup SET orient='宅' WHERE id=1;";
$db->query($sql);
echo $groupname;
?>
