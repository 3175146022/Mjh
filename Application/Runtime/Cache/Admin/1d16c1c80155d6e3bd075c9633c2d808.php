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
    <script src="/Mjh/Public/Admin/js/jquery-2.1.1.min.js"></script>
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
        #imgPreview{
            width: 360px;height: 240px;position: relative;left: 425px;
            top:-20px;
            display: none;
        }
        #imgPreview>img{
            width:100%;
            height: 100%;
        }
        .upload-img{
            position:relative;
            top:10px;
            left:15px;
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
                    <form method="post" action="<?php echo U('News/save_add');?>" enctype="multipart/form-data" role="form" class="form-horizontal m-t" >
                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">新闻题目：</label>
                            <div class="col-sm-3">
                                <input type="text" name="title" class="form-control" placeholder="请输入新闻题目">
                            </div>
                        </div>
                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">新闻类别：</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="cate_id">
                                    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option disabled="disabled" value="<?php echo ($vo["cate_id"]); ?>"><?php echo ($vo["cate_name"]); ?></option>
                                        <?php if(is_array($vo["cate"])): $i = 0; $__LIST__ = $vo["cate"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["cate_id"]); ?>">--<?php echo ($vol["cate_name"]); ?>--</option><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">封面图片：</label>
                            <!--<div class="col-sm-3">-->
                                <!--<input type="file" name="" class="form-control">-->
                            <!--</div>-->
                            <div id="imgPreview"></div>
                            <span class="upload-img"><input name="picture" id="fileUpload" accept="image/*" type="file" multiple="multiple"></span>
                            <script type="text/javascript">
                                $(function () { $("#fileUpload").change(function () {
                                    if (typeof (FileReader) != "undefined") {
                                        var dvPreview = $("#imgPreview"); dvPreview.html("");
                                        var regex = /(.jpg|.jpeg|.gif|.png|.bmp)$/;
                                        $($(this)[0].files).each(function () {
                                            var file = $(this);
                                            if (regex.test(file[0].name.toLowerCase())) {
                                                var reader = new FileReader();
                                                reader.onload = function (e) {
                                                    var img = $("<img />");
                                                    img.attr("src", e.target.result);
                                                    dvPreview.append(img);
                                                    $('#imgPreview').css({"display":"block"});
                                                    $('.upload-img').css({"left":"425px"});
                                                };
                                                reader.readAsDataURL(file[0]);
                                            }
                                            else {
                                                alert(file[0].name + " 不是一张图片.");
                                                dvPreview.html("");
                                                $('#imgPreview').css({"display":"none"});
                                                $('.upload-img').css({"left":"15px"});
                                                return false;

                                            }
                                        });
                                    } else {
                                        alert("This browser does not support HTML5 FileReader.");
                                            }
                                    });
                                });
                            </script>
                        </div>


                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">新闻内容：</label>
                            <div class="col-sm-9">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content no-padding">
                                        <script name="content" id="editor" type="text/plain" style="width:100%;height:300px;">

                                        </script>
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
<script type="text/javascript">
    $(function () {
        $("fileupload").change(function () {
            if (typeof (FileReader) != "undefined"){
                var dvPreview = $("#imgPreview");
                dvPreview.html("");
                var regex = /(.jpg|.jpeg|.gif|.png|.bmp)$/;
                $($(this)[0].file).each(function () {
                    var file = $(this);
                    if (regex.test(file[0].name.toLowerCase())){
                        var reader = new FileReader();
                        reader.onload =function (e) {
                            var img = $("<img />");
                            img.attr("src",e.target.result);
                            dvPreview.append(img);
                        }
                        reader.readAsDataURL(file[0]);
                    }else {
                        alert(file[0].name + "is not a valid image file.");
                        dvPreview.html("");
                        return false;
                    }
                });
            }else {
                alert("This browser dose not support HTML5 FileReader.")
            }
        })
    })
</script>
</html>