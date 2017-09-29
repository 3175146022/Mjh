<?php
namespace Home\Controller;

use Think\Controller;
use Org\Ceshi\aaa;
use Vendor\Phpqrcode\phpqrcode\QRcode;

class MyinfoController extends CommonController{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        if ($_SESSION['user_id']){
            $a = M('user')->where('user_id = '.$_SESSION['user_id'])->select();
            $this->assign('data',$a);
            $this->display();//页面赋值
        }
    }

    public function name()
    {
        if ($_GET['user_id']){
            $a = M('user')->where('user_id = '.$_GET['user_id'])->field('user_name')->find();
            $this->assign('user_name',$a['user_name']);
            $this->display();
        }

        if ($_POST){
            C('TOKEN_ON',false);
            $verify = D('User');
            $user_name = base64_encode($_POST['user_name']);
            if(!$verify->create(['user_name'=>$user_name])){
                $this->error($verify->getError());
            }else{
                //$user_name = base64_encode($_POST['user_name']);
                $a = M('user')->where('user_id = '.$_SESSION['user_id'])->save(['user_name' =>$user_name]);
                //var_dump($_SESSION['user_id']);
                if ($a){
                    $this->success('修改成功',U('Myinfo/index'));
                }else{
                    $this->error('失败');
                }
            }
        }
    }

    public function QRcode()
    {
//        Vendor('phpqrcode.phpqrcode');
        $url = "http://wap.manjianghu.com";
        $errorCorrectionLevel =intval('L') ;//容错级别
        $matrixPointSize = intval(4);//生成图片大小
        //生成二维码图片
        $object = new \QRcode();
        $object->png($url, false, $errorCorrectionLevel, $matrixPointSize, 2);
        //$object->ceshi();
    }

//    public function twodemcode(){
//        $host=$_SERVER["HTTP_HOST"];
//        vendor("phpqrcode.phpqrcode");
//        $data ='http://www.zhihu.com/';
//        // 纠错级别：L、M、Q、H
//        $level = 'L';
//        // 点的大小：1到10,用于手机端4就可以了
//        $size = 4;
//        // 下面注释了把二维码图片保存到本地的代码,如果要保存图片,用$fileName替换第二个参数false
//        $path = "Public/Index/twodecode/";
//        if(!file_exists($path))
//        {
//            mkdir($path, 0777);
//        }
//        // 生成的文件名
//        $fileName = $path.$username.'.png';
//        ob_end_clean();//清空缓冲区
//        QRcode::png($data, $fileName, $level, $size);
//    }
//
//    public function position()
//    {
//        if ($_GET['info_id'] != null){
//            $a = M('user_info')->where('info_id = '.$_GET['info_id'])->find();
//            $this->assign('data',$a);
//            $this->display();
//        }else{
//            $this->display();
//        }
//    }

    public function position_save()
    {

        if (!empty($_POST)) {
            C('TOKEN_ON',false);
            $verify = D('UserInfo');
            if(!$verify->create()){
                $this->error($verify->getError());
            }else{
                if ($_POST['info_id'] != null){
                    $a = M('user_info')->where('info_id = '.$_POST['info_id'])->save($_POST);
                    if ($a){
                        $this->success('地址更新成功！',U('Myinfo/index'));
                    }else{
                        $this->error('地址更新失败！');
                    }
                }else{
                    $info_id = M('user_info')->add($_POST);
                    if (is_numeric($info_id)){
                        $b = M('user')->where('user_id = '.$_SESSION['user_id'])->save(['info_id' => $info_id]);
                        if ($b){
                            $this->success('地址信息添加成功!',U('Myinfo/index'));
                        }else{
                            $this->error('地址信息添加失败！');
                        }
                    }
                }
            }
        }
    }

    public function industry()
    {
        $trade = M('trade')->select();
        $a = M('user')->where('user_id = '.$_SESSION['user_id'])->find();
//        if ($a['trade_type'] != null){
//            $b = M('trade')->where('trade_id = '.$a['trade_type'])->find('trade');
//            //$a['trade_type'] = $b['trade'];
//            $this->assign('default',$b);
//        }
        //var_dump($b);exit;
        $this->assign('company',$a);
        $this->assign('trade',$trade);
        $this->display();
    }

    public function industry_save()
    {
        if(!empty($_POST)){
            C('TOKEN_ON',false);
            $verify = D('User');
            if(!$verify->create()){
                $this->error($verify->getError());
            }else{
                $a = M('user')->where('user_id = '.$_POST['user_id'])->save($_POST);
                if (is_numeric($a)){
                    $this->success('行业信息更新成功!',U('Myinfo/index'));
                }else{
                    $this->error('行业信息更新失败!');
                }
            }
        }

    }

    public function interest()
    {
        $a = M('user')->where('user_id = '.$_SESSION['user_id'])->find();
        $this->assign('user',$a);
        $this->display();
    }

    public function interest_save()
    {
        if (!empty($_POST)){

            $a = M('user')->where('user_id = '.$_SESSION['user_id'])->save($_POST);
            if (is_numeric($a)){
                $this->success('兴趣更新成功！',U('Myinfo/index'));
            }else{
                $this->error('兴趣更新失败!');
            }
        }
    }

    public function sex_save()
    {
        if ($_GET['sex'] != null){
            $a = M('user')->where('user_id = '.$_SESSION['user_id'])->save(['sex' => $_GET['sex']]);
            if ($a){
                echo 'ok';
            }else{
                echo 'no';
            }
        }
    }

    public function photo()
    {
        $this->display();
    }

    public function photo_save()
    {
        if ($_POST){
            $a = M('user')->where('user_id = '.$_SESSION['user_id'])->find();
            $path = $a['avatar'];
            if ($path != null){
                $b = substr($path,26);
                //echo $a;exit;
                unlink($b);
            }
            $photo = $_POST['photo'];
            //exit;
            //匹配出图片的格式
            if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $photo, $result)){
                $type = $result[2];
                $new_file = "Uploads/user/".date('Y-m-d',time())."/";
                if(!file_exists($new_file))
                {
                    //检查是否有该文件夹，如果没有就创建，并给予最高权限
                    mkdir($new_file, 0777);
                }
                //var_dump($_SERVER);exit;
                $photo_path = $new_file.time().".{$type}";
                //echo $photo_path;exit;
                if (file_put_contents($photo_path, base64_decode(str_replace($result[1], '', $photo)))){
                    //echo '新文件保存成功：', $photo_path;
                    
                    $photo_path = "http://wap.manjianghu.com/".$photo_path;
                    $a = M('user')->where('user_id = '.$_SESSION['user_id'])->save(['avatar' => $photo_path]);
                    if (is_numeric($a)){
                        $data = [
                            'status' => 1,
                            'msg' => '头像修改成功'
                        ];
                        echo json_encode($data);
                    }else{
                        $data = [
                            'status' => 0,
                            'msg' => '头像修改失败'
                        ];
                        echo json_encode($data);
                    }
                }else{
                    echo '新文件保存失败';
                }
            }
        }
    }
}