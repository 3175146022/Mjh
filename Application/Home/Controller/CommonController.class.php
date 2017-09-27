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

    }

    //收藏
    public function keep(){
        if(IS_POST){
            $data['user_id'] = $_SESSION['user_id'];
            $data['collect'] = $_SESSION['collect'];
            $data['cate'] = $_SESSION['cate'];
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
        }else{
            $att=[
                'state'=>201,
                'msg'=>'收藏失败'
            ];
        }
        return $att;
    }


}