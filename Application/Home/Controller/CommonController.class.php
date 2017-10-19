<?php
namespace Home\Controller;

use Think\Controller;

class CommonController extends Controller{

    public function __construct()
    {
        parent::__construct();
        $member = M('user')->where(array('user_id'=>$_SESSION['user_id']))->find();
        if(empty($_SESSION['user_id']) || empty($member)){
            $rurl = $_SERVER['REQUEST_URI'];
            $rul = base64_encode($rurl);
            redirect(U('Login/index',array('id'=>$rul)));
        }

        header('Content-Type: text/html; charset=utf-8');
        $access=$this->access();
        $user = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access.'&openid='.$member['open_id'].'&lang=zh_CN';
        $memberss=$this->http($user);
        $datas =json_decode($memberss[1]);
        if($datas->subscribe ==null){
              redirect(U('Test/index'));
            //redirect('http://mp.weixin.qq.com/s?__biz=MzUzODE2OTQ0MA==&tempkey=OTI2X1o3K3AxU0o5OHdVTmJZQndrOGtrbGYzWEZURzJSUkNDczBmNDFMZmtFRndjOWRJY0x6Y09ha1VBYmRfcGlud25zbHk4N0pOX1VVRU5XdlZBWGlPeEVsdmxuXzNmZjZ1Q2ZvMjdNc1Q3bGJWWExScG1qZ0FyUkp3ZUoxT0FEbGtNSXduejFZekJRWkJuWnF2czA3X05lSEdhNGRHRnlaQjdKbS1XS3d%2Bfg%3D%3D&chksm=7ada98384dad112e91a7b0c54b32b109363daf882d68a4c3fbb81852a745ee5ace83a0a7af3f&scene=0&previewkey=04QDpm1ium9XmT%252Fx0Eu0fsNS9bJajjJKzz%252F0By7ITJA%253D#wechat_redirect');
//            header("Location:https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzUzODE2OTQ0MA==&scene=124#wechat_redirect");

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


    public function http($url,$headers = array()){
        $ci = curl_init();
        /* Curl settings */
        curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ci, CURLOPT_TIMEOUT, 30);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ci, CURLOPT_URL, $url);
        curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ci, CURLINFO_HEADER_OUT, true);

        $response = curl_exec($ci);
        $http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);

        curl_close($ci);
        return array($http_code, $response);
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