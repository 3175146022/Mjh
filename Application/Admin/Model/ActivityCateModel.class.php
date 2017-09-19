<?php
namespace Admin\Model;
use Think\Model;

class ActivityCateModel extends Model{
    //自动验证
    protected $_validate = array(
        array('act_cate_title','require','请输入活动标题！',0),
        array('img_detail','require','请输入封面详解！',0),
    );

    public function add_cate($post,$info){
        $img_path = 'Uploads/'.$info['act_icon']['savepath'].$info['act_icon']['savename'];
        $img_path_a = 'Uploads/'.$info['act_img']['savepath'].$info['act_img']['savename'];
        //添加数据
        $data = array(
            'act_cate_title' => $post['act_cate_title'],
            'img_detail' => $post['img_detail'],
            'act_icon' => $img_path,
            'act_img' => $img_path_a,
        );
        $res = M('ActivityCate')->add($data);
        return $res;
    }
}
?>