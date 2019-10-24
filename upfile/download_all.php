<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>打包下载</title>
</head>

<body>
<?php 
include_once("../conn.php");

$wid = $_GET['Wid'];

$sql= "select * from wFile_tb where Wid =".$wid;
$result=mysqli_query($conn,$sql);
$ar=array();
while($rows =mysqli_fetch_array($result)){
$file_path=$rows['file_path'];
$filepath=iconv('utf-8',"gbk//IGNORE",$file_path);
$ar[]=$filepath;	

}

	
$filename = "test.zip";

if(!file_exists($filename)){
 $zip = new ZipArchive();
 if ($zip->open($filename, ZipArchive::CREATE)==TRUE) {
  foreach( $ar as $val){
   if(file_exists($val)){
//解决路径文件中文名
	$res = preg_replace('/^(.+[\\/])|(\\/)/', '', $val);	
//
    $zip->addFile( $val, $res);
   }
  }
  $zip->close();
 }
}
if(!file_exists($filename)){
 exit("无法找到文件");
}
header("Cache-Control: public");
header("Content-Description: File Transfer");
header('Content-disposition: attachment; filename='.basename($filename)); //文件名
header("Content-Type: application/zip"); //zip格式的
header("Content-Transfer-Encoding: binary"); //告诉浏览器，这是二进制文件
header('Content-Length: '. filesize($filename)); //告诉浏览器，文件大小
//解决文件格式损坏和文件乱码
ob_clean();
flush();
//
readfile($filename);
//如不删除，则在服务器上会有 $filename 这个zip文件
unlink ( $filename );

?>
</body>
</html>