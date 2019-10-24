
<?php
include_once("../conn.php");
$id=$_GET['id'];
$sql= "select * from cFile_table where file_id=".$id;

$result=mysqli_query($conn,$sql);
if($rows =mysqli_fetch_array($result)){
	$file_path=$rows['file_path'];
	$date=iconv('utf-8',"gbk//IGNORE",$file_path);
	unlink($date);
	$result1=mysqli_query($conn,"delete from cFile_table where file_id=".$id);
	
	echo "<script>alert('删除成功！'); window.location.href='../classResour.php'</script>";
	
}else{
	echo "<script>alert('删除失败！');window.location.href='../classResour.php'</script>";
	
	}
	
?>
