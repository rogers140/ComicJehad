<?php 
	//连接到数据库
require('config.php');
$db=new mysqli($host,$user,$dbpassword,$database);
if (mysqli_connect_errno()){
		echo 'Error: Could not connect to database. Please try again later.';
		exit;
	}
$db->query("set names 'utf8'");
$sql = "select * from user";
$result = $db->query($sql);
$count=0;
$userarray=array();
$grouparray=array();
while($row = $result->fetch_row()){
	$username=$row[1];
	$groupname=$row[3];
	array_push($userarray,$username);
	array_push($grouparray,$groupname);
	$count=$count+1;
}
$neednumber=0;
for($i=0;$i<$count;$i++){
	$sql="select * from thegroup where username='".$userarray[$i]."'";
	$result=$db->query($sql);
	$number=$result->num_rows;
	if($number>1){
		$neednumber=$neednumber+1;
		echo " ".$userarray[$i];
	}
	else{continue;}
}
echo $neednumber;
?>