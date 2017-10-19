<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends CommonController{
    //公共方法
    public function _initialize(){
        $this->check_login();//检查登录
    }
    //首页
    public function index(){
        $admin = $_SESSION['admin'];
        $this->assign('admin',$admin);
        $this->display();
    }
    public function index_v1(){
        //活动列表
        $list = M('Activity')->order(array('add_time'=>'desc'))->limit(10)->select();
        //签名推广列表
        $mark = M('Genera')->order(array('add_time'=>'desc'))->limit(10)->select();
        //审核
        $reward = M('reward')->where('re_status = 0')->limit(10)->select();
        //var_dump($reward);exit;
        $this->assign('mark',$mark);
        $this->assign('list',$list);
        $this->assign('reward',$reward);
        $this->display();
    }

}