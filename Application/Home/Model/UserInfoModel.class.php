<?php
namespace Home\Model;
use Think\Model;

class UserInfoModel extends Model{
    protected $_validate = array(
        array('name','require','请输入名字！',0),
        array('name','/^([\xe4-\xe9][\x80-\xbf]{2}){2,4}$/','请输入正确的中文名!',1,'regex',1),
        array('phone','require','请输入手机号！',0),
        array('phone','/^1[34578]\d{9}$/','请输入正确的手机号！',1,'regex',1),
        array('phone','','手机号已存在！',0,'unique',3), // 在新增的时候验证phone字段是否唯一
        array('area','require','请选择地区！',0),
        array('ad_detail','require','请输入详细地址！',0),
        array('postcode','require','请输入邮编！',0),
        array('postcode','/^[1-9][0-9]{5}$/','请输入正确的邮编！',1,'regex',1),

    );
}
?>