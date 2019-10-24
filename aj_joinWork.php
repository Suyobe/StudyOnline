<?php
	header('Content-type:text/html;charset=GB2312');
	include_once("conn.php");
	
	if(isset($_GET['title'])&&isset($_GET['time'])&&isset($_GET['content'])&&isset($_GET['wid'])&&isset($_GET['cid'])&&isset($_GET['username'])){
		
		$sqlstr2 = "select Sname from Grade_tb where Cid = ".$_GET['cid'];
		$result2 = mysqli_query($conn,$sqlstr2);
		$num= mysqli_num_rows($result2);
		
		if($num>0){
			$sqlstr1 = "insert into  Work_tb (Wid , title , content ,cid , Tid , time ) values (".$_GET['wid']." , '".$_GET['title']."' , '".$_GET['content']."' , ".$_GET['cid']." , '".$_GET['username']."' , '".$_GET['time']."') ";
			$result1 = mysqli_query($conn,$sqlstr1);
			while($rows =mysqli_fetch_array($result2)){
				$sqlstr3 = "insert into Score_tb ( Wid , Sname , score ) values ( ".$_GET['wid']." , '".$rows[0]."' , null)";
				$result3 = mysqli_query($conn,$sqlstr3);
				if($result3){
					echo "<script>";  
					echo "window.location.href='classWork.php';"; 
					echo "</script>"; 	
				}else{
					echo "error";
				}
			}
			
		}else{
			echo "<script>";  
			echo "window.location.href='classWork.php';"; 
			echo "alert('No students found');";
			echo "</script>"; 
		}
	}

	if(isset($_POST['Sname'])&& !empty($_FILES['upfiles']['name'])){
		$fileinfo = $_FILES['upfiles'];
			if($fileinfo['size']>0){
//				$str = dirname(__FILE__);
//				$path = "G:/wampserver/www/StudyOnline/Sfiles/".$_FILES['upfiles']['name'];
				$path = $_SERVER['DOCUMENT_ROOT']."/StudyOnline/Sfiles/".$_FILES['upfiles']['name'];
				$sqlstr1 = "insert into wFile_tb ( Wid , Sname , file_path ) values (".$_POST['Workid']." ,'".$_POST['Sname']."','".$path."')";
				$result1 = mysqli_query($conn,$sqlstr1);
				if($result1){
					move_uploaded_file($_FILES['upfiles']['tmp_name'],$path);
					echo "<script>";
					echo "alert('Submitted successfully');window.location.href='myWork.php'; ";	
					echo "</script>";
				}else{
					echo "<script>alert('Repeat submit'); window.location.href='myWork.php'; </script>";
					
				}
			}
	}
	
	if(isset($_GET['Score'])&&isset($_GET['SN'])){
		
		$sqlstr5 = "update Score_tb set score = ".$_GET['Score']."  where Sname = '".$_GET['SN']."'";
		$result5 = mysqli_query($conn,$sqlstr5);
		if($result5){
			echo $_GET['Score'];
		}
	}
	
	
	if(isset($_POST['Mess'])&&isset($_POST['Username'])&&isset($_POST['Time'])&&isset($_POST['Cid'])){
		$message = $_POST['Mess'];
		$username = $_POST['Username'];
		$time = $_POST['Time'];
		$cid = $_POST['Cid'];
	 	$sqlstr = "insert into msg_tb (Cid , sname, creatertime , content) values($cid,'$username ','$time','$message')";
		$result = mysqli_query($conn,$sqlstr);	
		if($result){
			echo $message.$username;
		} 
		
		
	}
	
	if(isset($_POST['Cid'])&&isset($_POST['Data'])&&isset($_POST['Time'])){
		$cid = $_POST['Cid'];
		$data = $_POST['Data'];//直接用post方法接值就可以
		$time = $_POST['Time'];
		$datas = json_decode($data, true);
		foreach($datas as $key => $value){
			$sqlstr = "insert into attendance_tb (Cid ,  sname,  ".$time." ) values( ".$cid." , '".$key."', '".$value."'  )";
			$result = mysqli_query($conn,$sqlstr);	
		}
		if($result)
			echo "ok";
		else
			echo "erro";
	}
	
	if(isset($_POST['Times'])){
		$time = $_POST['Times'];
		
		$sqlstr = "alter table attendance_tb add ".$time." varchar(20)";
		$result = mysqli_query($conn,$sqlstr);	
		if($result)
			echo "ok";
		else
			echo $time;
		
	}
	
	

?>
