<?php
namespace Home\Controller;

use Think\Controller;

class RewardController extends CommonController{
    public function __construct(){
        parent::__construct();
    }

    //悬赏列表
    public function index(){

        $this->display();//页面赋值
    }
    //悬赏详情
    public function show(){
        $this->display();
    }
    //发布悬赏
    public function issue(){
        if(IS_POST){
            if(empty($_POST['re_title'])){
                echo "<script>alert('请输入悬赏标题!');window.location.href = window.location.href;</script>";
            }
            if(empty($_POST['re_content'])){
                echo "<script>alert('请输入悬赏内容!');window.location.href = window.location.href;</script>";
            }
            if(empty($_POST['end_time'])){
                echo "<script>alert('请输入结束时间!');window.location.href = window.location.href;</script>";
            }
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
            $upload->savePath  =     'reward/'; // 设置附件上传（子）目录
            // 上传文件
            $info   =   $upload->upload();
            if(!$info['re_image']){
                echo "<script>alert('请上传图片!');window.location.href = window.location.href;</script>";
            }else{
                $user = M('User')->where(array('user_id'=>$_SESSION['user_id']))->field('user_name')->find();
                var_dump($user);exit;
                $res = D('Reward')->add_reward($_POST,$info,$user);
                if($res){
                    $this->redirect('Reward/index');
                }else{
                    echo "<script>alert('提交失败!');window.location.href = window.location.href;</script>";
                }
            }
        }else{
            $this->display();
        }
    }
}