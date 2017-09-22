<?php
namespace Home\Controller;

use Think\Controller;

class NoticeController extends Controller{
    public function index(){

        $this->display();//页面赋值
    }

    public function show()
    {
        $this->display();
    }
}