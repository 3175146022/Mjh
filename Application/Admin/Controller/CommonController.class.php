<?php
namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller{
    //检查登录
    public function check_login(){
        if(!session('?admin')){
            $this->redirect('Login/index');
        }
    }
}
?>