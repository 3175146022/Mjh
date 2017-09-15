<?php
namespace Admin\Model;
use Think\Model;

class UserModel extends Model{
    //登陆自动验证规则
    protected $_validate = array(
        array('username','/^\w{5,12}$/','用户名输入不正确，请重新输入5~12个字符'),
        array('password','/^\w{5,18}$/','密码输入不正确，请重新输入5~18个字符'),
        //array('verify','check_verify','验证码输入不正确，请重新输入',self::EXISTS_VALIDATE,'function'),
    );

    public function login(){

    }
}
?>