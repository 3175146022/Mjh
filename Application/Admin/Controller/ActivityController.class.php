<?php
/*
 * 王建
 * */
namespace Admin\Controller;
use Think\Controller;

class ActivityController extends CommonController{
    //公共方法
    public function _initialize(){
        $this->check_login();//检查登录
    }
    //活动列表页
    public function index(){
        $data = M('Activity')->select();
        $this->assign('data',$data);
        $this->display();
    }
    //添加活动
    public function add_activity(){
        //关闭表单令牌
        C('TOKEN_ON',false);
        if(IS_POST){
            $verify = D('Activity');
            if(!$verify->create()){
                $this->error($verify->getError());
            }else {
                $info = $this->upload();
                if(!$info['img']){
                    echo "<script>alert('请添加图片');window.history.go(-1);</script>";
                }else{
                    $res = D('Activity')->add_act($_POST,$info);
                    if($res){
                        $this->success('添加成功！',U('Activity/add_activity'));
                    }else{
                        echo "<script>alert('添加失败！');window.history.go(-1)</script>";
                    }
                }
            }
        }else{
            $act_cate = M('ActivityCate')->field('act_cate_id,act_cate_title')->select();
            $this->assign('cate',$act_cate);
            $this->display();
        }
    }
    //修改活动
    public function update_activity(){
        //关闭表单令牌
        C('TOKEN_ON',false);
        if(IS_POST){
            $verify = D('Activity');
            if(!$verify->create()){
                $this->error($verify->getError());
            }else {
                $info = $this->upload();
                $res = D('Activity')->update_act($_POST,$info);
                if($res){
                    $this->success('修改成功！',U('Activity/index'));
                }else{
                    echo "<script>alert('修改失败！');window.history.go(-1)</script>";
                }
            }
        }else{
            $id = I('get.id');
            $data = M('Activity')->where(array('activity_id'=>$id))->find();
            $act_cate = M('ActivityCate')->field('act_cate_id,act_cate_title')->select();
            $this->assign('cate',$act_cate);
            $this->assign('data',$data);
            $this->display();
        }
    }
    //删除活动
    public function delete_act(){
        $id = I('get.id');
        $pic = M('Activity')->field('img')->where(array('activity_id'=>$id))->find();
        unlink($pic['img']);
        $result = M('Activity')->where(array('activity_id'=>$id))->delete();
        if ($result){
            $data = [
                'status' => 1,
                'msg'    => '删除成功'
            ];
            echo json_encode($data);
        }else{
            $data = [
                'status' => 0,
                'msg'    => '删除失败，请稍后重试！'
            ];
            echo json_encode($data);
        }
    }
    //活动分类
    public function cate(){
        $data = M('ActivityCate')->select();
        $this->assign('data',$data);
        $this->display();
    }
    //添加活动分类
    public function add_cate(){
        //关闭表单令牌
        C('TOKEN_ON',false);
        $post = array(
            'act_cate_title' => I('post.act_cate_title'),
            'img_detail' => I('post.img_detail'),
        );
        if(IS_POST){
            $verify = D('ActivityCate');
            if(!$verify->create()){
                $this->error($verify->getError());
            }else {
                $info = $this->upload();
                if(!$info['act_icon'] || !$info['act_img']){
                    echo "<script>alert('请添加图片！');window.history.go(-1)</script>";
                }else{
                    $res = D('ActivityCate')->add_cate($post,$info);
                    if ($res) {
                        $this->success('添加成功', U('Activity/cate'));
                    } else {
                        echo "<script>alert('添加失败！');window.history.go(-1)</script>";
                    }
                }
            }
        }else{
            $this->display();
        }
    }
    //修改分类
    public function update_cate(){
        //关闭表单令牌
        C('TOKEN_ON',false);
        $post = array(
            'act_cate_id' => I('post.act_cate_id'),
            'act_cate_title' => I('post.act_cate_title'),
            'img_detail' => I('post.img_detail'),
        );
        if(IS_POST){
            $verify = D('ActivityCate');
            if(!$verify->create()){
                $this->error($verify->getError());
            }else {
                $info = $this->upload();
                $res = D('ActivityCate')->update_cate($post,$info);
                if ($res) {
                    $this->success('修改成功', U('Activity/cate'));
                } else {
                    echo "<script>alert('修改失败！');window.history.go(-1)</script>";
                }
            }
        } else{
            $id = I('get.id');
            $data = M('ActivityCate')->where(array('act_cate_id'=>$id))->find();
            $this->assign('data',$data);
            $this->display();
        }
    }
    //删除数据
    public function delete_cate(){
        $id = I('get.id');
        //删除图片
        $pic = M('ActivityCate')->field('act_icon,act_img')->where(array('act_cate_id'=>$id))->find();
        unlink($pic['act_icon']);
        unlink($pic['act_img']);
        $result = M('ActivityCate')->where(array('act_cate_id'=>$id))->delete();
        if ($result){
            $data = [
                'status' => 1,
                'msg'    => '删除成功'
            ];
            echo json_encode($data);
        }else{
            $data = [
                'status' => 0,
                'msg'    => '删除失败，请稍后重试！'
            ];
            echo json_encode($data);
        }
    }
}
?>