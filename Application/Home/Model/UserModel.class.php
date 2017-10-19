<?php
namespace Home\Model;
use Think\Model;

class UserModel extends Model{
    //自动验证
    protected $_validate = array(
        array('user_name','require','请输入昵称！',0),
        array('address','require','请选取地址！',0),
        array('phone_num','require','请输入手机号！',0),
        array('user_wx','require','请输入微信号！',0),
        array('company','require','请输入组织机构！',0),
        array('user_name','','昵称已存在！',0,'unique',3), // 在新增的时候验证admin_name字段是否唯一
        array('phone_num','/^1[34578]\d{9}$/','请输入正确的手机号！',0,'regex',1),
    );
}
?>