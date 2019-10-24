<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查询操作</title>
</head>

<body>
<?php 
include_once("../conn.php");

	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$sql= "select * from cFile_table where file_id=".$id;
		$result=mysqli_query($conn,$sql);
		while($rows =mysqli_fetch_array($result)){
			$file_path=$rows['file_path'];
			$file_name=$rows['file_name'];
			$filename= iconv('utf-8',"gbk//IGNORE",$file_name);
			$filepath=iconv('utf-8',"gbk//IGNORE",$file_path);
			$filesize=filesize($filepath);
			header("Content-type:text/html;charset=utf-8");
			header("Content-Type:application/octet-stream");
			header("Accept-Ranges:bytes");
			header("Accept-Length:".$filesize);
			header("Content-Disposition:attachment;filename = ".$file_name);
			ob_clean();
			flush();
			readfile($filepath);
		}
	}
	if(isset($_GET['fid'])){
		$filepath=$_GET['fid'];
		$filename= $filepath;
		$filesize=filesize($filepath);
		header("Content-type:text/html;charset=utf-8");
		header("Content-Type:application/octet-stream");
		header("Accept-Ranges:bytes");
		header("Accept-Length:".$filesize);
		header("Content-Disposition:attachment;filename = ".$filename);
		ob_clean();
		flush();
		readfile($filepath);
	}
?>   
</body>
</html>