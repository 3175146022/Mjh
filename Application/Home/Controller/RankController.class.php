<?php

namespace Home\Controller;

use Think\Controller;

class RankController extends CommonController{
    public function __construct(){
        parent::__construct();
    }
    //排行框架
    public function rank(){
        $this->display();
    }
    //排行
    public function index(){
        $mc = 1;
        $user = M('User as u')
            ->join('token as t ON t.token_id = u.token_id')
            ->order('reputation desc')
            ->select();
        foreach ($user as $k=>$v){
            $user[$k]['place'] = $mc;
            $mc ++;
        }
        $my = M('User')->where(array('user_id'=>$_SESSION['user_id']))->find();
        $this->assign('my',$my);
        $this->assign('user',$user);
        $this->display();//页面赋值
    }
    //搜索
    public function search(){
        $mc = 1;
        $area = $_POST['area'];
        $p = explode(' ',$area);
        foreach ($p as $k=>$v){
            $data[] = $v;
        }
        if($data[1] == "全部"){
            $post = $data[0];
            $where['address']  = array('like', "%$post%");
            $search = M('User')->where($where)->order('reputation desc')->select();
            foreach ($search as $k=>$v){
                $search[$k]['place'] = $mc;
                $mc ++;
            }
        }elseif ($data[2] == "全部"){
            $post1 = $data[0].' '.$data[1];
            $where['address']  = array('like', "%$post1%");
            $search = M('User')->where($where)->order('reputation desc')->select();
            foreach ($search as $k=>$v){
                $search[$k]['place'] = $mc;
                $mc ++;
            }
        }else{
            $search = M('User')->where(array('address'=>$area))->order('reputation desc')->select();
            foreach ($search as $k=>$v){
                $search[$k]['place'] = $mc;
                $mc ++;
            }
        }
        $this->assign('search',$search);
        $this->display('Rank/index');//页面赋值
    }
}