<?php 
	function checkSafe(){
		//定义不允许提交的SQL命令及关键字
		$word = array();
		$word[]  = " add ";
		$word[] = " count ";
		$word[] = " create ";
		$word[] = " delete ";
		$word[] = " drop ";
		$word[] = " from ";
		$word[] = " grant ";
		$word[] = " insert ";
		$word[] = " select ";
		$word[] = " truncate ";
		$word[] = " update ";
		$word[] = " use ";
		$word[] = "-- ";
		echo "fuck!";
		//判断提交的数据中是否存在以上关键字
		 foreach($_REQUEST as  $strGot){
			 $strGot = strtolower($strGot);
			 foreach($word as $word){
				 if(strstr($strGot,$word)){
					 echo "您输入的内容含有非法字符!";
					 exit;
					 }
				 }
			 }
		checkSafe();//在本文件被包含时即自动调用.
		}
?>