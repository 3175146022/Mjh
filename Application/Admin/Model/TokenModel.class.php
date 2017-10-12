<?php
namespace Admin\Model;
use Think\Model;

class TokenModel extends Model{
    //自动验证
    protected $_validate = array(
        array('tok_num','require','请输入令牌编码！'), //默认情况下用正则进行验证
        array('phone','require','请输入手机号！'), //默认情况下用正则进行验证
        array('phone','','手机号已存在！',0,'unique',3), // 在新增的时候验证admin_name字段是否唯一
        array('tok_num','','令牌已存在！',0,'unique',3), // 在新增的时候验证admin_name字段是否唯一
    );
}
?>