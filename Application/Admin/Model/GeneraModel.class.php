<?php
namespace Admin\Model;
use Think\Model;

class GeneraModel extends Model{
    //自动验证
    protected $_validate = array(
        array('content','require','请输入推广内容！',0),
    );
}
?>