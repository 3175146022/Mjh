<?php
namespace Admin\Controller;
use Think\Controller;

class LoginController extends CommonController{
    //登录
    public function index(){
        if($_POST){
            $code = I('verify');
            //检查验证码
            if(!check_verify($code)){
                $this->error('验证码错误！');
            }else{
                $where = array(
                    'admin_name' => $_POST['admin_name'],
                    'password' => md5($_POST['password']),
                );
                $data = M('Admin')->where($where)->select();
                if($data){
                    session('admin',$data[0]['admin_name']);
                    session('admin_id',$data[0]['id']);
                    $this->redirect('Index/index');
                }else{
                    echo "<script>alert('请输入正确的账号或密码！')</script>";
                }
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

    //退出登录
    public function login_out(){
        session(null);
        $this->redirect('Login/index');
    }

}
?>