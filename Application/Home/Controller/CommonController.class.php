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
                $data['time'] = NOW_TIME;
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


    //随机字符串
    public function random(){
        $random='';
        $arr =['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b',
            'c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9'];
        for($a=1;$a<=16;$a++){
            $num=rand(1,count($arr)-1);
            $random.=$arr[$num];
        }
        return $random;
    }


    //获得access_token
    public function access(){
        $config = M('config')->where(array('id'=>1))->find();
        if($config['token_time']<time() || empty($config['access_token'])){
            $token = file_get_contents(sprintf('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s',C('WX_OPENID'),C('WX_SECRET')));
            $access =json_decode($token);
            $arr['access_token']=$access->access_token;
            $arr['token_time']=time()+7000;
            M('config')->where(array('id'=>1))->save($arr);
            $number=$arr['access_token'];
        }else{
            $number=$config['access_token'];
        }
        return $number;

    }



    //获取jsapi_ticket
    public function jsapis(){
        $config = M('config')->where(array('id'=>1))->find();
        if($config['jsapi_time']<time() || empty($config['jsapi_ticket'])){
            $access_token = $this->access();
            $jsapi =file_get_contents(sprintf('https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$access_token.'&type=jsapi'));
            $access =json_decode($jsapi);
            $arr['jsapi_ticket'] = $access->ticket;
            $arr['jsapi_time']=time()+7000;
            M('config')->where(array('id'=>1))->save($arr);
            $number=$arr['jsapi_ticket'];
        }else{
            $number=$config['jsapi_ticket'];
        }
        return $number;

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