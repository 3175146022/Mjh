<?php
namespace Home\Controller;

use Think\Controller;

class MyinfoController extends CommonController{
    public function __construct(){
        parent::__construct();
    }

    public function index(){

        $this->display();//页面赋值
    }

    public function name()
    {
        $this->display();
    }

    public function QRcode()
    {
        $this->display();
    }

    public function position()
    {
        $this->display();
    }

    public function industry()
    {
        $this->display();
    }

    public function interest()
    {
        $this->display();
    }
}