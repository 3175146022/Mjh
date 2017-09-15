<?php
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller{
    //登录
    public function index(){
        if($_POST){
            $code = I('verify');
            //检查验证码
            if(!check_verify($code)){
                $this->error('验证码错误！');
            }else{
                $this->redirect('Index/index');
            }
        }
        $this->display();//页面输出
    }
    //生成验证码
    public function verify(){
        $Verify = new \Think\Verify();
        $Verify->useImgBg = true;
        $Verify->fontSize = 18;
        $Verify->length   = 5;
        $Verify->entry();
    }
    //检查登录
    public function check_login(){

    }
}
?>