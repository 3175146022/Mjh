<?php
namespace Home\Controller;

use Think\Controller;
class IndexController extends CommonController{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){

        $this->display();//页面赋值
    }
}