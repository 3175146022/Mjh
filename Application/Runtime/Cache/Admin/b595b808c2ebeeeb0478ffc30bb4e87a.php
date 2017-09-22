<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>慢慢江湖后台管理</title>
    <link href="/Mjh/Public/Admin/css/bootstrap.min.css?v=3.4.0" rel="stylesheet">
    <link href="/Mjh/Public/Admin/css/font-awesome.min.css?v=4.3.0" rel="stylesheet">
    <link href="/Mjh/Public/Admin/css/animate.min.css" rel="stylesheet">
    <link href="/Mjh/Public/Admin/css/style.min.css?v=3.1.0" rel="stylesheet">
</head>
<body class="fixed-sidebar full-height-layout gray-bg">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close">
            <i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span>
                            <a href="/Mjh"><img alt="image" src="/Mjh/Public/Admin/img/logo.png" /></a>
                        </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs">
                                    <strong class="font-bold">江湖管理员</strong>
                                </span>
                                <span class="text-muted text-xs block"><?php echo ($admin); ?></span>
                            </span>
                        </a>
                    </div>
                    <div class="logo-element">江湖
                    </div>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-home"></i>
                        <span class="nav-label">首页</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-group"></i>
                        <span class="nav-label">会员管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="<?php echo U('User/index');?>">会员列表</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-th-list"></i>
                        <span class="nav-label">新闻管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="<?php echo U('News/index');?>" data-index="0">新闻列表</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="<?php echo U('News/add_news');?>" data-index="0">添加新闻</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="<?php echo U('News/news_cate');?>" data-index="0">新闻分类</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-money"></i>
                        <span class="nav-label">悬赏管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="<?php echo U('Award/index');?>" data-index="0">悬赏列表</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-th-large"></i>
                        <span class="nav-label">直播管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="<?php echo U('Solive/index');?>" data-index="0">直播列表</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="<?php echo U('Solive/add_solive');?>" data-index="0">添加直播</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-delicious"></i>
                        <span class="nav-label">活动管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="<?php echo U('Activity/index');?>" data-index="0">活动列表</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="<?php echo U('Activity/add_activity');?>" data-index="0">添加活动</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="<?php echo U('Activity/cate');?>" data-index="0">活动分类</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-th-large"></i>
                        <span class="nav-label">令牌管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="<?php echo U('Token/index');?>" data-index="0">令牌列表</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="<?php echo U('Token/add_token');?>" data-index="0">添加令牌</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span class="nav-label">后台管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="<?php echo U('Admin/index');?>" data-index="0">管理员列表</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="<?php echo U('Admin/add_user');?>" data-index="0">添加管理员</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#">
                        <i class="fa fa-bars"></i>
                    </a>
                    <form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                        <div class="form-group">
                            <input type="text" placeholder="请输入您需要查找的内容 …" class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>
                </div>
            </nav>
        </div>
        <!--操作部分-->
        <div class="row content-tabs">
            <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs J_menuTabs">
                <div class="page-tabs-content">
                    <a href="javascript:;" class="active J_menuTab" data-id="<?php echo U('Index/index_v1');?>">首页</a>
                </div>
            </nav>
            <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
            </button>
            <div class="btn-group roll-nav roll-right">
                <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>
                </button>
                <ul role="menu" class="dropdown-menu dropdown-menu-right">
                    <li class="J_tabShowActive">
                        <a>定位当前选项卡</a>
                    </li>
                    <li class="divider"></li>
                    <li class="J_tabCloseAll">
                        <a>关闭全部选项卡</a>
                    </li>
                    <li class="J_tabCloseOther">
                        <a>关闭其他选项卡</a>
                    </li>
                </ul>
            </div>
            <a href="<?php echo U('Login/login_out');?>" class="roll-nav roll-right J_tabExit">
                <i class="fa fa fa-sign-out"></i> 退出</a>
        </div>

        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="<?php echo U('Index/index_v1');?>" frameborder="0" data-id="<?php echo U('Index/index_v1');?>" seamless></iframe>
        </div>
        <div class="footer">
            <div class="pull-right">&copy; 2016-2017 <a href="javascript:;" target="_blank">慢慢江湖</a>
            </div>
        </div>
    </div>
    <!--右侧部分结束-->
    <!--右侧边栏开始-->

    <!--右侧边栏结束-->
</div>
<!--全局js-->
<script src="/Mjh/Public/Admin/js/jquery-2.1.1.min.js"></script>
<script src="/Mjh/Public/Admin/js/bootstrap.min.js?v=3.4.0"></script>
<script src="/Mjh/Public/Admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/Mjh/Public/Admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/Mjh/Public/Admin/js/plugins/layer/layer.min.js"></script>

<!-- 自定义js -->
<script src="/Mjh/Public/Admin/js/hplus.min.js?v=3.1.0"></script>
<script type="text/javascript" src="/Mjh/Public/Admin/js/contabs.min.js"></script>

<!-- 第三方插件 -->
<script src="/Mjh/Public/Admin/js/plugins/pace/pace.min.js"></script>

</body>
</html>