<?php
namespace Home\Model;
use Think\Model;

class UserModel extends Model{
    //自动验证
    protected $_validate = array(
        array('user_name','require','请输入昵称！',0),
        array('company','require','请输入组织机构！',0),
        array('user_name','','昵称已存在！',0,'unique',3), // 在新增的时候验证admin_name字段是否唯一
    );
}
?>