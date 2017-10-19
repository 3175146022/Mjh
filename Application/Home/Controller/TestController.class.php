<?php
namespace Home\Controller;

use Think\Controller;

class TestController extends Controller{
    public function index()
    {
        $id = $_SESSION['friends_user'];
        $user = M('User')->where(array('user_id'=>$id))->find();
        $this->assign('user',$user);
        $this->display();
    }
}