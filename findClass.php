<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/xiaohui.png">
    <title>加入课程</title>
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
                        <h3 class="text-themecolor m-b-0 m-t-0">可加入的课程</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">可加入的课程</li>
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
								$sqlstr = "select Cid,  Cname, Tid from  Class_tb where Tid !='".$username."' and Class_tb.Cid not in (select Cid from  Grade_tb  where  Sname = '".$username."'  )";
								$result = mysqli_query($conn,$sqlstr);
								$nums = mysqli_num_rows($result);
							?>
                            	<div class="tabs_stc">共<a id="manage_num">&nbsp;<?php echo $nums; ?>&nbsp;</a>门课程<br/>&nbsp;</div>
                             	<table class="datalist" style="margin-left:100px;" id="datalist1">
                             		<tbody id="createCourse">
                            <?php
                                if($nums>0){
                                    while($rows = mysqli_fetch_array($result)){
//										$cid = $rows[0];
                            ?>
                             			<!--start-->
                             			<tr style="border:1px solid #d1d1d1;width:208px;float:left;margin-right:23px;margin-bottom:20px;margin-top:5px;">
                             				<td style="width:208px;">
                             					<div style="width:208px;background:white;position:relative;" id="evlist0" >
                             						<a target="_blank" href=" "><img src="assets/images/user.jpg" height="160px" width="208px"></a>
                             						<div class="effect">
                             							课程名：<a id="Ctitle" class="evlistTitle"  href="#"><?php echo $rows[1]; ?></a>
                             						</div>
                             						<div class="effect">
                             							创建人：<a class="evlistTitle"  href="#"><?php echo $rows[2]; ?></a>
                             						</div>
                             						<div class="mng_group" align="center" >
														<input type="button" value="申请加入 " onclick="showDiv(<?php echo $rows[0]; ?>,'<?php echo $rows[1]; ?>');" style="border: 0;" />
                             						</div>
                             					</div>
                             				</td>
                             			</tr>
                             			<!--end-->
                             
							<?php
									}
								}else{
									echo "<p>暂时没有可以加入的课程，你可以<a href='newClass.php'>去创建</a></p>";
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
    
   <!--弹出div start-->
	<div id="Idiv" style="display:none; width: 370px; border-radius: 10px; position:absolute; z-index:1000;background-color: #F9F9F9;">
		<div id="mou_head" align="center" style="padding-top: 10px; width: 370px; height: 40px; border-top-left-radius: 10px ; border-top-right-radius: 10px ;  background-color: #D7DFE3; ">
			<p id="title">您申请加入课程：Python脚本语言</p>
		</div>
	 	<div class="pop_content" style="margin: 10px;">
			<span  style="color: #00AA88;"> &nbsp;需要验证您的身份，请输入请求信息：</span> 
			<ul style="list-style-type:none;margin: 10px;">
				<form  method="post">
					<li style="margin: 10px;">
					 	学<i style="color:white;">学号</i>号：
					 	<input type="text" id="sid" name="sid" value="" style="color: gray;" onclick="isOnclick(this.id);">
					</li>
					<li style="margin: 10px;">
					 	姓<i style="color:white;">姓名</i>名：
					 	<input type="text" id="sname" name="sname" value="" style="color: gray;" onclick="isOnclick(this.id);">
					</li><li style="margin: 10px;">
					 	课程密码：
					 	<input type="text" id="spsd" name="spsd" value="" style="color: gray;" onclick="isOnclick(this.id);">
					</li>
					<li style="text-align: center;margin-top: 20px;">
                    	<input type="hidden" id="cid" name="cid" value="" />
						<input type="button" onclick="send();"   value="发送"/>&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="button" onclick="closeDiv();" value="取消"/>	
					</li>
				</form>
			</ul>
		</div>
	</div>
    <!--弹出div end-->
   
    
    
	
		 
	
<script type="text/javascript">
	function signup(){
    		if(confirm("确定注销吗？")){
    			window.location.href='logout.php';
    		}
    }
	function isOnclick(id) {
		var id1 = id;
		document.getElementById(id1).value = "";
		document.getElementById(id1).style.color="#000000";
	}
	
	function send(){
		var xml;
		if(window.ActiveXObject){
			xml = new ActiveXObject('Microsoft.XMLHTTP');
		}else if(window.XMLHttpRequest){
			xml = new XMLHttpRequest();
		}
		var ssid = document.getElementById("sid").value;
		var ssname = document.getElementById("sname").value;
		var sspassword = document.getElementById("spsd").value;
		var ccid = document.getElementById("cid").value;
		if(ssid==""||ssname==""||sspassword==""){
			alert("添加的数据不能为空！");
			return false;
		}
		var post_method = "Stuid="+ssid+"&Stuname="+ssname+"&Stupsd="+sspassword+"&Claid="+ccid;
		xml.open("POST","aj_joinClass.php",true);
		xml.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");
		xml.onreadystatechange = function(){
			if(xml.readyState==4&&xml.status==200){
				var msg = xml.responseText;
				if(msg==ccid){
					alert("加入成功!");
					window.location.href='myStudy.php';
				}else{
					alert(msg);
					return false;
				}
			}
		}
		xml.send(post_method);
		
	}
		
	
	function showDiv(id,title){
		
		var cid = document.getElementById("cid");
		cid.value = id;
		
		document.getElementById("title").innerHTML = title ;
		
		 var Idiv = document.getElementById("Idiv");
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
<script type="text/javascript">
	//function coursePopupDiv(div_id) { var div_obj = $("#" + div_id); div_obj.animate( { opacity : "show", left : 600, top : 40, width :290, }, 300); }
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

