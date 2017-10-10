<?php
namespace Home\Controller;

use Think\Controller;

class CollectionController extends CommonController{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $list = M('Collect')->where(array('user_id'=>$_SESSION['user_id']))->select();
        $user = M('User')->where(array('user_id'=>$_SESSION['user_id']))->field('avatar,user_name')->find();
        foreach ($list as $k=>$v){
            if($v['cate'] == 1){
                $activity[] = M('Activity as a')
                            ->join('collect as c ON c.collect = a.activity_id')
                            ->where(array('activity_id'=>$v['collect']))
                            ->find();
            }elseif ($v['cate'] == 2){
                $solive[] = M('Solive as s')
                            ->join('collect as c ON c.collect = s.solive_id')
                            ->where(array('solive_id'=>$v['collect']))
                            ->find();
            }elseif ($v['cate'] == 3){
                $news[] = M('News as n')
                            ->join('collect as c ON c.collect = n.news_id')
                            ->where(array('news_id'=>$v['collect']))
                            ->find();
            }elseif ($v['cate'] == 4){
                $genera[] = M('Genera as g')
                            ->join('collect as c ON c.collect = g.id')
                            ->where(array('id'=>$v['collect']))
                            ->find();
            }
        }
        $data = M('Genera')->order('add_time desc')->limit(1)->find();
        $keep = M('collect')->where(array('collect'=>$data['id'],'cate'=>4,'user_id'=>$_SESSION['user_id']))->find();

        $this->assign('keep',$keep);
        $this->assign('activity',$activity);
        $this->assign('live',$solive);
        $this->assign('news',$news);
        $this->assign('genera',$genera);
        $this->assign('user',$user);
        $this->display();//页面赋值
    }
}