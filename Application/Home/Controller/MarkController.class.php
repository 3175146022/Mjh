<?php
namespace Home\Controller;
use Think\Controller;

class MarkController extends CommonController{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $data = M('Genera')->order('add_time desc')->limit(1)->find();
        $this->assign('data',$data);
        $this->display();
    }
}
?>