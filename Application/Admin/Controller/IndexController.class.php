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
        $list = M('Activity')->order(array('add_time'=>'desc'))->limit(10)->select();
        $this->assign('list',$list);
        $this->display();
    }

}