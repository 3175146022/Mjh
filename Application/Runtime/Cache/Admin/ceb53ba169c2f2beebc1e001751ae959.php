<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <title>首页</title>
    <link href="/Mjh/Public/Admin/css/bootstrap.min.css?v=3.4.0" rel="stylesheet">
    <link href="/Mjh/Public/Admin/css/font-awesome.min.css?v=4.3.0" rel="stylesheet">
    <link href="/Mjh/Public/Admin/css/animate.min.css" rel="stylesheet">
    <link href="/Mjh/Public/Admin/css/style.min.css?v=3.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-4">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>待审核悬赏</h3>
                    <p class="small"><i class="fa fa-hand-o-up"></i> 注意：</p>

                    <div class="input-group">
                        <input type="text" placeholder="查询悬赏" class="input input-sm form-control">
                        <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-white"> <i class="fa fa-search"></i> 查询</button>
                        </span>
                    </div>

                    <ul class="sortable-list connectList agile-list">
                        <li class="warning-element">
                            加强过程管理，及时统计教育经费使用情况，做到底码清楚，
                            <div class="agile-detail">
                                <a href="#" class="pull-right btn btn-xs btn-white">标签</a>
                                <i class="fa fa-clock-o"></i> 2015.09.01
                            </div>
                        </li>
                        <li class="success-element">
                            支持财会人员的继续培训工作。
                            <div class="agile-detail">
                                <a href="#" class="pull-right btn btn-xs btn-white">标记</a>
                                <i class="fa fa-clock-o"></i> 2015.05.12
                            </div>
                        </li>
                        <li class="info-element">
                            协同教导处搞好助学金、减免教科书费的工作。
                            <div class="agile-detail">
                                <a href="#" class="pull-right btn btn-xs btn-white">标记</a>
                                <i class="fa fa-clock-o"></i> 2015.09.10
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>近期活动</h3>
                    <p class="small"><i class="fa fa-hand-o-up"></i> 注意：</p>
                    <ul class="sortable-list connectList agile-list">
                        <li class="success-element">
                            全面、较深入地掌握我们“产品”的功能、特色和优势并做到应用自如。
                            <div class="agile-detail">
                                <a href="#" class="pull-right btn btn-xs btn-white">标签</a>
                                <i class="fa fa-clock-o"></i> 2015.09.01
                            </div>
                        </li>
                        <li class="success-element">
                            根据自己以前所了解的和从其他途径搜索到的信息，录入客户资料150家。
                            <div class="agile-detail">
                                <a href="#" class="pull-right btn btn-xs btn-white">标记</a>
                                <i class="fa fa-clock-o"></i> 2015.05.12
                            </div>
                        </li>
                        <li class="warning-element">
                            锁定有意向客户20家。
                            <div class="agile-detail">
                                <a href="#" class="pull-right btn btn-xs btn-white">标记</a>
                                <i class="fa fa-clock-o"></i> 2015.09.10
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>问题</h3>
                    <p class="small"><i class="fa fa-hand-o-up"></i> 注意：</p>
                    <ul class="sortable-list connectList agile-list">
                        <li class="info-element">
                            制定工作日程表
                            <div class="agile-detail">
                                <a href="#" class="pull-right btn btn-xs btn-white">标记</a>
                                <i class="fa fa-clock-o"></i> 2015.09.10
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- 全局js -->
<script src="/Mjh/Public/Admin/js/jquery-2.1.1.min.js"></script>
<script src="/Mjh/Public/Admin/js/bootstrap.min.js?v=3.4.0"></script>
<script src="/Mjh/Public/Admin/js/jquery-ui-1.10.4.min.js"></script>

<!-- 自定义js -->
<script src="/Mjh/Public/Admin/js/content.min.js?v=1.0.0"></script>

<script>
    $(document).ready(function () {
        $(".sortable-list").sortable({
            connectWith: ".connectList"
        }).disableSelection();

    });
</script>

<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
<!--统计代码，可删除-->

</body>

</html>