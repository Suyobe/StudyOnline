<?php 
	include_once("conn.php");
	
	if(isset($_GET['id'])){
		$cid = $_GET['id'];	 
		$sqlstr = mysqli_query($conn,"delete from Class_tb where cid =".$cid);
		if($sqlstr){
			echo $cid;
		} 
	}
	
	if(isset($_GET['scid'])){
		$cid = $_GET['scid'];	 
		$sqlstr = mysqli_query($conn,"delete from Grade_tb  where Cid =".$cid);
		if($sqlstr){
			echo $cid;
		} 
	}
	
	if(isset($_GET['Wid'])){
		$wid = $_GET['Wid'];	 
		$sqlstr = mysqli_query($conn,"delete from Work_tb  where Wid =".$wid);
		if($sqlstr){
			echo $wid;
		} 
	}
	
	

?>
