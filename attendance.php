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
//	$_SESSION['cid'] = 16219; // 测试用
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
                        <h3 class="text-themecolor m-b-0 m-t-0"><?php echo $_SESSION['cname'];?></h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">课程考勤</li>
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
                             	<div class="other" style="font-size:20px;  height:50px;line-height : 50px ;" >
									<a href="classResour.php" style="padding-right: 50px ;"  href="#" >课程资源</a>
									<a href="classWork.php" style="padding-right: 50px ;" href="#" >课程作业</a>
									<a href="attendance.php" style="padding-right: 50px ;" href="" >考勤</a>
									<a href="messageBoard.php" style="padding-right: 50px ;" href="" >留言板</a>
								</div> 
								<div class='show_list' style=" width:900px;background-color: #F9F9F9;">
									<div class="button1"  >
										<a target="_blank" href="shwoAttendance.php" class="btn btn-primary pull-left" style=" width:80px;height:35px">查看考勤</a>
									</div>
									<div class="button1" align="right">
										<a href="#" onclick="news()" class="btn btn-primary pull-right" style=" width:80px;height:35px">新建考勤</a>
									</div>
									<div class="managehr" style="margin:20px;margin-top: 25px;border: none;border-top: 1px dashed #399;background-color: white;"></div>	
									<div >
										<h3 id="tit" >学生名单</h3>
										<form action="">
											<table cellpadding="5px" cellspacing="1px" style="margin-bottom: 30px;">
												<tr>
													<th width="250px">学号</th><th width="250px">姓名</th><th width="250px">日期</th>
												</tr>
									<?php
										$sqlstr = "select * from Grade_tb where Cid  =".$_SESSION['cid'];	
										$result = mysqli_query($conn,$sqlstr);
										$num= mysqli_num_rows($result);
										if($num>0){
											
											while($rows = mysqli_fetch_array($result)){
									?>
												
												<!--start-->
												<tr>
													<td><?php echo $rows[1];?></td><td id="stu"><?php echo $rows[2];?></td><td><select id="set" >
													 	<option selected value ="出勤">出勤</option>
													  	<option value ="迟到">迟到</option>
													  	<option value="请假">请假</option>
													  	<option value="旷课">旷课</option>
													</select></td>
												</tr>
												<!--end-->
									<?php
											}
										}else
											echo '<th class="noticeNull" style=" width: 560px;">该课程暂时没有学生加入</th>';
										
									?>
											</table>
										</form>
										<div align="center">
											<input  type="button" class="btn btn-primary "   id="sub" name="sub" value="确定" onclick="ins(<?php echo $_SESSION['cid'];?>)" />
										</div>
										
									</div>
									
									
									 
								 
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script   type="text/javascript">
    	function signup(){
    		if(confirm("确定注销吗？")){
    			window.location.href='logout.php';
    		}
    	}
    	function news(){
    		
    		var myDate = new Date();
		    var year = myDate.getFullYear();
		    var month = myDate.getMonth()+1 ;
		    var day = myDate.getDate();
		    
		    document.getElementById("tit").innerHTML = year+"-"+month+"-"+day;
    		time = "S"+year+month+day;
    		var xml;
			if(window.ActiveXObject){
				xml = new ActiveXObject('Microsoft.XMLHTTP');
			}else if(window.XMLHttpRequest){
				xml = new XMLHttpRequest();
			}
			var post_method = "Times="+time;		//构造URL参数
			xml.open("POST","aj_joinWork.php",true);						//调用指定的添加文件
			xml.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");	 //设置请求头信息
			xml.send(post_method);
			xml.onreadystatechange = function(){   //判断URL调用的状态值并处理
				if(xml.readyState==4&&xml.status==200){
					var msg = xml.responseText;
					if(msg =="ok"){
						alert(msg);
					}else
						alert("今天已经考勤了，放过学生吧"+msg);
					 
				}
			}		
    	}
    	
    	function ins(id){
   			var n = $('[id=set]').length; //出勤情况
   			var m = $('[id=stu]').length;	//名字
   			var cid = id;
   			
   			var data = {};
   			var name;
   			var stuts;
   			var myDate = new Date();
		    var year = myDate.getFullYear();
		    var month = myDate.getMonth()+1;
		    var day = myDate.getDate();
    		time = "S"+year+month+day;
   			
   			for(i=0;i<n ||i<m;i++){
   				
   				stuts= $('[id=set]')[i].value;
   				name = $('[id=stu]')[i].innerHTML;
   				data[name] = stuts ;
   			}
			var data = JSON.stringify(data);
			
    		var xml;
			if(window.ActiveXObject){
				xml = new ActiveXObject('Microsoft.XMLHTTP');
			}else if(window.XMLHttpRequest){
				xml = new XMLHttpRequest();
			}
			var post_method = "Data="+data+"&Cid="+cid+"&Time="+time;		//构造URL参数
			xml.open("POST","aj_joinWork.php",true);						//调用指定的添加文件
			xml.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");	 //设置请求头信息
			xml.send(post_method);
			xml.onreadystatechange = function(){   //判断URL调用的状态值并处理
				if(xml.readyState==4&&xml.status==200){
					var msg = xml.responseText;
					if(msg =="ok"){
						alert(msg);
						location.reload();
					}else
						alert("请先新建考勤  或者  已经考勤了"+msg);
					 
				}
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
