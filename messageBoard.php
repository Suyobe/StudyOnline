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
                            <li class="breadcrumb-item active">留言板</li>
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
									<a href="messageBoard.php" style="padding-right: 50px ;" href="" >留言板</a>
								</div> 
								<div class='show_list' style=" width:900px;background-color: #F9F9F9;">
									
									 
									<div class="managehr" style="margin:20px;margin-top: 25px;border: none;border-top: 1px dashed #399;background-color: white;"></div>	
									<div>
										<!-- 留言板开始-->	
										<div class="about" >
								        	<h3>留言板</h3>
									        <form action="#" method="post">
									            <textarea id="mess" name="mess" style="resize: none; width:100%; height:100px" placeholder="请写下你的留言信息!"></textarea>
									            <input type="hidden"  id="username" name="username" value="<?php  echo $username ;?>"/> 
									            <input type="hidden"  id="cid" name="cid" value="<?php  echo  $_SESSION['cid']  ;?>"/> 
									            <input type="hidden"  id="time" name="time" value="<?php echo date('Y-m-d h:i', time()); ?>"/>   
									            <input type="submit" class="btn btn-primary pull-right" value="&nbsp;发表&nbsp;"  onClick="send()"> 
									        </form> 
								        	<br>&nbsp;<br />
										<?php
												$pagesize = 5;
												$sqlstr = "select * from msg_tb  where Cid = '".$_SESSION['cid']."'";
												$total = mysqli_query($conn,$sqlstr);
												$totalNum = mysqli_num_rows($total);
												$pagecount = ceil($totalNum/$pagesize);
												(!isset($_GET['page']))?($page = 1):$page = $_GET['page'];
												($page<=$pagecount)?$page:($page = $pagecount);
												$f_pageNum = $pagesize*($page-1);
												$sqlstr1 = $sqlstr." limit ".$f_pageNum.",".$pagesize;
												$result = mysqli_query($conn,$sqlstr1);
										?>
											<p align="left">
									             <b>留言（<?php echo $totalNum; ?>）</b>  
									             <span style="float:right;">
												<?php 
													if($page==1){
														echo "首页&nbsp;上一页&nbsp;&nbsp;";
													}else{
														echo "<a href='?page=1'>首页</a>&nbsp;";
														echo "<a href='?page=".($page-1)."'>上一页</a>&nbsp;&nbsp;";
													}
													if($page!=$pagecount){
														echo "<a href='?page=".($page+1)."'>下一页</a>&nbsp;";
														echo "<a href='?page=".$pagecount."'>尾页</a>&nbsp;&nbsp;";
													}else{
														echo "下一页&nbsp;尾页&nbsp;&nbsp;";
													}
									            ?> 
											 	</span>
									        </p>
									        <li class="ll" style="list-style: none;"> <!--div class="ll"  start --> 	
										<?php
											if($result){
											
												while($rows = mysqli_fetch_array($result)){   
													echo '<div class="u" align="left"><div  class="l" style="height:100px; width:100px;">';
													echo '<img src="assets/images/user1.jpg" style=" float:left; width: 90px;height: 90px;">';
													echo '</div><div  class="l"style="margin: 0px 10px; width:700px;">';
													echo '<span style="font-size:15px">'.$rows[1]. '</span>';
													echo '<p style="margin: 10px 0px;width:600px;">'.$rows[3].'</p>';
													echo '<p style=" margin: 20px 0;width:400px; font-size:9px;">'.$rows[2].'</p>';
													echo '</div></div>';
													
													
										 		}
											}
										?>
									        </li> <!--div class="ll"  end -->
		<style type="text/css">
			 .u div{ float:left; }  
         </style>
										</div>
										
									  	<!-- 留言板结束-->
										
										
									</div>
								 
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
	function send(){
				var xml;
				if(window.ActiveXObject){
					xml = new ActiveXObject('Microsoft.XMLHTTP');
				}else if(window.XMLHttpRequest){
					xml = new XMLHttpRequest();
				}
				var mess = document.getElementById("mess").value;
				var username = document.getElementById("username").value;
				var ccid = document.getElementById("cid").value;
				var time = document.getElementById("time").value;
				if(mess==""){					//判断表单提交的值不能为空
					alert('添加的数据不能为空！');
					return false;
				} 
 				var post_method = "Mess="+mess+"&Username="+username+"&Time="+time+"&Cid="+ccid;		//构造URL参数
				xml.open("POST","aj_joinWork.php",true);						//调用指定的添加文件
				xml.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");	 //设置请求头信息
				xml.send(post_method);
				xml.onreadystatechange = function(){   //判断URL调用的状态值并处理
					if(xml.readyState==4&&xml.status==200){
						var msg = xml.responseText;
						alert(msg);
						if(msg ==1)
							location.reload();
						else
							alert(msg);
						 
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
