<?php
namespace Home\Controller;

use Think\Controller;

class LoginController extends Controller{

    //微信登录
    public function index(){
        $id = $_GET['id'];
        $rurl = base64_decode($id);
//        var_dump($_GET['user_id']);exit;
        if(isset($_GET['user_id'])){
            $_SESSION['friends_user'] = $_GET['user_id'];
        }
            $member = M('user')->where(array('user_id'=>$_SESSION['user_id']))->find();
            if(empty($_SESSION['user_id']) || empty($member)){

                $redirect_uri ='http://wap.manjianghu.com/index.php/Home/Login/nofity/id/'.$id;
                $url ='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.C('WX_OPENID').'&redirect_uri='.$redirect_uri.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect1';
                redirect($url);
            }else{
                header('Content-Type: text/html; charset=utf-8');
                $access=$this->access();
                $user = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access.'&openid='.$member['open_id'].'&lang=zh_CN';
                $memberss=$this->http($user);
                $datas =json_decode($memberss[1]);
                if($datas->subscribe ==null){
                        redirect(U('Test/index'));
                    //redirect('http://mp.weixin.qq.com/s?__biz=MzUzODE2OTQ0MA==&tempkey=OTI2X1o3K3AxU0o5OHdVTmJZQndrOGtrbGYzWEZURzJSUkNDczBmNDFMZmtFRndjOWRJY0x6Y09ha1VBYmRfcGlud25zbHk4N0pOX1VVRU5XdlZBWGlPeEVsdmxuXzNmZjZ1Q2ZvMjdNc1Q3bGJWWExScG1qZ0FyUkp3ZUoxT0FEbGtNSXduejFZekJRWkJuWnF2czA3X05lSEdhNGRHRnlaQjdKbS1XS3d%2Bfg%3D%3D&chksm=7ada98384dad112e91a7b0c54b32b109363daf882d68a4c3fbb81852a745ee5ace83a0a7af3f&scene=0&previewkey=04QDpm1ium9XmT%252Fx0Eu0fsNS9bJajjJKzz%252F0By7ITJA%253D#wechat_redirect');//124
                    //header("Location:https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzUzODE2OTQ0MA==&scene=124#wechat_redirect");
                }
                $user = M('User')->where(array('user_id'=>$_SESSION['user_id']))->field('pid')->find();
                if(isset($_GET['user_id']) && $user['pid'] == null){
                    $this->friend();
                }
                redirect("http://wap.manjianghu.com".$rurl);
            }

    }

    public function nofity($code){
        $id = $_GET['id'];
        $url ='https://api.weixin.qq.com/sns/oauth2/access_token?appid='.C('WX_OPENID').'&secret='.C('WX_SECRET').'&code='.$code.'&grant_type=authorization_code';
        $info_data = $this->http($url);
        if($info_data[0]==200){
            $access_token =json_decode($info_data[1]);
            $member ='https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token->access_token.'&openid='.C('WX_OPENID').'&lang=zh_CN';
            $member_data=$this->http($member);
            if($member_data[0] ==200){
                header('Content-Type: text/html; charset=utf-8');
                $data =json_decode($member_data[1]);
                $access=$this->access();
                $user = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access.'&openid='.$data->openid.'&lang=zh_CN';
                $memberss=$this->http($user);
                $datas =json_decode($memberss[1]);
                if($datas->subscribe ==null){
                    redirect(U('Test/index'));
                    //redirect('http://mp.weixin.qq.com/s?__biz=MzUzODE2OTQ0MA==&tempkey=OTI2X1o3K3AxU0o5OHdVTmJZQndrOGtrbGYzWEZURzJSUkNDczBmNDFMZmtFRndjOWRJY0x6Y09ha1VBYmRfcGlud25zbHk4N0pOX1VVRU5XdlZBWGlPeEVsdmxuXzNmZjZ1Q2ZvMjdNc1Q3bGJWWExScG1qZ0FyUkp3ZUoxT0FEbGtNSXduejFZekJRWkJuWnF2czA3X05lSEdhNGRHRnlaQjdKbS1XS3d%2Bfg%3D%3D&chksm=7ada98384dad112e91a7b0c54b32b109363daf882d68a4c3fbb81852a745ee5ace83a0a7af3f&scene=0&previewkey=04QDpm1ium9XmT%252Fx0Eu0fsNS9bJajjJKzz%252F0By7ITJA%253D#wechat_redirect');
                    //header("Location:https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=MzUzODE2OTQ0MA==&scene=124#wechat_redirect");
                }
                $state =M('user')->where(array('open_id'=>$data->openid))->find();
                if($state){
                    $_SESSION['user_id'] = $state['user_id'];
                    if($_SESSION['friends_user']){
                        $this->friend();
                    }
                    $rurl = base64_decode($id);
                    redirect("http://wap.manjianghu.com".$rurl);
                }else{
                    $arr['open_id'] = $data->openid;
                    $arr['avatar'] = $data->headimgurl;
                    $arr['user_name'] = base64_encode($data->nickname);
                    $arr['sex'] = $data->sex;
                    $arr['pid'] = 0;
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
                    if($_SESSION['friends_user']){
                        $this->friend();
                    }
                    $rurl = base64_decode($id);
                    redirect("http://wap.manjianghu.com".$rurl);
                }
            }else{
                echo '获取用户信息失败失败！';die;
            }
        }else{
            echo '获取access_token失败！';die;
        }
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

    //邀请好友
    public function friend(){
        if($_SESSION['user_id'] == $_SESSION['friends_user']){
            $data = [
                'status' => 2,
                'msg' => '不能邀请自己！'
            ];
            return $data;
        }
        $user = M('user')->where(array('user_id'=>$_SESSION['user_id']))->field('pid')->find();
        //查询判断是否有邀请人
        if(empty($user['pid'])){
            $where = array(
                'user_id' => $_SESSION['user_id'],
                'friend_id' => $_SESSION['friends_user'],
            );
            $status = M('friend')->where($where)->find();
            //查询判断双方是不是好友
            if ($status != null){
                $data = [
                    'status' => 0,
                    'msg' => '你们已经是好友了!'
                ];
            }else{
                $save = array(
                    'pid' =>$_SESSION['friends_user'],
                );
                M('User')->where(array('user_id'=>$_SESSION['user_id']))->save($save);
                $data1 = array(
                    'user_id' => $_SESSION['user_id'],
                    'friend_id' => $_SESSION['friends_user'],
                    'add_time' => time(),
                );
                $data2 = array(
                    'user_id' => $_SESSION['friends_user'],
                    'friend_id' => $_SESSION['user_id'],
                    'add_time' => time(),
                );
                $id = M('friend')->add($data1);
                $id2 = M('friend')->add($data2);
                if (is_numeric($id) && is_numeric($id2)){
                    //增加声望
                    $myuser = M('User')->where(array('user_id'=>$_SESSION['friends_user']))->field('reputation')->find();
                    $po = array(
                        'reputation' => $myuser['reputation'] + 3,
                    );
                    M('User')->where(array('user_id'=>$_SESSION['friends_user']))->save($po);
                    $data = [
                        'status' => 1,
                        'msg' => '好友添加成功。'
                    ];
                }else{
                    $data = [
                        'status' => 2,
                        'msg' => '好友添加失败!'
                    ];
                }
            }
        }else {
            $data = [
                'status' => 0,
                'msg' => '你们已经是好友了!'
            ];
        }
        return $data;
    }

}