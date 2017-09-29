<?php
namespace Home\Controller;

use Think\Controller;

class PopularityController extends CommonController{

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $reputation = M('user')->where('user_id = '.$_SESSION['user_id'])->field('reputation')->find();
        $mark = M('mark')->where('user_id = '.$_SESSION['user_id'])->order('mark_time desc')->select();
        //var_dump($mark);exit;
        $this->assign('mark',$mark);
        $this->assign('reputation',$reputation);
        $this->display();//页面赋值
    }

}