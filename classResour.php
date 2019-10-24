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

	<style type="text/css">
	.show_list {
		padding: 0;
		width: 605px;
	}
	
	.list {
		padding: 5px 0;
		margin: 20px;
		border-bottom: 1px solid #ccc;
	}
	
	.list_title {
		font-size: 8px;
		color: #666;
	}
	
	.right {
		width: 650px;
		float: right;
	}
	
	.webpage {
		width: 650px;
		float: right;
	}
	
	.pages {
		padding: 5px 0;
		margin: 20px;
	}
	
	.left {
		width: 202px;
		float: left;
		margin-left: 40px;
	}
	
	.noticeNull {
		margin-top: 20px;
		margin-left: 30px;
		color: #999;
		font-size: 16px;
	}
	
	.list_menu {}
	
	</style>

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
		$_SESSION['username'] = $username;
	}
		
?>
<script type="text/javascript">
 var xmlHttp;				//定义XMLHttpRequest对象
	function del(id){
		if (confirm("确认删除"))
 
         {
 
             window.location.href="upfile/delfile.php?id="+id+"&cid="+<?php echo $_GET['cid']; ?>;    //本页面刷新*/
			
 
         }
	
	}
function createXmlHttpRequestObject(){
	//如果在internet Explorer下运行
	if(window.ActiveXObject){
		try{
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}catch(e){
			xmlHttp=false;
		}

	}else{
	//如果在Mozilla或其他的浏览器下运行
		try{
			xmlHttp=new XMLHttpRequest();
		}catch(e){
			xmlHttp=false;
		}
	}
	 //返回创建的对象或显示错误信息
	if(!xmlHttp)
		alert("返回创建的对象或显示错误信息");
		else
		return xmlHttp;
}
function showsimple(id){
	createXmlHttpRequestObject();
	var cont = document.getElementById(id).innerHTML;
	document.getElementById("right").style.display="none";
	if(cont==""){
		alert('查询关键字不能为空！');
		return false;
	}
		xmlHttp.onreadystatechange=StatHandler;	//判断URL调用的状态值并处理
		xmlHttp.open("GET",'upfile/searchrst.php?cont='+cont,false);
		xmlHttp.send(null);	

}
function StatHandler(){
	if(xmlHttp.readyState==4 && xmlHttp.status==200){
		document.getElementById("webpage").innerHTML=xmlHttp.responseText;
	}
	
}

</script>
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
                            <li class="breadcrumb-item active">课程资源</li>
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
								<div class='show_list' style=" width:900px;">
									
									<div class="button1" align="right">
										<a href="#" onclick="open_win()" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down" style=" width:80px;height:35px"> 上传</a>
									</div>
									<div class="managehr" style="margin:20px;margin-top: 25px;border: none;border-top: 1px dashed #399;background-color: white;"></div>	
									
									<div class="left">
									<div class="list_menu">
										<div style="height:38px; line-height: 40px; border-left: 5px solid #A3E6E6; background: #A3E6E6; margin-top: 25px; padding-left: 20px; border-top: 1px solid #ccc;"><a href="classResour.php"  style="color: #262626; font-weight: bold; font-size: 15px;" >全部资源</a></div>
									    <div style="height:38px; line-height: 40px; background: #A3E6E6; padding-left: 20px; margin-top: 1px;"><a href="#" title="未分类资源" id="111" style="color:#333; font-size: 13px; font-weight:normal;" onclick="return showsimple(111);">未分类资源</a></div>
									     <div style="height:38px; line-height: 40px; background: #A3E6E6; padding-left: 20px; margin-top: 1px;"><a href="#" title="课件" id="222" style="color:#333; font-size: 13px; font-weight:normal;" onclick="return showsimple(222);">课件</a></div>
									      <div style="height:38px; line-height: 40px; background: #A3E6E6; padding-left: 20px; margin-top: 1px;"><a href="#" title="实验指导书" id="333" style="color:#333; font-size: 13px; font-weight:normal;" onclick="return showsimple(333);">实验指导书</a></div>
									       <div style="height:38px; line-height: 40px; background: #A3E6E6; padding-left: 20px; margin-top: 1px;"><a href="#" title="教学大纲" id="444" style="color:#333; font-size: 13px; font-weight:normal;" onclick="return showsimple(444);">教学大纲</a></div>
									        <div style="height:38px; line-height: 40px; background: #A3E6E6; padding-left: 20px; margin-top: 1px;"><a href="#" title="模板" id="555" style="color:#333; font-size: 13px; font-weight:normal;" onclick="return showsimple(555);">模板</a></div>
									         <div style="height:38px; line-height: 40px; background: #A3E6E6; padding-left: 20px; margin-top: 1px;"><a href="#" title="参考案例" id="666" style="color:#333; font-size: 13px; font-weight:normal;" onclick="return showsimple(666);">参考案例</a></div>
									</div>
									</div>
									<?php
										$pagesize=6;  //每页显示记录数
										$sqlstr="select * from cFile_table where Cid=".$_SESSION['cid'] ." order by file_id desc ";
										$total=mysqli_query($conn,$sqlstr);
										$totalNum= mysqli_num_rows($total);//总记录数
										$pagecount=ceil($totalNum/$pagesize);
										(!isset($_GET['page']))?($page=1):$page=$_GET['page'];//当前页数
										($page<=$pagecount)?$page:($page=$pagecount);
										$f_pageNum=$pagesize*($page-1); //当前页的第一条记录  
										$sqlstr1=$sqlstr." limit ".$f_pageNum.",".$pagesize;//定义sql语句，通过limit关键字控制查询范围和数量
										$result=mysqli_query($conn,$sqlstr1);
										if($result==""){
										
									?>
										 
									<div class="noticeNull" style="float: right; width: 560px;">暂无可下载的教学资源!</div>
									<?php
									}else{
									?>
										<div class='right' id="right">
									<?php
										while($rows =mysqli_fetch_array($result)){
									?>
									
										<div class='show_list'>
									<!-- <div class="show_list">-->
										<div class="list"> 
									    <a href="./upfile/download.php?id=<?php echo $rows['file_id'];?>"  target="_blank"><?php echo $rows['file_name'];?></a>
									    	<p class="list_title">
									   		<span class="gap">发布人：<?php echo $rows['file_author'];?> &nbsp;|&nbsp; 上传时间：<?php echo $rows['file_time'];?>
									   			 &nbsp;|&nbsp; 文件大小: <?php echo $rows['file_size'];?> 
									   			 <a href="javascript:del(<?php echo $rows['file_id']?>)" style="float:right;">删除</a>
									   		</span>
									  	 	</p> 
									    </div> 
									 </div>	
									
									<?php
										
										
										}
										
									?> 
									
									
									
									<div class="pages" ><span>
										<?php 
											echo "共".$totalNum."条记录&nbsp;&nbsp;" ;
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
									<div class="webpage" id="webpage"></div>
									<?php
									
										 }
									?>
									
								</div>
								 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
	function signup(){
    		if(confirm("确定注销吗？")){
    			window.location.href='logout.php';
    		}
    }
    function del(id){
			if(confirm("确定删除吗？")){
            	 window.location.href="./upfile/delfile.php?id="+id;    //本页面刷新*/
			}else{
			 //取消
		}
		 
	}
	function open_win(){
	window.open("./upfile/upfile.php?cid="+<?php echo $_SESSION['cid']; ?>,'打开上传窗口',"channelmode=0,resizable=0,left=200,top=300,width=600,height=300");
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
