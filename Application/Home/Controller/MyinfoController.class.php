<?php
namespace Home\Controller;

use Think\Controller;

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
        if ($_GET['user_name']){
            $this->assign('user_name',$_GET['user_name']);
            $this->display();
        }
        if ($_POST){
            C('TOKEN_ON',false);
            $verify = D('User');
            if(!$verify->create()){
                $this->error($verify->getError());
            }else{
                $user_name = base64_encode($_POST['user_name']);
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
        $this->display();
    }

    public function position()
    {
        if ($_GET['info_id'] != null){
            $a = M('user_info')->where('info_id = '.$_GET['info_id'])->find();
            $this->assign('data',$a);
            $this->display();
        }else{
            $this->display();
        }

        
    }

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
}