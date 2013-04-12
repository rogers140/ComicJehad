<?php
//加上session控制
require('config.php');
$idlist1=$_POST['list1'];
$idlist2=$_POST['list2'];
$db=new mysqli($host,$user,$dbpassword,$database);
$db->query("set names 'utf8'");

$submittedArray=$_POST['submitted'];
$passedArray=$_POST['passed'];
for($i=0;$i<count($submittedArray);$i++){
	if($submittedArray[$i]['display']==2){
		$sql="UPDATE benzi SET display=1 WHERE id=".$submittedArray[$i]['id'].";";
		$db->query($sql);
	}
}
for($i=0;$i<count($passedArray);$i++){
	$sql="UPDATE benzi SET display=2 WHERE id=".$passedArray[$i]['id'].";";
	$db->query($sql);
}
echo $submittedArray[0]['display'];
?>