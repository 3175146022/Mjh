<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>新闻修改</title>
    <link href="/Mjh/Public/Admin/css/bootstrap.min.css?v=3.4.0" rel="stylesheet">
    <link href="/Mjh/Public/Admin/css/font-awesome.min.css?v=4.3.0" rel="stylesheet">
    <!-- Data Tables -->
    <link href="/Mjh/Public/Admin/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/Mjh/Public/Admin/css/animate.min.css" rel="stylesheet">
    <link href="/Mjh/Public/Admin/css/style.min.css?v=3.1.0" rel="stylesheet">
    <script type="text/javascript" charset="utf-8" src="/Mjh/Public/Admin/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Mjh/Public/Admin/ueditor/ueditor.all.min.js"> </script>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>新闻修改</h5>
                </div>
                <div class="ibox-content">
                    <form method="post" action="<?php echo U('News/add_news');?>" role="form" class="form-horizontal m-t">
                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">新闻题目：</label>
                            <div class="col-sm-3">
                                <input type="text" name="" class="form-control" value="请输入新闻题目">
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
                                <a class="btn btn-white" href="<?php echo U('News/index');?>">取消</a>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 全局js -->
<script src="/Mjh/Public/Admin/js/jquery-2.1.1.min.js"></script>
<script src="/Mjh/Public/Admin/js/bootstrap.min.js?v=3.4.0"></script>
<script src="/Mjh/Public/Admin/js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="/Mjh/Public/Admin/js/plugins/layer/layer.min.js"></script>
<!-- Data Tables -->
<script src="/Mjh/Public/Admin/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/Mjh/Public/Admin/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<!-- 自定义js -->
<script src="/Mjh/Public/Admin/js/content.min.js?v=1.0.0"></script>
<!-- Page-Level Scripts -->

<script>
    $(document).ready(function(){$(".dataTables-example").dataTable();var a=$("#editable").dataTable();a.$("td").editable("../example_ajax.php",{"callback":function(d,c){var b=a.fnGetPosition(this);a.fnUpdate(d,b[0],b[1])},"submitdata":function(c,b){return{"row_id":this.parentNode.getAttribute("id"),"column":a.fnGetPosition(this)[2]}},"width":"90%","height":"100%"})});function fnClickAddRow(){$("#editable").dataTable().fnAddData(["Custom row","New row","New row","New row","New row"])};
</script>
<!--<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>-->
<!--&lt;!&ndash;统计代码，可删除&ndash;&gt;-->
</body>
</html>