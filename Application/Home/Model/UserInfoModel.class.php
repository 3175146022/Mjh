<?php
namespace Home\Model;
use Think\Model;

class UserInfoModel extends Model{
    protected $_validate = array(
        array('name','require','请输入名字！',0),
        array('name','/^[\u4E00-\u9FA5]{1,6}$/','请输入正确的中文名!'),
        array('phone','require','请输入手机号！',0),
        array('phone','/^1[34578]\d{9}$/','请输入正确的手机号！',0),
        array('area','require','请选择地区！',0),
        array('ad_detail','require','请输入详细地址！',0),
        array('postcode','require','请输入邮编！',0),
        array('postcode','/^[1-9][0-9]{5}$/','请输入正确的邮编！',0),

    );
}
?>