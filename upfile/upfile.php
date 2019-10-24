<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上传文件</title>
</head>

<body>



<form action="" method="post" enctype="multipart/form-data">
<tr>
<td>请选择目录分类：</td>
<td width="250"><select name="file_type" id="file_type">
<option value="未分类资源" selected="selected">未分类资源 </option>
<option value="课件" >课件 </option>
<option value="实验指导书" >实验指导书 </option>
<option value="教学大纲" >教学大纲 </option>
<option value="模板" >模板 </option>
<option value="参考案例" >参考案例 </option>
</select>
</td>
</tr>
<tr>
<td width="150",height="30" align="right" valign="middle">请选择上传文件：</td>
<td width="250"><input type="file" name="up_file"  /></td>
<td width="250"><input type="submit" name="submit" value="上传" /> </td>
</tr>

</form>

<?php
	include_once("../conn.php");
	session_start(); 
//	$_SESSION['username'] = "Suyobe"; // 测试用
	if(!isset($_SESSION['username'])){ 
		echo "<script language='javascript'type='text/javascript'>";  
		echo "window.location.href='../login.html'"; 
		echo "</script>";  
	}else{							//有session
		$username = $_SESSION['username'];
		$_SESSION['username'] = $username;
	}
		
	
	if(!empty($_FILES['up_file']['name'])){
		$fileinfo=$_FILES['up_file'];
		if($fileinfo['size']<8388608 && $fileinfo['size']>0){//判断文件大小,不能超过8M
	
			 $name = iconv('utf-8','gb2312',$fileinfo['name']);  //利用Iconv函数对文件名进行重新编码,解决中文乱码	
			$path="../Tfiles/".$name; 
			$path1="../Tfiles/".$fileinfo['name']; 
			$f_size=$fileinfo['size'];
			if($f_size <=1024){
				$f_size=$fileinfo['size']."B";
				}else if($f_size >1024 && $f_size <=1048576){
				$f_size=round($f_size/1024,1)."KB";
				}else if($f_size >1048576){
					$f_size=round($f_size/1024/1024,2)."MB";
					}
			
			
			if(file_exists($path)){
				echo "文件已存在,请修改文件名后上传";
				}else{
			move_uploaded_file($fileinfo['tmp_name'],$path);
			
			$time=date("Y-m-d");
			$sql="insert into cFile_table(Cid ,file_name,file_path,file_type,file_time,file_size,file_author) values( ".$_GET['cid']." ,'".$fileinfo['name']."','".$path1."','".$_POST['file_type']."','".$time."','".$f_size."','".$username."')";			
			$result=mysqli_query($conn,$sql);
			
			if($result){
				echo "文件上传数据库成功，文件名为：".$fileinfo['name'];
				echo "<br>";
			}else{
				echo "文件上传数据库失败";
				}
				}
		}else{
				echo "文件大小超过8M";
				console.log("11111");
				}
		
		}
?>
</body>
</html>