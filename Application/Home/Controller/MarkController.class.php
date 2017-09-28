<?php
namespace Home\Controller;
use Think\Controller;

class MarkController extends CommonController{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $data = M('Genera')->order('add_time desc')->limit(1)->find();
        $keep = M('collect')->where(array('collect'=>$data['id'],'cate'=>4,'user_id'=>$_SESSION['user_id']))->find();
        $this->assign('keep',$keep);
        $this->assign('data',$data);
        $this->display();
    }
}
?>