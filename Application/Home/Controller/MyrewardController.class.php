<?php
namespace Home\Controller;

use Think\Controller;

class MyrewardController extends CommonController{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $user = M('User')->where(array('user_id'=>$_SESSION['user_id']))->field('user_name')->find();
        $list = M('Reward')->where(array('author'=>$user['user_name']))->select();
        $this->assign('list',$list);
        $this->display();//页面赋值
    }
}