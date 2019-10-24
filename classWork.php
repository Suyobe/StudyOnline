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
                            <li class="breadcrumb-item active">课程作业</li>
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
									<a href="classResour.php" style="padding-right: 50px ;"  >课程资源</a>
									<a href="classWork.php" style="padding-right: 50px ;"  >课程作业</a>
									<a href="attendance.php" style="padding-right: 50px ;"  >考勤</a>
									<a href="messageBoard.php" style="padding-right: 50px ;"  >留言板</a>
								</div> 
								<div class='show_list' style=" width:900px;background-color: #F9F9F9;">
									<?php
										$pagesize=6;  //每页显示记录数
										$sqlstr = "select * from Work_tb where Tid ='".$username."'";	
										$total = mysqli_query($conn,$sqlstr);
										$num= mysqli_num_rows($total);
										$pagecount=ceil($num/$pagesize);
										(!isset($_GET['page']))?($page=1):$page=$_GET['page'];//当前页数
										($page<=$pagecount)?$page:($page=$pagecount);
										$f_pageNum=$pagesize*($page-1); //当前页的第一条记录  
										$sqlstr1=$sqlstr." limit ".$f_pageNum.",".$pagesize;//定义sql语句，通过limit关键字控制查询范围和数量
										$result=mysqli_query($conn,$sqlstr1);
									?>
									<div class="button1" align="right">
										<a href="newWork.php?num=<?php echo $_SESSION['cid'].$num+1; ?>" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down" style=" width:80px;height:35px"> 布置作业</a>
									</div>
									<div class="managehr" style="margin:20px;margin-top: 25px;border: none;border-top: 1px dashed #399;background-color: white;"></div>	
									
									<table class="datalist" id="datalist" cellpadding="15px" cellspacing="10px" style="margin-bottom: 20px;">
										<tbody>
											<tr>
											  	<th width="220px">作业标题</th><th width="150px" >发布人</th><th width="200px" >截止时间</th><th width="250px">操作</th>
										  	</tr>
									<?php
										while($result&&$rows = mysqli_fetch_array($result)){
									?>
										  	<!--start-->
											<tr class="altrow" style="border-top: 1px dashed #399;">
												<td >
													<a href="" title=""><?php echo $rows[1]; ?></a>
												</td>
												<td>
													<a href="" target="_blank"><?php echo $rows[4]; ?></a>
												</td>
												<td>
													<span style="font-size:13px;"><?php echo $rows[5]; ?></span><br/>
												</td>
												<td style="padding-left:8px;">
													<a onclick="showDiv('<?php echo $rows[1]; ?>','<?php echo $rows[4]; ?>','<?php echo $rows[5]; ?>','<?php echo $rows[2]; ?>');">
														<span>查看</span>
													</a>
													&nbsp;|
													<a href="checkWork.php?Wid=<?php echo $rows[0]; ?>">
														<span>审阅</span>
													</a>
													|&nbsp;
													<a href="upfile/download_all.php?Wid=<?php echo $rows[0]; ?>">
														<span>打包下载</span>
													</a>
													|&nbsp;
													<a href="#" onclick="del(<?php echo $rows[0]; ?>)">删除</a>
												</td>
											</tr>
											<!--end-->
									<?php 
										}
									 ?>
											
										</tbody>
									</table>
									
									
									
								</div>
								<div class="pages" ><span>
										<?php 
											echo "共".$num."条记录&nbsp;&nbsp;" ;
											echo "第".$page."页/共".$pagecount."页&nbsp;&nbsp;";
											if($page!=1){
												echo "<a href='?page=1'>首页</a>&nbsp;";
												echo "<a href='?page=".($page-1)."'>上一页</a>&nbsp;&nbsp;";
												
												}else{
													echo "首页&nbsp;上一页&nbsp;&nbsp;";
													
													}
											if($page!=$pagecount){
												echo "<a href='?page=".($page+1)."'>下一页</a>&nbsp;&nbsp;";
												echo "<a href='?page=".$pagecount."'>尾页</a>&nbsp;&nbsp;";
												
												}else{
													echo "下一页&nbsp;尾页&nbsp;&nbsp;";
													
													}
										
										
										?></span></div>
									</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--弹出div start-->
	<div id="Idiv" style="display:none; width: 370px; border-radius: 10px; position:absolute; z-index:1000;background-color: #F9F9F9;">
		<div id="mou_head" align="center" style="padding-top: 10px; width: 370px; height: 40px; border-top-left-radius: 10px ; border-top-right-radius: 10px ;  background-color: #D7DFE3; ">
			<span id="title"></span>
		</div>
	 	<div class="pop_content" style="margin: 10px;">
			<p style="color: #00AA88;text-align: center;">[ 发布人：<span id="name"></span>   &nbsp;&nbsp; <span id="time"></span>  ]</p>
			<p id="content"></p>
		</div>
		<div align="center">
			<input  type="button" onclick="closeDiv();" value="确定"/>
		</div>
		
	</div>
<!--弹出div end-->
<script type="text/javascript">
	function signup(){
    		if(confirm("确定注销吗？")){
    			window.location.href='logout.php';
    		}
    }
	function del(wid){
			if(confirm("确定删除吗？")){
				var xml;
				if(window.ActiveXObject){
					xml = new ActiveXObject('Microsoft.XMLHTTP');
				}else if(window.XMLHttpRequest){
					xml = new XMLHttpRequest();
				}
				xml.open("GET",'aj_delClass.php?Wid='+wid,true);
				xml.onreadystatechange = function(){
					if(xml.readyState==4&&xml.status==200){
						var msg = xml.responseText;
						if(msg==wid){
							alert("删除成功！");
							location.reload();
						}else{
							alert("删除失败!");
							return false;
						}
					}
				}
				xml.send(null);
			}else{
			 //取消
		}
		 
	}
	
	function showDiv(title,name,time,content){
		
			document.getElementById("title").innerHTML=title;
			document.getElementById("name").innerHTML=name;
			document.getElementById("time").innerHTML=time;
			document.getElementById("content").innerHTML=content;
			
			var Idiv     = document.getElementById("Idiv");
			var mou_head = document.getElementById('mou_head');
			Idiv.style.display = "block";
			 
	 		//以下部分要将弹出层居中显示
			Idiv.style.left=(document.documentElement.clientWidth-Idiv.clientWidth)/2+document.documentElement.scrollLeft+"px";
		 	Idiv.style.top =(document.documentElement.clientHeight-Idiv.clientHeight)/2+document.documentElement.scrollTop-50+"px";
		 	
	  		document.body.appendChild(procbg);
	 		document.body.style.overflow = "hidden"; //取消滚动条
	 
			 //以下部分实现弹出层的拖拽效果
			 var posX;
			 var posY;
		mou_head.onmousedown=function(e){
			if(!e) e = window.event; //IE
			posX = e.clientX - parseInt(Idiv.style.left);
			posY = e.clientY - parseInt(Idiv.style.top);
		 	document.onmousemove = mousemove;
	 	}
		document.onmouseup = function(){
		 	document.onmousemove = null;
		}
		function mousemove(ev) {
			if(ev==null) ev = window.event;//IE
			Idiv.style.left = (ev.clientX - posX) + "px";
			Idiv.style.top = (ev.clientY - posY) + "px";
		}
	}
	function closeDiv(){ //关闭弹出层
		var Idiv=document.getElementById("Idiv");
		Idiv.style.display="none";
		document.body.style.overflow = "auto"; //恢复页面滚动条
		var body = document.getElementsByTagName("body");
		var mybg = document.getElementById("mybg");
		body[0].removeChild(mybg);
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
