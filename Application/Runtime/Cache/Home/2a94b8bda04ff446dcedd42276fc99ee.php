<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title></title>
    <link rel="stylesheet" type="text/css" href="/Mjh/Public/Home/css/public.css"/>
    <script src="/Mjh/Public/Home/js/zepto.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<div id="all">
    <iframe src=""></iframe>
    <div class="mt"></div>
    <div class="nav">
        <i class="list_text fl">
            <ul>
                <li><a class="xuzhi" href="<?php echo U('Notice/index');?>"></a></li>
                <li><a class="gaoshi" href="gaoshi.html"></a></li>
                <li><a class="xuanshang" href="xuanshang.html"></a></li>
                <li><a class="rank" href="rank.html"></a></li>
            </ul>
        </i>
        <em id="activity">
            <ul>
                <li><a class="activity1" href=""></a></li>
                <li><a class="zhibo" href=""></a></li>
                <li><a class="tuijie" href=""></a></li>
                <li><a class="huodong" href=""></a></li>
            </ul>
        </em>
        <a href="my.html" class="my_home"><i class="my fr"></i></a>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    $(function(){
        $("iframe").css("height",$(window).height() - 50)
//		设置iframe高度
        $(".list_text").on("click",function(){
            $(".list_text ul").toggleClass("active")
        })

        $("#activity").on("click",function(){
            $("#activity ul").toggleClass("active")
        })
//		列表弹出框

//		$(".nav").find('a').on('click', function () {
//		  	var $el = $(this)
//		    	id = $el.attr('href');
//			$('iframe').attr("src",id)
//			$(".active").removeClass("active")
//			$(this).addClass("active")
//
//			var background = $el.css("background")
//			$(".list_text").css("background",background)
//
//		  return false;
//		});

        $(".list_text").find('a').on('click', function () {
            var $el = $(this)
            id = $el.attr('href');
            $('iframe').attr("src",id)
            $(".active").removeClass("active")
            $(this).addClass("active")

            var cls= $el.attr("class")
            $(".list_text").removeClass().addClass(cls + " list_text fl")

            return false;
        });

        $(".my_home").on('click', function () {
            var $el = $(this)
            id = $el.attr('href');
            $('iframe').attr("src",id)
            $(".active").removeClass("active")
            $(this).find("i").addClass("active")

            $(".list_text").removeClass().addClass("list_text fl")
            return false;
        })

    })

</script>