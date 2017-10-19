<?php
namespace Home\Controller;

use Think\Controller;

class PopularityController extends CommonController{

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
                $token_integral['token_reputation'] = 3;
                $token_integral['token_name'] = '欢喜令';
                break;
            case 2:
                $token_integral['token_reputation'] = 6;
                $token_integral['token_name'] = '义士令';
                break;
            case 3:
                $token_integral['token_reputation'] = 18;
                $token_integral['token_name'] = '英雄令';
                break;
            case 4:
                $token_integral['token_reputation'] = 36;
                $token_integral['token_name'] = '大侠令';
                break;
            case 5:
                $token_integral['token_reputation'] = 72;
                $token_integral['token_name'] = '大谦令';
                break;
        }
        $tr = [
            'tr' => $token_integral['token_reputation'],
            'tn' => $token_integral['token_name'],
            'bind_time' => $token_integral['bind_time']
        ];

        $reputation = M('user')->where('user_id = '.$_SESSION['user_id'])->field('reputation')->find();
        $mark = M('mark')->where('user_id = '.$_SESSION['user_id'])->order('mark_time desc')->limit(3)->select();
        $friend = M('friend')->where('friend_id = '.$_SESSION['user_id'])->order('add_time desc')->limit(3)->select();
        foreach ($friend as $k => $v){
            for ($i = 0;$i < count($friend);$i++){
                $a[$i] = M('user')->where('user_id = '.$friend[$i]['user_id'])->field('user_name')->find();
                $a[$i]['add_time'] = $friend[$i]['add_time'];
            }
        }
        //print_r($a);exit;
        $this->assign('token_reputation',$tr);
        $this->assign('mark',$mark);
        $this->assign('friend',$a);
        $this->assign('reputation',$reputation);
        $this->display();//页面赋值
    }

}