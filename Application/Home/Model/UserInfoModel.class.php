<?php
namespace Home\Model;
use Think\Model;

class UserInfoModel extends Model{
    protected $_validate = array(
        array('name','require','请输入名字！',0),
        array('phone','require','请输入手机号！',0),
        array('area','require','请选择地区！',0),
        array('ad_detail','require','请输入详细地址！',0),
        array('postcode','require','请输入邮编！',0),

    );
}
?>