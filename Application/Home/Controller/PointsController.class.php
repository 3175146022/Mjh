<?php
namespace Home\Controller;

use Think\Controller;

class PointsController extends CommonController{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $integral = M('user')->where('user_id = '.$_SESSION['user_id'])->field('integral')->find();
        $mark = M('mark')->where('user_id = '.$_SESSION['user_id'])->order('mark_time desc')->select();
        //var_dump($mark);exit;
        $this->assign('mark',$mark);
        $this->assign('integral',$integral);
        $this->display();//页面赋值
    }
}