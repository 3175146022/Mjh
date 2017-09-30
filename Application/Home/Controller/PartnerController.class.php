<?php
namespace Home\Controller;

use Think\Controller;

class PartnerController extends CommonController{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $user = M('user')->where('user_id = '.$_SESSION['user_id'])->find();
        $data = M('friend')->where('user_id ='.$_SESSION['user_id'])->select();
        for ($i = 0;$i < count($data);$i++){
            $c = M('user')->where('user_id = '.$data[$i]['friend_id'])->find();
            $data[$i]['friend_avatar'] = $c['avatar'];
            $data[$i]['friend_user_id'] = $c['user_id'];
            $data[$i]['friend_user_name'] = $c['user_name'];
        }
        //var_dump($data);exit;
        $this->assign('user',$user);
        $this->assign('data',$data);
        $this->display();//页面赋值
    }

}