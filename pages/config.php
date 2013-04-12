<?php
$host='localhost';
$user='comicjehad';
$dbpassword='DXsxmm2yMF8cNyX0';
$database='comicjehad';

function GetFiletype($filename){
 $filer=explode(".",$filename);
 $count=count($filer)-1;
 return strtolower(".".$filer[$count]);
}
?>