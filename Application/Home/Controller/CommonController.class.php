<?php
namespace Home\Controller;

use Think\Controller;

class CommonController extends Controller{

    public function __construct()
    {
        parent::__construct();
//        if(empty($_SESSION['open_id'])){
//            $this->success(U('Login/index'));
//        }
    }

    //获取access_token
    public function access(){
        $open_id = C('WX_OPENID');
        $secret = C('WX_SECRET');
        $token = file_get_contents(sprintf('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s',$open_id,$secret));
        $access =json_decode($token);
    }
}