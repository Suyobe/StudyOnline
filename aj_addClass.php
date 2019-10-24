<?php
	include_once("conn.php");
	if(isset($_POST['cid'])||isset($_POST['cname'])||isset($_POST['cpsd'])||isset($_POST['uname'])){
		$sqlstr = "insert into Class_tb (Cid , Cname, password ,Tid ) values(".$_POST['cid'].",'".$_POST['cname']."', 
				'".$_POST['cpsd']."', '".$_POST['uname']."')";
		$result = mysqli_query($conn,$sqlstr);
		if($result){
			echo "<script language='javascript'type='text/javascript'>";  
			echo "window.location.href='index.php'"; 
			echo "</script>"; 	
		} else{
			echo "<script language='javascript'type='text/javascript'>";  
			echo "alert('请确认信息');";
			echo "window.location.href='newClass.php'"; 
			echo "</script>"; 
//			echo $_POST['cid'].$_POST['cname'].$_POST['cpsd'].$_POST['uname'] ;
		}
	}


?>