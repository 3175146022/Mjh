<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <title>添加新闻</title>
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
                    <h5>添加新闻</h5>
                </div>
                <div class="ibox-content">
                    <form method="post" action="<?php echo U('News/add_news');?>" role="form" class="form-horizontal m-t">
                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">新闻题目：</label>
                            <div class="col-sm-3">
                                <input type="text" name="" class="form-control" placeholder="请输入新闻题目">
                            </div>
                        </div>
                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">新闻类别：</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="">
                                    <option>江湖须知</option>
                                    <option>江湖告示</option>
                                    <option>江湖推介</option>
                                    <option>江湖故事</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">封面图片：</label>
                            <div class="col-sm-3">
                                <input type="file" name="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">新闻内容：</label>
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