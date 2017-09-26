<?php
namespace Admin\Controller;

use Think\Controller;

class UserController extends CommonController{
    //公共方法
    public function _initialize(){
        $this->check_login();//检查登录
    }
    public function index(){
        $this->display();
    }
}
?>