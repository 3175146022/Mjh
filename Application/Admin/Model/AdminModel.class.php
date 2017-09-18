<?php
namespace Admin\Model;
use Think\Model;

class AdminModel extends Model{
    //自动验证
    protected $_validate = array(
        array('admin_name','','账号已存在！',0,'unique',3), // 在新增的时候验证admin_name字段是否唯一
    );
}
?>
