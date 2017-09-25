<?php
namespace Home\Controller;

use Think\Controller;

class MarketController extends Controller{
    //江湖直播列表
    public function index(){
        $list = M('news')->where(array('cate_name'=>'江湖推介'))->join('news_cate on news_cate.cate_id = news.cate_id')->select();
        $this->assign('list',$list);
        $this->display();//页面赋值
    }
    //江湖直播详情
    public function show(){
        $id = I('get.id');
        $data = M('News')->where(array('news_id'=>$id))->field('title,content')->find();
        $this->assign('data',$data);
        $this->display();//页面赋值
    }
}