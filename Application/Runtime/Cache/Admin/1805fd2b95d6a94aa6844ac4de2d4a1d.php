<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <title>修改活动</title>
    <link href="/Mjh/Public/Admin/css/bootstrap.min.css?v=3.4.0" rel="stylesheet">
    <link href="/Mjh/Public/Admin/css/animate.min.css" rel="stylesheet">
    <link href="/Mjh/Public/Admin/css/style.min.css?v=3.1.0" rel="stylesheet">
    <script type="text/javascript" charset="utf-8" src="/Mjh/Public/Admin/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Mjh/Public/Admin/ueditor/ueditor.all.min.js"> </script>
    <style>
        .droppable-active {
            background-color: #ffe !important;
        }

        .tools a {
            cursor: pointer;
            font-size: 80%;
        }

        .form-body .col-md-6,
        .form-body .col-md-12 {
            min-height: 400px;
        }

        .draggable {
            cursor: move;
        }
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content">

    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>修改活动</h5>
                </div>
                <div class="ibox-content">
                    <form method="post" action="" role="form" class="form-horizontal m-t">
                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">活动名称：</label>
                            <div class="col-sm-3">
                                <input type="text" name="" class="form-control" placeholder="请输入活动名称">
                            </div>
                        </div>
                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">活动开始时间：</label>
                            <div class="col-sm-3">
                                <input type="text" name="" class="form-control" placeholder="请输入活动开始时间">
                            </div>
                        </div>
                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">活动结束时间：</label>
                            <div class="col-sm-3">
                                <input type="text" name="" class="form-control" placeholder="请输入活动结束时间">
                            </div>
                        </div>
                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">活动参加人数限制：</label>
                            <div class="col-sm-3">
                                <input type="text" name="" class="form-control" placeholder="请输入活动参加人数限制">
                            </div>
                        </div>
                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">活动描述：</label>
                            <div class="col-sm-3">
                                <input type="text" name="" class="form-control" placeholder="请输入活动描述">
                            </div>
                        </div>
                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">封面图片：</label>
                            <div class="col-sm-3">
                                <input type="file" name="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">活动类型：</label>
                            <div class="col-sm-3">
                                <label class="radio-inline">
                                    <input type="radio" checked="" value="option1" id="optionsRadios1" name="lx" style="height: 15px;width: 15px; margin-top: 1px;">长线活动</label>
                                <label class="radio-inline">
                                    <input type="radio" value="option2" id="optionsRadios2" name="lx" style="height: 15px;width: 15px; margin-top: 1px;">短线活动</label>
                            </div>
                        </div>
                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">下架活动：</label>
                            <div class="col-sm-3">
                                <label class="radio-inline">
                                    <input type="radio" checked="" value="option1" id="optionsRadios1" name="xj" style="height: 15px;width: 15px; margin-top: 1px;">是</label>
                                <label class="radio-inline">
                                    <input type="radio" value="option2" id="optionsRadios2" name="xj" style="height: 15px;width: 15px; margin-top: 1px;">否</label>
                            </div>
                        </div>
                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">活动内容：</label>
                            <div class="col-sm-9">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content no-padding">
                                        <script id="editor" type="text/plain" style="width:100%;height:300px;"></script>
                                        </div>
                                        <script type="text/javascript">
                                        var ue = UE.getEditor('editor',{
                                            width:'100%',
                                            height:'300px',
                                            textarea:'content',
                                        });
                                        function setContent(data){
                                            ue.setContent(data);
                                        }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group draggable">
                            <div class="col-sm-3 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit">保存内容</button>
                                <a class="btn btn-white" href="<?php echo U('Activity/index');?>">取消</a>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

</div>
</body>

</html>