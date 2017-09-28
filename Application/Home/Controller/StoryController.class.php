<?php
namespace Home\Controller;

use Think\Controller;

class StoryController extends CommonController{
    public function __construct(){
        parent::__construct();
    }

    //江湖故事列表
    public function index(){
        $list = M('news')->where(array('cate_name'=>'江湖故事'))->join('news_cate on news_cate.cate_id = news.cate_id')->select();
        $this->assign('list',$list);
        $this->display();//页面赋值
    }
    //江湖故事详情
    public function show(){
        $id = I('get.id');
        $data = M('News')->where(array('news_id'=>$id))->field('title,content,news_id')->find();
        $keep = M('collect')->where(array('collect'=>$data['news_id'],'cate'=>3,'user_id'=>$_SESSION['user_id']))->find();
        $this->assign('keep',$keep);
        $this->assign('data',$data);
        $this->display();
    }
}