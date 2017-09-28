<?php
namespace Home\Controller;

use Think\Controller;

class CollectionController extends CommonController{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $list = M('Collect')->select();
        foreach ($list as $k=>$v){
            switch ($v['cate']){
                case 1:
                    foreach ($list as $key=>$val){
                        $activity = M('Activity')->where(array('activity_id'=>$val['collect']))->select();
                    };
                case 2:
                    foreach($list as $key1=>$val){
                        $solive = M('Solive')->where(array('solive_id'=>$val['collect']))->select();
                    };
                case 3:
                    foreach ($list as $key=>$val){
                        $story = M('News')->where(array('news_id'=>$val['collect']))->select();
                    };
                case 4:
                    foreach ($list as $key=>$val){
                        $genera = M('Genera')->where(array('id'=>$val['collect']))->select();
                    };
            }
        }
        $this->assign('activity',$activity);
        $this->assign('live',$solive);
        $this->assign('story',$story);
        $this->assign('genera',$genera);
        $this->display();//页面赋值
    }
}