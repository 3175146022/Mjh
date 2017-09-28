<?php
namespace Home\Controller;

use Think\Controller;

class UserController extends CommonController{

    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        if ($_SESSION['user_id']){
            $a = M('user')->where('user_id = '.$_SESSION['user_id'])->select();
            $this->assign('data',$a);
            $this->display();//页面赋值
        }

    }

}