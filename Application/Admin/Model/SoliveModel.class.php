<?php
namespace Admin\Model;
use Think\Model;

class SoliveModel extends Model{
    //自动验证
    protected $_validate = array(
        array('so_title','require','请输入直播标题！',0),
        array('so_detial','require','请输入直播详解！',0),
        array('so_link','require','请输入直播链接！',0),
        array('so_author','require','请输入发布者！',0),
    );
}
?>