<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8">

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<!-- Plugin Stylesheets first to ease overrides -->
<link rel="stylesheet" type="text/css" href="/assets/plugins/colorpicker/colorpicker.css" media="screen">
<link rel="stylesheet" type="text/css" href="/assets/plugins/prettyphoto/css/prettyPhoto.css" media="screen">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="/assets/bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="/assets/css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="/assets/css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="/assets/css/mws-style.css" media="screen">
<link rel="stylesheet" type="text/css" href="/assets/css/icons/icol16.css" media="screen">
<link rel="stylesheet" type="text/css" href="/assets/css/icons/icol32.css" media="screen">

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="/assets/css/demo.css" media="screen">

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="/assets/jui/css/jquery.ui.all.css" media="screen">
<link rel="stylesheet" type="text/css" href="/assets/jui/jquery-ui.custom.css" media="screen">

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="/assets/css/mws-theme.css" media="screen">
<link rel="stylesheet" type="text/css" href="/assets/css/themer.css" media="screen">

<title>@yield('title')</title>

</head>

<body>

    <!-- Themer (Remove if not needed) -->  
   
    <!-- Themer End -->

    <!-- Header -->
    <div id="mws-header" class="clearfix">
    
        <!-- Logo Container -->
        <div id="mws-logo-container">
        
            <!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
            <div id="mws-logo-wrap">
               <h1 style="color:white">后台</h1>
            </div>
        </div>
        
        <!-- User Tools (notifications, logout, profile, change password) -->
        <div id="mws-user-tools" class="clearfix">
        
            <div id="mws-user-info" class="mws-inset">
                @php
                    $rs = DB::table('admin')->where('id',session('uid'))->first();
                @endphp
                <!-- User Photo -->
                <div id="mws-user-photo">
                    <img src="{{$rs->profile}}">
                </div>
                
                <!-- Username and Functions -->
                <div id="mws-user-functions">
                    <div id="mws-username">
                        Hello,{{$rs->username}}
                    </div>
                    <ul>
                        <li><a href="/admin/pass">更改密码</a></li>
                        <li><a href="/admin/profile">更改头像</a></li>
                        <li><a href="/admin/logout">退出登录</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Start Main Wrapper -->
    <div id="mws-wrapper">
    
        <!-- Necessary markup, do not remove -->
        <div id="mws-sidebar-stitch"></div>
        <div id="mws-sidebar-bg"></div>
        
        <!-- Sidebar Wrapper -->
        <div id="mws-sidebar">
        
            <!-- Hidden Nav Collapse Button -->
            <div id="mws-nav-collapse">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
          
            
            <!-- Main Navigation -->
            <div id="mws-navigation">
                <ul>
                   
                    <li>
                        <a href="#"><i class="icon-list"></i>管理员管理</a>
                        <ul>
                            <li><a href="/admin/admins">管理员查看</a></li>
                            <li><a href="/admin/admins/create">管理员添加</a></li>
                        </ul>
                    </li>
                     <li>
                        <a href="#"><i class="icon-list"></i> 用户管理</a>
                        <ul>
                            <li><a href="/admin/user">用户查看</a></li>
                            <li><a href="/admin/user/create">用户添加</a></li>
                        </ul>
                    </li>
                     <li>
                        <a href="#"><i class="icon-list"></i> 角色管理</a>
                        <ul>
                            <li><a href="/admin/role">角色查看</a></li>
                            <li><a href="/admin/role/create">角色添加</a></li>
                        </ul>
                    </li>
                     <li>
                        <a href="#"><i class="icon-list"></i> 权限管理</a>
                        <ul>
                            <li><a href="/admin/permission">查看权限</a></li>
                            <li><a href="/admin/permission/create">添加权限</a></li>
                            
                        </ul>
                    </li>
                     <li>
                        <a href="#"><i class="icon-list"></i> 商品分类管理</a>
                        <ul>
                            <li><a href="/admin/category">商品分类查看</a></li>
                            <li><a href="/admin/category/create">添加分类</a></li>
                        </ul>
                    </li>
                     <li>
                        <a href="#"><i class="icon-list"></i> 商品管理</a>
                        <ul>
                            <li><a href="/admin/goods">商品查看</a></li>
                            <li><a href="/admin/goods/create">添加商品</a></li>
                        </ul>
                    </li>
                     <li>
                        <a href="#"><i class="icon-list"></i> 商品类型管理</a>
                        <ul>
                            <li><a href="">Layouts</a></li>
                            
                            <li><a href="">Wizard</a></li>
                        </ul>
                    </li>
                     <li>
                        <a href="#"><i class="icon-list"></i>导航栏管理</a>
                        <ul>
                            <li><a href="/admin/nav">查看导航栏</a></li>
                            
                            <li><a href="/admin/nav/create">添加导航</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-list"></i> 订单管理</a>
                        <ul>
                            <li><a href="/admin/order">查看订单</a></li>
                            
                            <li><a href="/admin/order/create">添加订单</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-list"></i> 导航管理</a>
                        <ul>
                            <li><a href="">Layouts</a></li>
                            
                            <li><a href="">Wizard</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-list"></i> 轮播图管理</a>
                        <ul>
                            <li><a href="/admin/lunbo">轮播图查看</a></li>
                            <li><a href="/admin/lunbo/create">添加图片</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-list"></i> 广告管理</a>
                        <ul>
                            <li><a href="/admin/guanggao">查看广告</a></li>
                            <li><a href="/admin/guanggao/create">添加广告</a></li>
                        </ul>
                    </li>
                     <li>
                        <a href="#"><i class="icon-list"></i> 友情链接管理</a>
                        <ul>
                            <li><a href="/admin/link">友情链接查看</a></li>
                            <li><a href="/admin/link/create">添加友情链接</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-list"></i> 优惠券管理</a>
                        <ul>
                            <li><a href="">Layouts</a></li>
                            
                            <li><a href="">Wizard</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-list"></i> 地址管理</a>
                        <ul>
                            <li><a href="">用户地址</a></li>
                            <li><a href="form_elements.html">添加地址</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Main Container Start -->
        <div id="mws-container" class="clearfix">

            <div class="container">
            
           @section('content')



           @show
          
            </div>
           
        </div>

    </div>

    <!-- JavaScript Plugins -->
    <script src="/assets/js/libs/jquery-1.8.3.min.js"></script>
    <script src="/assets/js/libs/jquery.mousewheel.min.js"></script>
    <script src="/assets/js/libs/jquery.placeholder.min.js"></script>
    <script src="/assets/custom-plugins/fileinput.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="/assets/jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="/assets/jui/jquery-ui.custom.min.js"></script>
    <script src="/assets/jui/js/jquery.ui.touch-punch.js"></script>

    <!-- Plugin Scripts -->
    <script src="/assets/plugins/prettyphoto/js/jquery.prettyPhoto.min.js"></script>
    <script src="/assets/plugins/colorpicker/colorpicker-min.js"></script>

    <!-- Core Script -->
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/js/core/mws.js"></script>

    <!-- Themer Script (Remove if not needed) -->
    <script src="/assets/js/core/themer.js"></script>

    <!-- Demo Scripts (remove if not needed) -->
    <script src="/assets/js/demo/demo.gallery.js"></script>
    @section('js')

    @show
</body>
</html>
