<?php
namespace Home\Controller;

use Think\Controller;

class RewardController extends CommonController{
    public function __construct(){
        parent::__construct();
    }
    //搜索
    public function search(){

    }
    //接受悬赏
    public function undertake(){
        var_dump($_POST);
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
        $list1 = M('Reward')->where(array('re_status'=>1))->order('add_time desc')->select();
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
        $user = M('User')->where(array('user_id'=>$_SESSION['user_id']))->field('user_name')->find();
        $this->assign('user',$user);
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
        $user = M('User')->where(array('user_id'=>$_SESSION['user_id']))->field('token_id')->find();
        if(empty($user['token_id'])){
           echo "<script>alert('您还未拥有江湖令！');window.history.go(-1);</script>";
        }else {
            if (IS_POST) {
                if (empty($_POST['re_title'])) {
                    echo "<script>alert('请输入悬赏标题!');window.location.href = window.location.href;</script>";
                }
                if (empty($_POST['re_content'])) {
                    echo "<script>alert('请输入悬赏内容!');window.location.href = window.location.href;</script>";
                }
                if (empty($_POST['end_time'])) {
                    echo "<script>alert('请输入结束时间!');window.location.href = window.location.href;</script>";
                }
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize = 3145728;// 设置附件上传大小
                $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath = './Uploads/'; // 设置附件上传根目录
                $upload->savePath = 'reward/'; // 设置附件上传（子）目录
                // 上传文件
                $info = $upload->upload();
                if (!$info['re_image']) {
                    echo "<script>alert('请上传图片!');window.location.href = window.location.href;</script>";
                } else {
                    $user = M('User')->where(array('user_id' => $_SESSION['user_id']))->field('user_name')->find();
                    $res = D('Reward')->add_reward($_POST, $info, $user);
                    if ($res) {
                        $this->redirect('Reward/index');
                    } else {
                        echo "<script>alert('提交失败!');window.location.href = window.location.href;</script>";
                    }
                }
            } else {
                $this->display();
            }
        }

    }
}