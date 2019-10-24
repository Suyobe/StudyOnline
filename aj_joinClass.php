<?php
	header('Content-type:text/html;charset=GB2312');
	include_once("conn.php");
	
	if(isset($_POST['Stuid'])||isset($_POST['Stuname'])||isset($_POST['Stupsd'])||isset($_POST['Claid'])){
		
		$sqlstr1 = "select * from Class_tb where Cid = ".$_POST['Claid']." and password = '".$_POST['Stupsd']."'";
		$result1 = mysqli_query($conn,$sqlstr1);
		$nums = mysqli_num_rows($result1);
		if($nums>0){
			$sqlstr2 = "insert  into Grade_tb ( Cid , Sid , Sname ) values ( ".$_POST['Claid']."  , ".$_POST['Stuid']." , '".$_POST['Stuname']."' )";
			$result2 = mysqli_query($conn,$sqlstr2);
			if($result2){
				echo $_POST['Claid'];
			}
		}else{
			echo "Password mistake";
		}
		
		
	}


?>