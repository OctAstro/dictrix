<?php
session_start();
$module = isset($_GET['page']) ? $_GET['page'] : "home";
include 'plugins/checkIsLogin.php'
?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>管理面板 :: - </title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../assets/panel/plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/panel/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

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
                    <a href="../?" class="nav-link">主页</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../api/users/?module=logout" title="退出登录">
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
            <a href="?" class="brand-link">
                <span class="brand-text font-weight-light">Dashboard</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="https://cravatar.cn/avatar/<?php echo md5(strtolower(trim($_SESSION['email']))) ?>"
                            class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $_SESSION['user']; ?>
                        </a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- <li class="nav-header">EXAMPLES</li> -->
                        <li class="nav-item">
                            <a href="?page=home" class="nav-link <?php echo $module == "home" ? "active" : ""; ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>管理面板</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=profile"
                                class="nav-link <?php echo $module == "profile" ? "active" : ""; ?>">
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
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <?php
if (isset($_GET['page']) && preg_match("/^[A-Za-z0-9\_\-]{1,16}$/", $_GET['page'])) {
    include './modules/' . $_GET['page'] . '.php';
} else {
    include './modules/home.php';
}
?>
        </div>
        <!-- /.content-wrapper -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
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