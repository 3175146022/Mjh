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
                                    <th>编号</th>
                                    <th>兴趣</th>
                                    <th>行业</th>
                                    <th>手机号</th>
                                    <th>性别</th>
                                    <th>姓名</th>
                                    <th>积分</th>
                                    <th>声望</th>
                                    <th>头像</th>
                                    <th>二维码</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="gradeX">
                                    <td>1</td>
                                    <td>Internet Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td>4</td>
                                    <td>4</td>
                                    <td>4</td>
                                    <td>4</td>
                                    <td>X</td>
                                    <td>4</td>
                                    <td>X</td>
                                    <td>
                                        <a class="btn btn-primary btn-rounded" href="#">查看详情</a>
                                        <a class="btn btn-primary btn-rounded" href="#">删除</a>
                                    </td>
                                </tr>
                                <tr class="gradeC">
                                    <td>2</td>
                                    <td>Internet Explorer 5.0
                                    </td>
                                    <td>Win 95+</td>
                                    <td class="center">5</td>
                                    <td>4</td>
                                    <td>4</td>
                                    <td>4</td>
                                    <td class="center">C</td>
                                    <td class="center">4</td>
                                    <td class="center">X</td>
                                    <td>
                                        <a class="btn btn-primary btn-rounded" href="#">查看详情</a>
                                        <a class="btn btn-primary btn-rounded" href="#">删除</a>
                                    </td>
                                </tr>
                                <tr class="gradeA">
                                    <td>3</td>
                                    <td>Internet Explorer 5.5
                                    </td>
                                    <td>Win 95+</td>
                                    <td class="center">5.5</td>
                                    <td class="center">A</td>
                                    <td>4</td>
                                    <td>4</td>
                                    <td>4</td>
                                    <td class="center">4</td>
                                    <td class="center">X</td>
                                    <td>
                                        <a class="btn btn-primary btn-rounded" href="#">查看详情</a>
                                        <a class="btn btn-primary btn-rounded" href="#">删除</a>
                                    </td>
                                </tr>
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
    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
    <!--统计代码，可删除-->
</body>
</html>