<?php
namespace Admin\Controller;
use Think\Controller;

class ActivityController extends Controller{
    //活动列表页
    public function index(){
        $this->display();
    }
    //添加活动
    public function add_activity(){
        $this->display();
    }
    //添加活动
    public function update_activity(){
        $this->display();
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
                //添加图片
                $upload = new \Think\Upload();                              // 实例化上传类
                $upload->maxSize = 0;                                // 设置附件上传大小
                $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath = './Uploads/';                      // 设置附件上传根目录
                $upload->savePath = 'activity/';                       // 设置附件上传（子）目录
                // 上传文件
                $info = $upload->upload();
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
        $this->display();
    }
}
?>