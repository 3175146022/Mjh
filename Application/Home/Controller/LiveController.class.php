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
        $this->assign('data',$data);
        $this->display();//页面赋值
    }
}