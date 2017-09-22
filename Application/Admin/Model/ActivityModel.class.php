<?php
namespace Admin\Model;
use Think\Model;

class ActivityModel extends Model{
    //自动验证
    protected $_validate = array(
        array('act_title','require','请输入活动标题！',0),
        array('start_time','require','请输入活动开始时间！',0),
        array('end_time','require','请输入活动结束时间！',0),
        array('act_detail','require','请输入详细描述！',0),
        array('act_content','require','请输入活动内容！',0),
    );
    //添加活动
    public function add_act($post,$info){
        $img_path = 'Uploads/'.$info['img']['savepath'].$info['img']['savename'];
        $data = array(
            'act_title' => $post['act_title'],
            'start_time' => strtotime($post['start_time']),
            'end_time' => strtotime($post['end_time']),
            'astrict' => $post['astrict'],
            'act_detail' => $post['act_detail'],
            'act_content' => $post['act_content'],
            'add_time' => NOW_TIME,
            'is_sold' => $post['is_sold'],
            'type' => $post['type'],
            'img' => $img_path,
            'act_cate_id' => $post['act_cate_id'],
        );
        $result = M('Activity')->add($data);
        return $result;
    }
    //修改活动
    public function update_act($post,$info){
        $id = $post['activity_id'];
        $temp = array(
            'act_title' => $post['act_title'],
            'start_time' => strtotime($post['start_time']),
            'end_time' => strtotime($post['end_time']),
            'astrict' => $post['astrict'],
            'act_detail' => $post['act_detail'],
            'act_content' => $post['act_content'],
            'is_sold' => $post['is_sold'],
            'type' => $post['type'],
            'act_cate_id' => $post['act_cate_id'],
        );
        if($info['img']) {
            //获取原来的图片地址
            $pic = M('Activity')->field('img')->where(array('activity_id' => $id))->find();
            //删除原来的图片
            unlink($pic['img']);
            $img_path = 'Uploads/' . $info['img']['savepath'] . $info['img']['savename'];
            $temp['img'] = $img_path;
        }
        $result = M('Activity')->where(array('activity_id'=>$id))->save($temp);
        return $result;

    }
}
?>