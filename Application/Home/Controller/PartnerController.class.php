<?php
namespace Home\Controller;

use Think\Controller;

class PartnerController extends CommonController{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $user = M('user')->where('user_id = '.$_SESSION['user_id'])->find();

        $firent = M('User')->where(array('user_id'=>$user['pid']))->find();
        $data = M('friend')->where('user_id ='.$_SESSION['user_id'])->select();
        for ($i = 0;$i < count($data);$i++){
            $c = M('user')->where('user_id = '.$data[$i]['friend_id'])->find();
            $data[$i]['friend_avatar'] = $c['avatar'];
            $data[$i]['friend_user_id'] = $c['user_id'];
            $data[$i]['friend_user_name'] = $c['user_name'];
        }

        $timestamp = time();//时间戳
        $noncestr = $this->random();////随机字符串
        $jsapi_ticket = $this->jsapis();//获取jsapi_ticket
        $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $string1 = 'jsapi_ticket=' . $jsapi_ticket . '&noncestr=' . $noncestr . '&timestamp=' . $timestamp . '&url=' . $url;
        $signature = sha1($string1);

        $curl ='http://'.$_SERVER['HTTP_HOST'].'/index.php/Home/login/index/user_id/'.$_SESSION['user_id'].'.html';
        $this->assign('user',$user);
        $this->assign('signature',$signature);
        $this->assign('timestamp',$timestamp);
        $this->assign('curl',$curl);
        $this->assign('noncestr',$noncestr);
        $this->assign('firent',$firent);
        $this->assign('data',$data);
        $this->display();//页面赋值
    }

}