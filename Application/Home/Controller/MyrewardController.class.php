<?php
namespace Home\Controller;

use Think\Controller;
header('Content-Type:text/html; charset= utf-8');
class MyrewardController extends CommonController{
    public function __construct(){
        parent::__construct();
    }
    //我的悬赏
    public function index(){
        //我发布的悬赏
        $user = M('User')->where(array('user_id'=>$_SESSION['user_id']))->field('user_name')->find();
        $list = M('Reward')->where(array('author'=>$user['user_name']))->order('add_time desc')->select();
        //我的悬赏中
        $s = array(1,3);
        $where1 = array(
            'author' => $user['user_name'],
            're_status' => array("in",$s),
        );
        $list1 = M('Reward')->where($where1)->order('add_time desc')->select();
        foreach ($list1 as $k=>$v){
            $array[$k] = $v['end_time'];
        }
        $str = json_encode($array);
        //我的悬赏审核中
        $where2 = array(
            'author' => $user['user_name'],
            're_status' => '0',
        );
        $list2 = M('Reward')->where($where2)->order('add_time desc')->select();
        foreach ($list2 as $k=>$v){
            $array2[$k] = $v['end_time'];
        }
        $str2 = json_encode($array2);
        //我的悬赏已完成
        $where3 = array(
            'author' => $user['user_name'],
            're_status' => '2',
        );
        $list3 = M('Reward')->where($where3)->order('add_time desc')->select();
        foreach ($list3 as $k=>$v){
            $array3[$k] = $v['end_time'];
        }
        $str3 = json_encode($array3);
        //已揭榜 悬赏中
        $where4 = array(
            'undertake' => $user['user_name'],
            're_status' => '3',
        );
        $list4 = M('Reward')->where($where4)->order('add_time desc')->select();
        foreach ($list4 as $k=>$v){
            $array4[$k] = $v['end_time'];
        }
        $str4 = json_encode($array4);
        //已揭榜 已完成
        $where5 = array(
            'undertake' => $user['user_name'],
            're_status' => '3',
        );
        $list5 = M('Reward')->where($where5)->order('add_time desc')->select();
        foreach ($list5 as $k=>$v){
            $array5[$k] = $v['end_time'];
        }
        $str5 = json_encode($array5);

        $by[0] = $str;
        $by[1] = $str2;
        $by[2] = $str3;
        $by[3] = $str4;
        $by[4] = $str5;
        $by1 = json_encode($by);
        //我接手的悬赏
        $take = M('Reward')->where(array('undertake'=>$user['user_name']))->order('add_time desc')->select();
        $this->assign('str',$by1);
        $this->assign('take',$take);
        $this->assign('list',$list);
        $this->display();//页面赋值
    }
}