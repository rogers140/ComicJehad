<?php
require('config.php');
$idlist1=$_POST['list1'];
$idlist2=$_POST['list2'];
$db=new mysqli($host,$user,$dbpassword,$database);
$db->query("set names 'utf8'");

for($i=0;$i<count($idlist1);$i++){
	$id=$idlist1[$i];
	$takepart=false;
	for($j=0;$j<count($idlist2);$j++){
		if($id==$idlist2[$j]){//参加了活动
			$takepart=true;
			break;
		}
	}
	if(!$takepart){//如果没有参加活动，display设为0
		$sql="UPDATE benzi SET display=0 WHERE id=".$id.";";
		$db->query($sql);
	}
}
for($i=0;$i<count($idlist2);$i++){
	$id=$idlist2[$i];//将参加活动的本子中display=0的改成1
	$sql="UPDATE benzi SET display=1 WHERE display=0 AND id=".$id.";";
	$db->query($sql);
}
echo count($idlist2);
?>