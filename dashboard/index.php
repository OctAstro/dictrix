<?php

session_start();

?>

<!DOCTYPE html>
<html lang="zh-CN">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>管理面板 ::  - </title>
		<!-- Font Awesome Icons -->
		<link rel="stylesheet" href="../assets/panel/plugins/fontawesome-free/css/all.min.css">
		<!-- IonIcons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="../assets/panel/dist/css/adminlte.min.css">
		<!-- Google Font: Source Sans Pro -->
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"></head>

	<body class="hold-transition sidebar-mini">
		<div class="wrapper">
			<!-- Navbar -->
			<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				<!-- Left navbar links -->
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" data-widget="pushmenu" href="#">
							<i class="fas fa-bars"></i>
						</a>
					</li>
					<li class="nav-item d-none d-sm-inline-block">
						<a href="?page=panel&module=home" class="nav-link">主页</a></li>
				</ul>
				<!-- Right navbar links -->
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="?page=logout&csrf=" title="退出登录">
							登出&nbsp;&nbsp;
							<i class="fas fa-sign-out-alt"></i>
						</a>
					</li>
				</ul>
			</nav>
			<!-- /.navbar -->
			<!-- Main Sidebar Container -->
			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<!-- Brand Logo -->
				<a href="?page=panel&module=home" class="brand-link">
					<center>
						<span class="brand-text font-weight-light">Dashboard</span>
					</center>
				</a>
				<!-- Sidebar -->
				<div class="sidebar">
					<!-- Sidebar user panel (optional) -->
					<div class="user-panel mt-3 pb-3 mb-3 d-flex">
						<div class="image">
							<img src="https://cravatar.cn/avatar/<?php echo md5(strtolower(trim($_SESSION['email']))) ?>" class="img-circle elevation-2" alt="User Image"></div>
						<div class="info">
							<a href="#" class="d-block"><?php echo $_SESSION['user']; ?>
								</a>
						</div>
					</div>
					<!-- Sidebar Menu -->
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<!-- <li class="nav-header">EXAMPLES</li> -->
							<li class="nav-item">
								<a href="" class="nav-link active">
									<i class="nav-icon fas fa-tachometer-alt"></i>
									<p>管理面板</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="userSetting" class="nav-link <?php echo $module == "profile" ? "active" : ""; ?>">
									<i class="nav-icon fas fa-user"></i>
									<p>用户信息</p>
								</a>
							</li>
							<li class="nav-header">语句管理</li>
							<li class="nav-item">
								<a href="dictumList" class="nav-link <?php echo $module == "proxies" ? "active" : ""; ?>">
									<i class="nav-icon fas fa-list"></i>
									<p>语句列表</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="addDictum" class="nav-link <?php echo $module == "addproxy" ? "active" : ""; ?>">
									<i class="nav-icon fas fa-plus"></i>
									<p>创建语句</p>
								</a>
							</li>
						</ul>
					</nav>
					<!-- /.sidebar-menu --></div>
				<!-- /.sidebar --></aside>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">&nbsp;&nbsp;<small class="text-muted text-xs">欢迎来到 Dictum 管理面板</small></h1></div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item">
                                        <a href="?">主页</a></li>
                                    <li class="breadcrumb-item active"></li></ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="card-title">用户信息</h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h3 class='text-primary'><?php echo $_SESSION['user']; ?></h3>
                                        <table style="width: 100%;font-size: 15px;margin-bottom: 16px;">
                                            <tr>
                                                <td style="width: 30%;"><b>注册邮箱</b></td>
                                                <td><?php echo $_SESSION['email']; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%;"><b>用户令牌</b></td>
                                                <td><?php echo $_SESSION['userToken']; ?></td>
                                            </tr>
                                        </table>
                                        <span>请妥善保管令牌，令牌拥有你在站点的所有权限</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="card-title">站点公告</h3>
                                        </div>
                                    </div>
                                    <div class="card-body fix-text fix-image">
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header border-0">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="card-title">使用帮助</h3>
                                        </div>
                                    </div>
                                    <div class="card-body fix-text fix-image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

			</div>
			<!-- /.content-wrapper -->
			<!-- Control Sidebar -->
			<aside class="control-sidebar control-sidebar-dark">
				<!-- Control sidebar content goes here --></aside>
			<!-- /.control-sidebar -->
			<!-- Main Footer -->
			<footer class="main-footer">
				<strong>Copyright &copy; .</strong>
				All rights reserved.
				<div class="float-right d-none d-sm-inline-block">Powered by <b>Dictuming</b>
				</div>
			</footer>
		</div>
		<!-- ./wrapper -->
		<!-- REQUIRED SCRIPTS -->
		<!-- jQuery -->
		<script src="../assets/panel/plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap -->
		<script src="../assets/panel/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- AdminLTE -->
		<script src="../assets/panel/dist/js/adminlte.js"></script>
	</body>

</html>
