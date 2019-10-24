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
		//$_SESSION['username'] = $username;
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
                            <a onclick="signup()" class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            	<img src="assets/images/user.jpg" alt="user" class="profile-pic m-r-10" /><?php echo $username; ?></a>
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
                        <h3 class="text-themecolor m-b-0 m-t-0">学习的课程</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">学习的课程</li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-4 align-self-center">
                        <a href="newClass.php" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down"> 创建新课程</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block" style="float:left;">
                             <?php  
										$sqlstr = "select * from Class_tb where Cid in (select Cid from  Grade_tb  where  Sname = '".$username."'  ) ";
										$result = mysqli_query($conn,$sqlstr);
										$nums = mysqli_num_rows($result);
							?>
                            
                            	<div class="tabs_stc">正在学习<a id="manage_num"> &nbsp;<?php echo $nums; ?>&nbsp; </a>门课程<br/>&nbsp;</div>
                             	<table class="datalist" style="margin-left:100px;" id="datalist1">
                             		<tbody id="createCourse">
                            <?php
                                if($nums>0){
                                    while($rows = mysqli_fetch_array($result)){
										$cid = $rows[0];
										$_SESSION['cid'] = $rows[0];
										$_SESSION['cname'] = $rows[1];
                            ?>
                             			<!--start-->
                             			<tr style="border:1px solid #d1d1d1;width:208px;float:left;margin-right:23px;margin-bottom:20px;margin-top:5px;">
                             				<td style="width:208px;">
                             					<div style="width:208px;background:white;position:relative;" id="evlist0" >
                             						<a target="_blank" href="myResour.php"><img src="assets/images/user.jpg" height="160px" width="208px"></a>
                             						<div class="effect">
                             							课程名：<a href="myResour.php" class="evlistTitle" target="_blank" href=""><?php echo  $rows[1];?></a>
                             						</div>
                             						<div class="effect">
                             							创建人：<a class="evlistTitle"  href="#"><?php echo $rows[3]; ?></a>
                             						</div>
                             						<div class="mng_group">
                             							<a class="btn_backmanage" target="_blank" href="myResour.php" title="进入课程"><i></i><span>进入课程</span></a>
                             							<a class="btn_del" onclick="del(<?php echo $cid ?>)" title="注销课程" style=""><i></i><span style="float:right;cursor:pointer;">退出</span></a>
                             						</div>
                             					</div>
                             				</td>
                             			</tr>
                             			<!--end-->
                            <?php
									}
								}else{
									echo "<p>还没有你学习的课程，你可以<a href='findClass.php'>去加入课程</a></p>";
								}
                            ?> 
                             		</tbody>
  									
 								</table>
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
    	function del(cid){
			if(confirm("确定退出吗？")){
				var xml;
				if(window.ActiveXObject){
					xml = new ActiveXObject('Microsoft.XMLHTTP');
				}else if(window.XMLHttpRequest){
					xml = new XMLHttpRequest();
				}
				xml.open("GET",'aj_delClass.php?scid='+cid,true);
				xml.onreadystatechange = function(){
					if(xml.readyState==4&&xml.status==200){
						var msg = xml.responseText;
						if(msg==cid){
							alert("退出成功！");
							location.reload();
						}else{
							alert("退出失败!");
							return false;
						}
					}
				}
				xml.send(null);
			}else{
			 //取消
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
