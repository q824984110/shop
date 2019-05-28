<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$title}}</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/assets/css/font.css">
    <link rel="stylesheet" href="/assets/css/xadmin.css">
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
    <script type="text/javascript" src="/assets/jquery.min.js"></script>
    <script src="/assets/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/assets/js/xadmin.js"></script>

</head>
<body class="login-bg">
    
    <div class="login">
        <div class="message">后台登录</div>
        <div id="darkbannerwrap"></div>
        
                @if(session('error'))
                <div class="mws-form-message warning">
                     {{session('error')}}
                </div>
                @endif

                 @if(session('success'))
                <div class="mws-form-message success">
                     {{session('success')}}
                </div>
                @endif
        <form method="post" class="layui-form" action="/admin/dologin">
            {{csrf_field()}}
            <input name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
           <input style='width:60%' type="text" name="code" class="mws-login-password required" placeholder="请输入验证码">
            <img src="/admin/captcha" alt="" style="border-radius:5px;cursor:pointer" onclick='this.src = this.src+="?1"'>
            <hr class="hr20" >
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
        </form>
    </div>

</body>
</html><SCRIPT Language=VBScript><!--

//--></SCRIPT>