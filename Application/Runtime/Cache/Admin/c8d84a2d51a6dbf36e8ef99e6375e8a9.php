<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>会员列表</title>

    <link href="/Mjh/Public/Admin/css/bootstrap.min.css?v=3.4.0" rel="stylesheet">
    <link href="/Mjh/Public/Admin/css/font-awesome.min.css?v=4.3.0" rel="stylesheet">
    <!-- Data Tables -->
    <link href="/Mjh/Public/Admin/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/Mjh/Public/Admin/css/animate.min.css" rel="stylesheet">
    <link href="/Mjh/Public/Admin/css/style.min.css?v=3.1.0" rel="stylesheet">
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>会员列表</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                        <tr>
                            <th>活动编号</th>
                            <th>活动标题</th>
                            <th>活动类型</th>
                            <th>开始时间</th>
                            <th>结束时间</th>
                            <th>封面图片</th>
                            <th>报名人数限制</th>
                            <th>目前报名人数</th>
                            <th>下架活动</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="gradeX">
                                <td><?php echo ($vo["activity_id"]); ?></td>
                                <td><?php echo ($vo["act_title"]); ?></td>
                                <td><?php
 switch($vo['type']){ case 0: echo "长线活动";break; case 1: echo "短线活动";break; }?>
                                </td>
                                <td><?php echo (date('Y-m-d',$vo["start_time"])); ?></td>
                                <td><?php echo (date('Y-m-d',$vo["end_time"])); ?></td>
                                <td><img src="/Mjh/<?php echo $vo['img']?>" style="height: 50px;width: 100px;"></td>
                                <td><?php echo ($vo["astrict"]); ?></td>
                                <td><?php echo ($vo["sign_up"]); ?></td>
                                <td><?php switch($vo['is_sold']){ case 0: echo "否";break; case 1: echo "是";break; }?>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-rounded" href="<?php echo U('Activity/update_activity',array('id'=>$vo['activity_id']));?>">修改</a>
                                    <a class="btn btn-primary btn-rounded" href="#">删除</a>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
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
<!--统计代码，可删除-->
</body>
</html>