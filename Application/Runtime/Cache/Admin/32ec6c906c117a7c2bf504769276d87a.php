<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>慢江湖后台 - 登录</title>
    <link href="/Mjh/Public/Admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Mjh/Public/Admin/css/font-awesome.min.css?v=4.3.0" rel="stylesheet">
    <link href="/Mjh/Public/Admin/css/animate.min.css" rel="stylesheet">
    <link href="/Mjh/Public/Admin/css/style.min.css?v=3.3.0" rel="stylesheet">
    <link href="/Mjh/Public/Admin/css/login.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: my_font;
            src: url("/Mjh/Public/Admin//fonts/my_font.ttf");
        }
    </style>
</head>
<body class="signin">
    <div class="signinpanel">
        <div class="row">
            <div class="col-sm-7">
                <div class="signin-info">
                    <div class="logopanel m-b">
                        <img src="/Mjh/Public/Admin/img/logo.png">
                    </div>
                    <div class="m-b"></div>
                </div>
            </div>
            <div class="col-sm-5">
                <form method="post" action="<?php echo U('Login/index');?>">
                    <h1 class="no-margins" style="color: black;font-family: 'my_font'">登录：</h1>
                    <input type="text" class="form-control uname" name="username" placeholder="用户名" />
                    <input type="password" class="form-control pword m-b" name="password" placeholder="密码" />
                    <input type="text" class="form-control pword m-b" name="verify" id="verify" placeholder="验证码" />
                    <img src="<?php echo U('verify');?>" alt="验证码" onClick="this.src=this.src+'?'+Math.random()"/>
                    <button class="btn btn-success btn-block">登录</button>
                </form>
            </div>
        </div>
        <div class="signup-footer">
            <div class="pull-left" style="color: black">
                &copy; 2016-2017 行色科技
            </div>
        </div>
    </div>
</body>

</html>