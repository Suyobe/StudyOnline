<?php 
	$host = "127.0.0.1";
	$sqluserName = "root";
	$sqlpassword = "1711520";
	$conn = mysqli_connect($host,$sqluserName,$sqlpassword) or die("连接失败！".mysqli_error());
	mysqli_select_db($conn,"studySystem_db") or die("选择失败！".mysqli_error());
	$reS = mysqli_query($conn,"set names 'utf8'"); 
?>