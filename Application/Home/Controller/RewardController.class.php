<?php
namespace Home\Controller;

use Think\Controller;

class RewardController extends Controller{
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
        $this->display();
    }
}