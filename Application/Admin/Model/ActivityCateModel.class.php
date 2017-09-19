<?php
namespace Admin\Model;
use Think\Model;

class ActivityCateModel extends Model{
    //自动验证
    protected $_validate = array(
        array('act_cate_title','require','请输入活动标题！',0),
        array('img_detail','require','请输入封面详解！',0),
        array('act_cate_title','','活动已存在！',0,'unique',3), // 在新增的时候验证admin_name字段是否唯一
    );
    //添加分类
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
    //修改分类
    public function update_cate($post,$info){
        $id = $post['act_cate_id'];
        if($info['act_icon']){
            //获取原来的图片地址
            $pic = M('ActivityCate')->field('act_icon')->where(array('act_cate_id'=>$id))->find();
            //删除原来的图片
            unlink($pic['act_icon']);
            $img_path = 'Uploads/'.$info['act_icon']['savepath'].$info['act_icon']['savename'];
            $temp['act_icon'] = $img_path;
        }
        if($info['act_img']){
            //获取原来的图片地址
            $pic = M('ActivityCate')->field('act_img')->where(array('act_cate_id'=>$id))->find();
            //删除原来的图片
            unlink($pic['act_img']);
            $img_path1 = 'Uploads/'.$info['act_img']['savepath'].$info['act_img']['savename'];
            $temp['act_img'] = $img_path1;
        }
        $temp['act_cate_title'] = $post['act_cate_title'];
        $temp['img_detail'] = $post['img_detail'];
        $res = M('ActivityCate')->where(array('act_cate_id'=>$id))->save($temp);
        return $res;
    }
    //上传图片
    public function upload(){
        //添加图片
        $upload = new \Think\Upload();                              // 实例化上传类
        $upload->maxSize = 0;                                // 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = './Uploads/';                      // 设置附件上传根目录
        $upload->savePath = 'activity/';                       // 设置附件上传（子）目录
        // 上传文件
        $info = $upload->upload();
        return $info;
    }
}
?>