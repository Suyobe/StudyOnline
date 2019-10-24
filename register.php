<?php
	if(isset($_POST['user'])){
		$name = $_POST['user'];
		$password = $_POST['passwd2'];
		include_once("conn.php");
		$sqlstr = "insert into User_tb (Uid , password) values( '".$name."', '".$password."') ";
		$result = mysqli_query($conn,$sqlstr);
		if($result){
			echo "<script language='javascript'type='text/javascript'>";  
			echo "alert('注册成功');"; 
			echo "window.location.href='login.html'"; 
			echo "</script>";  
		}else{
			echo "<script language='javascript'type='text/javascript'>";  
			echo "alert('注册失败');"; 
			echo "window.location.href='login.html'"; 
			echo "</script>";  
		}
	}
?>