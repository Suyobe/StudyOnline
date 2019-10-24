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
                            <a onclick="singup()" class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        <li> <a class="waves-effect waves-dark" href="index.php" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">创建的课程</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="myStudy.php" aria-expanded="false"><i class="mdi mdi-account-check"></i><span class="hide-menu">学习的课程</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="findClass.php" aria-expanded="false"><i class="mdi mdi-account-check"></i><span class="hide-menu">加入课程</span></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0"><?php echo $_SESSION['cname'];?> </h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">布置作业</li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-4 align-self-center">
                        <a href="newClass.html" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down"> 创建新课程</a>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-12"  >
                        <div class="card" >
                           	<div class="card-block" align="center" >
                             	<div class="other" style="font-size:20px;  height:50px;line-height : 50px ;" >
									<a href="classResour.php" style="padding-right: 50px ;"  href="#" >课程资源</a>
									<a href="classWork.php" style="padding-right: 50px ;" href="#" >课程作业</a>
									<a href="attendance.php" style="padding-right: 50px ;" href="" >考勤</a>
									<a href="messageBoard.php" style="padding-right: 50px ;" href="" >留言板</a>
								</div> 
								<div class='' align="center" style=" width:900px;background-color: #F9F9F9;">
									
									
									<div class="managehr" style="margin:20px;margin-top: 25px;border: none;border-top: 1px dashed #399;background-color: white;"></div>	
									
									<table border="0" cellspacing="" cellpadding="20px">
	                            		<form id="form" name="form" method="get" action="aj_joinWork.php">
		                            		<tr align="center"><img src="assets/images/xiaohui.png" width="150px"/><br><br>作业内容 <br></tr>
		                            		<tr><td>作业标题 ： </td><td><input type="text" id="title" name="title" /></td></tr>
		                            		<tr><td>截止时间 ： </td><td><input type="text" id="time" name="time" /></td></tr>
		                            		<tr><td>作业内容： </td><td ><textarea   id="content" name="content"></textarea ></td></tr>
		                            		<tr>
		                            			<td><input type="hidden" id="wid" name="wid" value="<?php echo $_GET['num'];?>" /></td> 
		                            			<td><input type="hidden" id="cid" name="cid" value="<?php echo $_SESSION['cid'];?>" /></td>
		                            			<td><input type="hidden" id="username" name="username" value="<?php echo $username;?>" /></td>
		                            			<td><input type="submit" id="submit" name="sumbit" value="提交" /> </td>
		                            			<td><input type="reset" id="reset" name="reset" value="重置" /> </td>
		                            		</tr>
	                            		</form>
	                            	</table>
									
									
									
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
