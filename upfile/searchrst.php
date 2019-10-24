<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查询</title>
<style>
	.noticeNull{
	margin-top: 20px;
    margin-left: 30px;
    color: #999;
    font-size: 16px;
		}
</style>
</head>

<body>
<script type="text/javascript">
 var xmlHttp;				//定义XMLHttpRequest对象
function createXmlHttpRequestObject(){
	//如果在internet Explorer下运行
	if(window.ActiveXObject){
		try{
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}catch(e){
			xmlHttp=false;
		}

	}else{
	//如果在Mozilla或其他的浏览器下运行
		try{
			xmlHttp=new XMLHttpRequest();
		}catch(e){
			xmlHttp=false;
		}
	}
	 //返回创建的对象或显示错误信息
	if(!xmlHttp)
		alert("返回创建的对象或显示错误信息");
		else
		return xmlHttp;
}
function showsimple2(url){
	createXmlHttpRequestObject();
	console.log("aaa");
		xmlHttp.onreadystatechange=StatHandler2;	//判断URL调用的状态值并处理
		xmlHttp.open("GET",url,false);
		xmlHttp.send(null);	

}
function StatHandler2(){
	if(xmlHttp.readyState==4 && xmlHttp.status==200){	
	console.log("555");	
		document.getElementById("test1").style.display="none";
		document.getElementById("test1").innerHTML=xmlHttp.responseText;
		document.getElementById("test1").style.display="inline";
	}
}

</script>
<?php
	include_once("../conn.php");
	/*$cont = iconv('UTF-8','gb2312',$_GET['cont']);*/
	$cont = $_GET['cont'];
	
	
	if(!empty($_GET['cont'] )){								//判断如果关键字不为空
		$pagesize=3;  //每页显示记录数
 		$sqlstr="select * from cFile_table where file_type='".$cont."' order by file_id desc";
 		$total=mysqli_query($conn,$sqlstr);
  		$totalNum= mysqli_num_rows($total);//总记录数
   		$pagecount=ceil($totalNum/$pagesize);
 		(!isset($_GET['page']))?($page=1):$page=$_GET['page'];//当前页数
   		($page<=$pagecount)?$page:($page=$pagecount);
   		$f_pageNum=$pagesize*($page-1); //当前页的第一条记录
   
    $sqlstr1=$sqlstr." limit ".$f_pageNum.",".$pagesize;//定义sql语句，通过limit关键字控制查询范围和数量
    $result=mysqli_query($conn,$sqlstr1);
	if(!$result){
		
		echo "<div class='noticeNull' style='float: right; width: 560px;'>暂无可下载的教学资源!</div>";
		}
		else{/*if(mysqli_num_rows($result)>0){*/
?>
		<div class="test1" id="test1">		
<?php
 			while($rows=mysqli_fetch_array($result)){ 						//循环输出查询结果
?>
 		<div class="show_list">
	<div class="list"> 
    <a href="download.php?id=<?php echo $rows['file_id'];?>"  target="_blank"><?php echo $rows['file_name'];?></a>
    	<p class="list_title">
   		<span class="gap">发布人：<?php echo $rows['file_author'];?> &nbsp;|&nbsp; 上传时间：<?php echo $rows['file_time'];?> &nbsp;|&nbsp; 文件大小: <?php echo $rows['file_size'];?> <a href="javascript:del(<?php echo $rows['file_id']?>)" style="float:right;">删除</a></span>
  	 	</p> 
    </div> 
</div>
 
<?php	
			}
			
?>
<div class="pages" ><span>
	<?php 
		echo "共".$totalNum."条记录&nbsp;&nbsp;" ;
		echo "第".$page."页/共".$pagecount."页&nbsp;&nbsp;";
		if($page!=1){
?>
			<a href="javascript:showsimple2('./upfile/searchrst.php?page=1')">首页</a>&nbsp;
			<a href="javascript:showsimple2('./upfile/searchrst.php?page=<?php echo ($page-1);?>')">上一页</a>&nbsp;&nbsp;
<?php			
			}else{
				echo "首页&nbsp;上一页&nbsp;&nbsp;";
				
				}
		if($page!=$pagecount){
?>			
			<a href="javascript:showsimple2('./upfile/searchrst.php?page=<?php echo ($page+1);?>')">下一页</a>&nbsp;&nbsp;
			<a href="javascript:showsimple2('./upfile/searchrst.php?page=<?php echo $pagecount;?>')">尾页</a>&nbsp;&nbsp;
			
<?php			}else{
				echo "下一页&nbsp;尾页&nbsp;&nbsp;";
				
				}
	
	
	?></span></div>
    </div>
<?php
		}
		}
		
?>
<!--<div class="noticeNull" style="float: right; width: 560px;">暂无可下载的教学资源!</div>-->


</body>
</html>