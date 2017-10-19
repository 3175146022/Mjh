<?php

namespace Home\Controller;

use Think\Controller;
header('Content-Type:text/html; charset= utf-8');
class RewardController extends CommonController{

    public function __construct(){
        parent::__construct();
    }
    //悬赏框架
    public function reward(){
        $this->display();
    }
    //发布悬赏
    public function issue2(){
        if(IS_POST){
            //防止重复提交 如果重复提交跳转至相关页面
            if (!checkToken($_POST['TOKEN'])) {
                echo "<script>alert('请勿重复提交!');window.location.href = window.location.href;</script>";
            }else{
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize = 0;// 设置附件上传大小
                $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath = './Uploads/'; // 设置附件上传根目录
                $upload->savePath = 'reward/'; // 设置附件上传（子）目录
                // 上传文件
                $info = $upload->upload();
                if (!$info['re_image']) {
                    echo "<script>alert('请上传封面图!');window.location.href = window.location.href;</script>";
                } else {
                    $post = array(
                        're_title' => $_SESSION['post']['re_title'],
                        're_content' => $_SESSION['post']['re_content'],
                        'end_time' => $_SESSION['post']['end_time']
                    );
                    $user = M('User')->where(array('user_id' => $_SESSION['user_id']))->field('user_name')->find();
                    $res = D('Reward')->add_reward($post, $info, $user);
                    if($res){
                        echo "<script>alert('提交成功!');window.location = 'http://wap.manjianghu.com/Home/Reward/index.html';</script>";
                    }else{
                        echo "<script>alert('提交失败!');window.location.href = window.location.href;</script>";
                    }
                }
            }

        }else{
            creatToken();
            $this->display();
        }

    }
    //悬赏列表
    public function index(){
        if($_POST){
            $where['re_status'] =1;
            $where['re_title'] =array('like','%'.$_POST['select_name'].'%');
            $select = M('Reward')->where($where)->order('add_time desc')->select();
            $this->assign('list',$select);
        }else{
            $list = M('Reward')->order('add_time desc')->select();
            $this->assign('list',$list);
        }
        $s = array(1,3);
        $where = array(
            're_status' => array("in",$s),
        );
        $list1 = M('Reward')->where($where)->order('add_time desc')->select();
        foreach ($list1 as $k=>$v){
            if($v['end_time'] <= time()){
                $a = array(
                        're_status' => '2',
                );
                M('Reward')->where(array('reward_id'=>$v['reward_id']))->save($a);
            }
        }
        foreach ($list1 as $k=>$v){
            $array[$k] = $v['end_time'];
        }
        $str = json_encode($array);
        $this->assign('str',$str);
        $this->display();//页面赋值
    }
    //悬赏详情
    public function show(){
        $id = I('get.id');
        $data = M('Reward')->where(array('reward_id'=>$id))->find();
        $author = M('User')->where(array('user_name'=>$data['author']))->field('user_wx,phone_num')->find();
        $picture = M('RePicture')->where(array('reward_id'=>$id))->select();
        $user = M('User')->where(array('user_id'=>$_SESSION['user_id']))->field('user_name')->find();
        $this->assign('author',$author);
        $this->assign('user',$user);
        $this->assign('picture',$picture);
        $this->assign('data',$data);
        $this->display();
    }
    //揭榜
    public function jiebang(){
        $id = $_GET['id'];
        $reward = M('Reward')->where(array('reward_id'=>$id))->find();
        $user = M('User')->where(array('user_id'=>$_SESSION['user_id']))->find();
        $post = array(
            're_status' => '3',
            'undertake' => $user['user_name'],
            'take_time' => NOW_TIME,
        );
        $res = M('Reward')->where(array('reward_id'=>$id))->save($post);
        if($res){
            $str = '3';
            echo json_encode($str);
        }
    }
    //发布悬赏
    public function issue(){
        $user = M('User')->where(array('user_id'=>$_SESSION['user_id']))->field('token_id,user_wx,phone_num')->find();
        if(empty($user['token_id'])){
            echo "<script>alert('您还未拥有江湖令！');window.history.go(-1);</script>";
        }elseif(empty($user['user_wx']) && empty($user['phone_num'])){
            echo "<script>alert('请先填写微信号或手机号！');window.history.go(-1);</script>";
        }else {
            if (IS_POST) {
                if (empty($_POST['re_title'])) {
                    echo "<script>alert('请输入悬赏标题!');window.location.href = window.location.href;</script>";
                }elseif (empty($_POST['end_time'])){
                    echo "<script>alert('请输入结束时间!');window.location.href = window.location.href;</script>";
                }elseif (empty($_POST['re_content'])){
                    echo "<script>alert('请输入悬赏内容!');window.location.href = window.location.href;</script>";
                }else{
                    $_SESSION['post'] = $_POST;
                    if(!empty($_SESSION['post'])){
                        $this->redirect('Reward/issue2');
                    }
                }
            } else {
                $this->display();
            }
        }

    }
}