<?php
namespace Admin\Model;
use Think\Model;

class NewsModel extends Model{
    protected $_validate = array(
        array('title','require','请输入新闻标题！',0),
        array('introduction','require','请输入简介！',0),
        array('cate_id','require','请输入封面详解！',0),
        array('content','require','请输入内容！',0),
    );
}
?>