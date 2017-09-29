<?php
namespace Home\Controller;

use Think\Controller;

class LoginController extends Controller{

    //微信登录
    public function index(){
        $member = M('user')->where(array('user_id'=>$_SESSION['user_id']))->find();
        if(empty($_SESSION['user_id']) || empty($member)){
            $redirect_uri ='http://wap.manjianghu.com/index.php/Home/Login/nofity';
            $url ='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.C('WX_OPENID').'&redirect_uri='.$redirect_uri.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect1';
            redirect($url);
        }else{
            redirect(U('Index/index'));
        }

    }

    public function nofity($code){
        $url ='https://api.weixin.qq.com/sns/oauth2/access_token?appid='.C('WX_OPENID').'&secret='.C('WX_SECRET').'&code='.$code.'&grant_type=authorization_code';
        $info_data = $this->http($url);
        if($info_data[0]==200){
            $access_token =json_decode($info_data[1]);
            $member ='https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token->access_token.'&openid='.C('WX_OPENID').'&lang=zh_CN';
            $member_data=$this->http($member);
            if($member_data[0] ==200){
                header('Content-Type: text/html; charset=utf-8');
                $data =json_decode($member_data[1]);
                $state =M('user')->where(array('open_id'=>$data->openid))->find();
                if($state){
                    $_SESSION['user_id'] = $state['user_id'];
                    redirect(U('Index/index'));
                }else{
                    $arr['open_id'] = $data->openid;
                    $arr['avatar'] = $data->headimgurl;
                    $arr['user_name'] = base64_encode($data->nickname);
                    $arr['sex'] = $data->sex;
                    $id =M('user')->add($arr);

                    Vendor('phpqrcode.class#phpqrcode');
                    $url = "http://wap.manjianghu.com/index.php/home/codeinfo/index/user_id/".$id.".html";
                    $errorCorrectionLevel =intval('L') ;//容错级别
                    $matrixPointSize = intval(6);//生成图片大小
                    //生成二维码图片
                    $path = "Uploads/QRcode/";
                    if(!file_exists($path))
                    {
                        mkdir($path, 0777);
                    }
                    // 生成的文件名
                    $fileName = $path.$arr['open_id'].'.png';

                    ob_end_clean();//清空缓冲区

                    \QRcode::png($url, $fileName, $errorCorrectionLevel, $matrixPointSize, 2);
                    $code_path['code'] = "http://wap.manjianghu.com/".$fileName;

                    M('user')->where('user_id = '.$id)->save($code_path);
                    $_SESSION['user_id'] = $id;
                    redirect(U('Index/index'));
                }
            }else{
                echo '获取用户信息失败失败！';die;
            }
        }else{
            echo '获取access_token失败！';die;
        }
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

}