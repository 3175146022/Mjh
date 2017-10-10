<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends CommonController{

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $timestamp = time();//时间戳
        $noncestr = $this->random();////随机字符串
        $jsapi_ticket = $this->jsapis();//获取jsapi_ticket
        $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $string1 = 'jsapi_ticket=' . $jsapi_ticket . '&noncestr=' . $noncestr . '&timestamp=' . $timestamp . '&url=' . $url;
        $signature = sha1($string1);

        $this->assign('signature',$signature);
        $this->assign('timestamp',$timestamp);
        $this->assign('noncestr',$noncestr);
        $this->display();//页面赋值
    }

}