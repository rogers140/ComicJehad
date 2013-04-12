<?php
	$input=$_POST['input'];
require('config.php');
	$db=new mysqli($host,$user,$dbpassword,$database);
	if (mysqli_connect_errno()) 
	{
		echo 'Error: Could not connect to database. Please try again later.';
		exit;
	}
	$db->query("set names 'utf8'");
	$sql="SELECT * FROM benzi WHERE display=2 AND 
		( name LIKE '%".$input."%' OR groupname LIKE '%".$input."%' OR author LIKE '%".$input."%') ORDER BY groupname ASC";
	$result=$db->query($sql);
	if($result==null){
  		echo "search error";
	}
	else{
  		$totalrow=$result->num_rows;
  		//echo "<script>alert('".$totalrow."')</script>";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>南京-ComicJehad</title>
<link href="../style/common.css" rel="stylesheet" type="text/css" />
<link href="../style/benzi.css" rel="stylesheet" type="text/css" />
</head>
<body id="bg"  >
  <div id = "container">
      <div class ="top"><img src="../pic/TOP.gif" /></div>
        <div class = "main">
          <div class = "left">
            <div class="logo" ><img id="bg" src="../pic/logo.gif" /></div>
              <div id="item" align="center" ><a href="info.php">最新情报</a></div>
              <div id="item" align="center" ><a href="../pages/enroll.php">社团报名</a></div>
              <div id="item" align="center"><a href="../pages/benzi.php">本子信息</a></div>
              <div id="item" align="center"><a href="../pages/review.html">历届回顾</a></div>
              <div id="item" align="center"><a href="aboutus.php">关于我们</a></div>
            </div>
            <div class = "content">
              <div id="header"><img src="../pic/header3.gif" /></div>
              <div>
                <span>
                  &nbsp;&nbsp;<?php echo "已登录 <span> $totalrow</span> 件参展物" ?>
                  <br/>
                  &nbsp;
                  <form action="search.php" method="post">
                  <input type="text" name="input"/>
                  <input type="submit" value="查询本子"/>
                </form>
                </span>
              </div>
              <table id="tab0">
              
                <tr>
                  <th>出摊</th>
                  <th>同人志</th>
                  <th>计算费用</th>
                </tr>
                <?php
                  $totalprice=0;
                  $j=0;
                  echo "<script type='text/javascript'>
                            var pricelist=[];
                            var totalprice=0;
                            var listsize=0;
                          </script>";
                          echo "<script type='text/javascript'>
                                  function change(obj){
                                    totalprice=0;
                                    for(var i=0;i<listsize;i++){
                                      var num=window.document.getElementById('select'+i).selectedIndex;
                                      totalprice+=num*pricelist[i];
                                    }
                                    price.innerHTML=totalprice;
                                  }
                                </script>";
                  while($row=$result->fetch_assoc()){
                    echo "<tr>
                            <td class='tab1'>
                              <a href=''>".$row['groupname']."</a><br>
                              <a href=''><img src='".$row['groupurl']."' width='100' height='100'></a>
                            </td>
                            <td>
                            <table class='tab2'>
                              <tr>
                                <td class='tabI'>
                                  <img alt='本子图片' src='".$row['benziurl']."' width='120' height='120'>
                                </td>
                                <td class='tabT'>
                                  <span class='spnGray'>志名：".$row['name']."</span><br/>
                                  <span class='spnGray'>出品：".$row['groupname']."</span><br/>
                                  <span class='spnGray'>原作：".$row['author']."</span><br/>
                                  <span class='spnGray'>价格：".$row['price']." RMB</span><br/>
                                  <span class='spnGray'>数量：".$row['amount']."</span>
                                </td>
                              </tr>
                             </table>
                            </td>
                            <td align='center' >
                              <span class='spnGray'>购买：
                              <select id=select".$j." onchange='change(this)'>";
                    for ($i=0; $i < $row['amount']; $i++) { 
                      echo "<option >".$i."</option>";
                    }
                    echo "<option>".$i."</option>";            
                    echo "</select>份</span></td></tr>";
                    echo "<script type='text/javascript'>
                              pricelist.push(".$row['price'].");
                              listsize++;
                          </script>";
                    $j=$j+1;
                  }

                ?>
              </table>
            </div>
        </div>

<div class="w">
  <div class="t">总价格</div>

  <?php
    echo "<div class='winBody'>";
    echo "<span id=price>0</span>";
    echo " 元</div> ";
  ?>
  

</div>
<script language="javascript">
new function(w,b,c,d,o){
  d=document;b=d.body;o=b.childNodes;c="className";
  b.appendChild(w=d.createElement("div"))[c]= "b";
  for(var i=0; i<o.length-1; i++)if(o[i][c]!="w")w.appendChild(o[i]),i--;
  (window.onresize = function(){
    w.style.width = d.documentElement.clientWidth + "px";
    w.style.height = d.documentElement.clientHeight + "px";
  })();
}
</script>


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