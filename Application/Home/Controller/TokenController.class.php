<?php
namespace Home\Controller;

use Think\Controller;

class TokenController extends CommonController{
    public function __construct(){
        parent::__construct();
    }
    //核对江湖令
    public function index(){
        $a = M('User')->where(array('user_id'=>$_SESSION['user_id']))->find();
        if($a['token_id'] != null){
            $this->redirect('Token/token',array('id'=>$a['user_id']));
        }else {
            if (IS_POST) {
                $number = M('Token')->where(array('tok_num'=>$_POST['tok_num']))->find();
                if($number){
                    $data = array(
                        'token_id' => $number['token_id'],
                    );
                    $time = array(
                        'bind_time' => NOW_TIME,
                    );
                    //添加绑定时间
                    $token = M('Token')->where(array('tok_num'=>$_POST['tok_num']))->save($time);
                    //绑定江湖令
                    $user = M('User')->where(array('user_id'=>$_SESSION['user_id']))->save($data);
                    $member = M('User')->where(array('user_id'=>$_SESSION['user_id']))->find();
                    //按江湖令等级加积分声望
                    if($user){
                        if ($number['tok_level'] == 1) {
                            $member['integral'] += 3;
                            $member['reputation'] += 3;
                            $dd = array(
                                'integral' => $member['integral'],
                                'reputation' => $member['reputation'],
                            );
                        } elseif ($number['tok_level'] == 2) {
                            $member['integral'] += 6;
                            $member['reputation'] += 6;
                            $dd = array(
                                'integral' => $member['integral'],
                                'reputation' => $member['reputation'],
                            );
                        } elseif ($number['tok_level'] == 3) {
                            $member['integral'] += 18;
                            $member['reputation'] += 18;
                            $dd = array(
                                'integral' => $member['integral'],
                                'reputation' => $member['reputation'],
                            );
                        } elseif ($number['tok_level'] == 4) {
                            $member['integral'] += 36;
                            $member['reputation'] += 36;
                            $dd = array(
                                'integral' => $member['integral'],
                                'reputation' => $member['reputation'],
                            );
                        } elseif ($number['tok_level'] == 5) {
                            $member['integral'] += 72;
                            $member['reputation'] += 72;
                            $dd = array(
                                'integral' => $member['integral'],
                                'reputation' => $member['reputation'],
                            );
                        }
                        $temp = M('User')->where(array('user_id' => $_SESSION['user_id']))->save($dd);
                        if($temp){
                            $this->redirect('Token/token');
                        }
                    }
                }else {
                    echo "<script>alert('您输入的令牌不存在！');window.location = window.location</script>";
                }
            } else {
                $this->display();//页面赋值
            }
        }
    }
    public function token(){
        $id = I('get.id');
        $user = M('User as u')
            ->join('token as t ON t.token_id = u.token_id')
            ->where(array('user_id'=>$_SESSION['user_id']))
            ->field('t.tok_num,t.tok_level')
            ->find();
        $this->assign('data',$user);
        $this->display();
    }

}