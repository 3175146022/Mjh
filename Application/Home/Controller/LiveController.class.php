<?php
namespace Home\Controller;

use Think\Controller;

class LiveController extends CommonController{
    public function __construct(){
        parent::__construct();
    }
    //江湖直播列表
    public function index(){
        $list = M('Solive')->select();
        $this->assign('list',$list);
        $this->display();//页面赋值
    }
    //江湖直播详情
    public function show(){
        $id = I('get.id');
        $data = M('Solive')->where(array('solive_id'=>$id))->find();
        $keep = M('collect')->where(array('collect'=>$data['solive_id'],'cate'=>2,'user_id'=>$_SESSION['user_id']))->find();
        $this->assign('keep',$keep);
        $this->assign('data',$data);
        $this->display();//页面赋值
    }
}