<?php
namespace Home\Model;
use Think\Model;

class UserModel extends Model{
    //自动验证
    protected $_validate = array(
        array('user_name','require','请输入昵称！',0),
        array('company','require','请输入组织机构！',0),

    );
}
?>