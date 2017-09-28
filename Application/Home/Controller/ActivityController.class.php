<?php
namespace Home\Controller;

use Think\Controller;

class ActivityController extends CommonController{
    public function __construct(){
        parent::__construct();
    }
    //江湖活动列表
    public function index(){
        $list = M('Activity')->join('activity_cate on activity_cate.act_cate_id = activity.act_cate_id')->select();
        $this->assign('list',$list);
        $this->display();//页面赋值
    }
    //江湖活动更多
    public function more(){
        $id = I('get.id');
        $more = M('Activity')->where(array('act_cate_id'=>$id))->select();
        $this->assign('more',$more);
        $this->display();//页面赋值
    }
    //江湖活动详情
    public function show(){
        $id = I('get.id');
        $data = M('Activity')->where(array('activity_id'=>$id))->find();
        $keep = M('collect')->where(array('collect'=>$data['activity_id'],'cate'=>1,'user_id'=>$_SESSION['user_id']))->find();
        $this->assign('keep',$keep);
        $this->assign('data',$data);
        $this->display();//页面赋值
    }
}