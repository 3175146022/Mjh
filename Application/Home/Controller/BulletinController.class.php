<?php
namespace Home\Controller;

use Think\Controller;

class BulletinController extends CommonController{
    public function __construct(){
        parent::__construct();
    }
    //告示框架
    public function bulletin(){
        $this->display();
    }
    //江湖告示列表
    public function index(){
        $list = M('news')->where(array('cate_name'=>'江湖告示'))->join('news_cate on news_cate.cate_id = news.cate_id')->select();
        $this->assign('list',$list);
        $this->display();//页面赋值
    }
    //江湖告示详情
    public function show(){
        $id = I('get.id');
        $data = M('news')->where(array('news_id'=>$id))->field('title,content')->find();
        $this->assign('data',$data);
        $this->display();
    }
}