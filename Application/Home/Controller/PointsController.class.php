<?php
namespace Home\Controller;

use Think\Controller;

class PointsController extends CommonController{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $token_integral = M('user')->where('user_id = '.$_SESSION['user_id'])
                                   ->join('token ON token.token_id = user.token_id')
                                   ->find();
        //var_dump($token_integral);exit;
        switch ($token_integral['tok_level']){
            case 1:
                $token_integral['token_integral'] = 3;
                $token_integral['token_name'] = '欢喜令';
                break;
            case 2:
                $token_integral['token_integral'] = 6;
                $token_integral['token_name'] = '义士令';
                break;
            case 3:
                $token_integral['token_integral'] = 18;
                $token_integral['token_name'] = '英雄令';
                break;
            case 4:
                $token_integral['token_integral'] = 36;
                $token_integral['token_name'] = '大侠令';
                break;
            case 5:
                $token_integral['token_integral'] = 72;
                $token_integral['token_name'] = '大谦令';
                break;
        }
        $ti = [
            'ti' => $token_integral['token_integral'],
            'tn' => $token_integral['token_name'],
            'bind_time' => $token_integral['bind_time']
        ];
        //var_dump($token_integral);exit;
        $integral = M('user')->where('user_id = '.$_SESSION['user_id'])->field('integral')->find();
        $mark = M('mark')->where('user_id = '.$_SESSION['user_id'])->order('mark_time desc')->limit(10)->select();
        //var_dump($mark);exit;
        $this->assign('token_integral',$ti);
        $this->assign('mark',$mark);
        $this->assign('integral',$integral);
        $this->display();//页面赋值
    }
}