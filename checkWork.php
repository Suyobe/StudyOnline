<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<body>
	</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/xiaohui.png">
    <title></title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/blue.css" id="theme" rel="stylesheet">
<![endif]-->
</head>
<?php  //检测用户登录情况
	session_start(); 
	include_once("conn.php");
//	$_SESSION['username'] = "Suyobe"; // 测试用
	if(!isset($_SESSION['username'])){ 
		echo "<script language='javascript'type='text/javascript'>";  
		echo "window.location.href='login.html'"; 
		echo "</script>";  
	}else{							//有session
		$username = $_SESSION['username'];
//		$_SESSION['username'] = $username;
	}
	if(isset($_GET['Wid'])){
		//$wid  = 33;//测试用
		$wid = $_GET['Wid'];
	}
?>
<body class="fix-header fix-sidebar card-no-border">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="">
                       <b><img style="width: 50px;" src="assets/images/xiaohui.png" alt="homepage" class="light-logo" /></b>
                        <span style="color: white;">
                        	&nbsp;&nbsp;在线学习网站
                        </span> 
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                         <li class="nav-item hidden-sm-down search-box"> </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a onclick="signup" class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            	<img src="assets/images/user.jpg" alt="user" class="profile-pic m-r-10" /><?php echo $username;?></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <ul id="sidebarnav">
                        <li> <a class="waves-effect waves-dark" href="index.php" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">创建的课程</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="myStudy.php" aria-expanded="false"><i class="mdi mdi-account-check"></i><span class="hide-menu">学习的课程</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="findClass.php" aria-expanded="false"><i class="mdi mdi-account-check"></i><span class="hide-menu">加入课程</span></a>
                        </li>
                    </ul>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0"><?php echo $_SESSION['cname'];?></h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">审阅作业</li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-4 align-self-center">
                        <a href="newClass.php" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down"> 创建新课程</a>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-12"  >
                        <div class="card" >
                            <div class="card-block" align="center" >
                             	<div class="other"  style=" font-size:20px;  height:50px;line-height : 50px ;" >
									<a href="classResour.php" style="padding-right: 50px ;"  href="#" >课程资源</a>
									<a href="classWork.php" style="padding-right: 50px ;" href="#" >课程作业</a>
									<a href="attendance.php" style="padding-right: 50px ;" href="" >考勤</a>
									<a href="messageBoard.php" style="padding-right: 50px ;" href="" >留言板</a>
								</div> 
								<div class='show_list' style=" width:900px;background-color: #F9F9F9;">
									
									<div class="content" style="margin:20px;margin-top: 30px;border: none;" align="left">
									<?php
										$sqlstr = "select * from Work_tb where Wid =".$wid." and cid ='".$_SESSION['cid']."'";	
										$result = mysqli_query($conn,$sqlstr);
										while($rows = mysqli_fetch_array($result)){
									?>
										<p>作业截止日期：<?php echo $rows['time'];?></p>
										<p>作业题目：<?php echo $rows['title'];?> </p>
										<p>作业内容：<?php echo $rows['content'];?></p>
									<?php
										}
									?>
									</div>
									<div class="managehr" style="margin:20px;margin-top: 25px;border: none;border-top: 1px dashed #399;background-color: white;"></div>	
									
									<table class="datalist" id="datalist" cellpadding="15px" cellspacing="10px" style="margin-bottom: 20px;">
										<tbody>
									<?php
										$sqlstr1 = "select wFile_tb.Sname ,file_path ,score from wFile_tb , Score_tb where wFile_tb.Wid=Score_tb.Wid and Score_tb.Sname = wFile_tb.Sname and wFile_tb.Wid = ".$wid;
										$result1 = mysqli_query($conn,$sqlstr1);
										$totalNum= mysqli_num_rows($result1);//总记录数
										if($totalNum>0){
									?>	  	
											<tr>
											  	<th width="200px">姓名</th><th width="200px">附件</th><th width="250px">评分</th>
										  	</tr>
											<?php
												while($rows = mysqli_fetch_array($result1)){
											?>
											  	<!--start-->
												<tr class="altrow" style="border-top: 1px dashed #399;">
													<td >
														<span><?php echo $rows[0];?></span>
													</td>
													<td>
														<a href="./upfile/download.php?fid=<?php echo $rows[1];?>"><span>下载</span></a>
													</td>
													<td>
														<form >
															<?php
																if($rows[2]==""){
															?>
																<span>★&nbsp;</span><input type="text" id="score" name="score" style="width: 80px;" />
																<input type="button" onclick="send('<?php echo $rows[0];?>')"  value="确定" />
															<?php
																}else{
															?>
																<span>★<?php echo $rows[2];?>&nbsp;</span>
															<?php		
																}
															?>
														</form>
													</td>
												</tr>
												<!--end-->
									<?php
											}
										}else{
											echo "还没有人提交作业";
										}
									?>
										</tbody>
									</table>
									
									
									
								</div>
								<div class="pages" align="center">
									<span>共10条记录&nbsp;&nbsp;第1页/共4页&nbsp;&nbsp;<a href=''>首页</a>&nbsp;<a href=''>上一页</a>
										&nbsp;&nbsp;首页&nbsp;上一页&nbsp;&nbsp;<a href=''>下一页</a>&nbsp;&nbsp;<a href=''>尾页</a>&nbsp;&nbsp;下一页&nbsp;尾页&nbsp;&nbsp;
									</span>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
	function signup(){
    		if(confirm("确定注销吗？")){
    			window.location.href='logout.php';
    		}
    	}
	function send(name){
		
		var xml;
		if(window.ActiveXObject){
			xml = new ActiveXObject('Microsoft.XMLHTTP');
		}else if(window.XMLHttpRequest){
			xml = new XMLHttpRequest();
		}
		var sc = document.getElementById("score").value;
		
		if(sc==""){
			alert("请先填写分数!");
			return false;
		}
		if(sc>100 || sc<0){
			alert("请填写正确分数!");
			return false;
		}
		xml.open("GET",'aj_joinWork.php?Score='+sc+"&SN="+name,true);
		xml.onreadystatechange = function(){
			if(xml.readyState==4&&xml.status==200){
				var msg = xml.responseText;
				if(msg==sc){
					location.reload();
				}else{
					alert("添加失败!");
					return false;
				}
			}
		}
		xml.send(null);
		 
	}
</script>
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
</body>

</html>
