<?php
require('config.php');
$id=$_POST['id'];
$db=new mysqli($host,$user,$dbpassword,$database);
$db->query("set names 'utf8'");
$sql="DELETE FROM benzi where id=".$id.";";
$db->query($sql);
echo 'true';
?>