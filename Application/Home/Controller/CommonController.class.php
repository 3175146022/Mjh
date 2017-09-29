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

//    /**
//     * 打印数据，用于调试
//     * @param var 打印对象
//     */
//    function p($var){
//        echo "<pre>";
//        var_dump($var);
//        echo "</pre>";
//    }
//
//
//
//    function createQRcode($url,$flag=0){
//        vendor("phpqrcode.phpqrcode");
//        // 纠错级别：L、M、Q、H
//        $level = 'L';
//        // 点的大小：1到10,用于手机端4就可以了
//        $size = 4;
//        // 下面注释了把二维码图片保存到本地的代码,如果要保存图片,用$fileName替换第二个参数false
//        if($flag){
//            $path = "Public/QRcode/";
//            if(!file_exists($path)){
//                mkdir($path, 0700);
//            }
//            // 生成的文件名
//            $fileName = $path.time().'.png';
//            QRcode::png($url, $fileName, $level, $size);
//            return $fileName;
//        }else{
//            QRcode::png($url, $false, $level, $size);
//            exit;
//        }
//
//    }
}