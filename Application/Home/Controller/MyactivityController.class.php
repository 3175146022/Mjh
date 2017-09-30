<?php
namespace Home\Controller;

use Think\Controller;

class MyactivityController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    }

    //我的活动
    public function index(){
        $data = M('MyActivity')->where(array('user_id'=>$_SESSION['user_id']))->field('activity_id')->select();
        foreach ($data as $k=>$v){
            $list[] = M('Activity')->where(array('activity_id'=>$v['activity_id']))->find();
            if($list['end_time'] <= time()){
                $join[] = M('Activity')->where(array('activity_id'=>$v['activity_id']))->find();
            }
        }
        $this->assign('list',$join);
        $this->display();//页面赋值
    }

    //报名
    public function sign_up(){
        $id = I('get.id');
        $temp = M('Activity')->where(array('activity_id'=>$id))->field('sign_up,astrict,end_time,is_sold')->find();
        if (($temp['sign_up'] < $temp['astrict']) && ($temp['end_time'] > time()) && ($temp['is_sold'] == 0)) {
            $where = array(
                'activity_id' => $id,
                'user_id' => $_SESSION['user_id'],
            );
            $data = M('MyActivity')->where($where)->find();
            if($data == null){
                $map = array(
                    'sign_up' => $temp['sign_up'] + 1,
                );
                $li = M('Activity')->where(array('activity_id'=>$id))->save($map);
                $post = array(
                    'activity_id' => $id,
                    'user_id' => $_SESSION['user_id'],
                );
                $res = M('MyActivity')->add($post);
                $result = array(
                    'str' => '1',
                    'li' => $map['sign_up'],
                );
                echo json_encode($result);
            }else{
                $str = "2";
                echo json_encode($str);
            }
        } else {
            $str = "3";
            echo json_encode($str);
        }
    }
}