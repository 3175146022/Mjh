<?php
namespace Home\Controller;

use Think\Controller;

class CommonController extends Controller{

    public function __construct()
    {
        parent::__construct();
        if(empty($_SESSION['user_id'])){
            redirect(U('Login/index'));
        }
        $member = M('user')->where(array('user_id'=>$_SESSION['user_id']))->find();
        if(empty($member)){
            redirect(U('Login/index'));
        }
    }

    //收藏and取消收藏
    public function keep(){
        if(IS_POST){
            $state = M('collect')->where(array('user_id'=>$_SESSION['user_id'],'collect'=>$_POST['collect'],'cate'=>$_POST['cate']))->find();
            if($state){
                $delete =  M('collect')->where(array('collect_id'=>$state['collect_id']))->delete();
                if($delete){
                    $att=[
                        'state'=>202,
                        'msg'=>'取消成功'
                    ];
                }else{
                    $att=[
                        'state'=>201,
                        'msg'=>'取消失败'
                    ];
                }
            }else{
                $data['user_id'] = $_SESSION['user_id'];
                $data['collect'] = $_POST['collect'];
                $data['cate'] = $_POST['cate'];
                $upload = M('collect')->add($data);
                if($upload){
                    $att=[
                        'state'=>200,
                        'msg'=>'收藏成功'
                    ];
                }else{
                    $att=[
                        'state'=>201,
                        'msg'=>'收藏失败'
                    ];
                }
            }
        }else{
            $att=[
                'state'=>201,
                'msg'=>'收藏失败'
            ];
        }
        $this->ajaxReturn($att);
    }


}