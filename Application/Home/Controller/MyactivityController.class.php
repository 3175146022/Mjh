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
    public function index()
    {
        $this->display();//页面赋值
    }

    //报名
    public function sign_up(){
        $id = I('get.id');
        $temp = M('Activity')->where(array('activity_id'=>$id))->field('sign_up,astrict')->find();
        if ($temp['sign_up'] < $temp['astrict']) {
            $data = M('MyActivity')->where(array('activity_id' => $id))->find();
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