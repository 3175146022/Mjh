<?php
namespace Admin\Model;
use Think\Model;

class ActivityModel extends Model{
    //自动验证
    protected $_validate = array(
        array('act_cate_title','require','请输入活动标题！',0),
        array('img_detail','require','请输入封面详解！',0),
    );

}
?>