<?php
namespace Admin\Model;
use Think\Model;

class AdminModel extends Model{
    //自动验证
    protected $_validate = array(
        array('admin_name','require','请输入管理员名！',0),
        array('password','require','请输入管理员密码！',0),
        array('admin_password','require','请输入超级管理员密码！',0),
        array('admin_name','','账号已存在！',0,'unique',3), // 在新增的时候验证admin_name字段是否唯一
    );
}
?>
