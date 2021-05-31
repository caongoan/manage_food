<?php
include "../config/session.php";
Session::checkSession();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Trang người bán hàng</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link href="assets/dist/css/css.css" rel="stylesheet" />
    <script src="assets/plugins/ckeditor/ckeditor.js"></script>
    <script src="assets/plugins/ckfinder/ckfinder.js"></script>
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="assets/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="assets/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <style>
.wrapper {
    top: -20px;
}
</style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="/manage_food/admin/index.php?controller=Home&action=index" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>A</b>LT</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Admin</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success"></span>
                            </a>
                            
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">2</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Bạn có 2 thông báo</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="/Admin/Customer/UserProfile">
                                                <i class="fa fa-users text-aqua"></i> 1 khách hàng đăng ký mới
                                            </a>
                                        </li>
                                       
                                       
                                        <li>
                                            <a href="/Admin/Order">
                                                <i class="fa fa-shopping-cart text-green"></i> 1 đơn hàng mới
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="assets/dist/img/26219765_153092935338641_7804066461055097235_n.jpg" class="img-circle" alt="User Image" style="width: 18px;">
                                <span class="hidden-xs">Mr.Hiếu</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="assets/dist/img/26219765_153092935338641_7804066461055097235_n.jpg" class="img-circle" alt="User Image">

                                    <p>
                                        Mr.Hiếu-Admin

                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="/Admin/AdminProfile/Detail" class="btn btn-default btn-flat">Hồ sơ</a>
                                    </div>
                                    <div class="pull-left" style="margin-left:5px;">
                                        <a href="/Admin/Changepassword/newPassword" class="btn btn-default btn-flat">Đổi mật khẩu</a>
                                    </div>

                                    <div class="pull-right">
                                        <a href="index.php?controller=login&action=logOut" class="btn btn-default btn-flat">Đăng xuất</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="assets/dist/img/26219765_153092935338641_7804066461055097235_n.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Mr.Hiếu</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">QUẢN LÝ</li>
            <li class="active treeview">
                <a href="/Admin">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="ion-navicon-round"></i>
                    <span>Danh mục món ăn</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/manage_food/admin/index.php?controller=Categories&action=indexAdd"><i class="fa fa-circle-o"></i>Thêm danh mục</a></li>
                    <li><a href="/manage_food/admin/index.php?controller=Categories&action=index"><i class="fa fa-circle-o"></i>Danh sách danh mục</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-star"></i>
                    <span>Thương hiệu sản phẩm</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/Admin/Brand/Brandadd"><i class="fa fa-circle-o"></i>Thêm thương hiệu</a></li>
                    <li><a href="/Admin/Brand/Brandlist"><i class="fa fa-circle-o"></i>Danh sách thương hiệu</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i><span>Mã giảm giá</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                    <li><a href="/manage_food/admin/index.php?controller=DiscountCode&action=indexAdd"><i class="fa fa-circle-o"></i>Thêm mã giảm giá</a></li>
                    <li><a href="/manage_food/admin/index.php?controller=DiscountCode&action=index"><i class="fa fa-circle-o"></i>Danh sách mã giảm giá</a></li>
                </ul>
            </li>

            <li>
                <a href="/Admin/Warehouse">
                    <i class="fa fa-home"></i><span>Kho hàng</span>

                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-powerpoint-o"></i><span>Quản lý slider</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/Admin/Slider/AddSlider"><i class="fa fa-circle-o"></i>Thêm slider</a></li>
                    <li><a href="/Admin/Slider/Sliderlist"><i class="fa fa-circle-o"></i>Tất cả slider</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i><span>Quản lý tin tức</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/Admin/News/AddNews"><i class="fa fa-circle-o"></i>Thêm tin tức</a></li>
                    <li><a href="/Admin/News/Newslist"><i class="fa fa-circle-o"></i>Tất cả tin tức</a></li>
                </ul>
            </li>
            <li><a href="/Admin/Customer/UserProfile"><i class="fa fa-book"></i> <span>Hồ sơ người dùng</span></a></li>
            <li class="header">ĐƠN HÀNG</li>
            <li><a href="/Admin/Order"><i class="fa fa-envelope"></i> <span>Đơn hàng</span></a></li>
            

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

        <!-- Content Wrapper. Contains page content -->
        