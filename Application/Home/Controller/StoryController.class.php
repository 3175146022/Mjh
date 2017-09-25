<?php
namespace Home\Controller;

use Think\Controller;

class StoryController extends Controller{
    //江湖故事列表
    public function index(){
        $list = M('news')->where(array('cate_name'=>'江湖故事'))->join('news_cate on news_cate.cate_id = news.cate_id')->select();
        $this->assign('list',$list);
        $this->display();//页面赋值
    }
    //江湖故事详情
    public function show(){
        $id = I('get.id');
        $data = M('News')->where(array('news_id'=>$id))->field('title,content')->find();
        $this->assign('data',$data);
        $this->display();
    }
}