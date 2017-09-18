<?php
namespace Admin\Model;
use Think\Model;

class TokenModel extends Model{
    //自动验证
    protected $_validate = array(
        array('tok_num','require','请输入令牌编码！'), //默认情况下用正则进行验证
    );
}
?>