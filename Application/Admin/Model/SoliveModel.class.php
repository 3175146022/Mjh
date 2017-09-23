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
    public function update_solive($post,$info){
        $id = $post['solive_id'];
        $data = array(
            'so_title' => $post['so_title'],
            'so_detail' => $post['so_detail'],
            'so_author' => $post['so_author'],
            'so_link' => $post['so_link'],
        );
        if($info['img']) {
            //获取原来的图片地址
            $pic = M('Solive')->field('img')->where(array('solive_id'=>$id))->find();
            //删除原来的图片
            unlink($pic['img']);
            $img_path = 'Uploads/' . $info['img']['savepath'] . $info['img']['savename'];
            $data['img'] = $img_path;
        }
        $result = M('Solive')->where(array('solive_id'=>$id))->save($data);
        return $result;
    }
}
?>