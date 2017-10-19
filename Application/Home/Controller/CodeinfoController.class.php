<?php
namespace Home\Controller;

use Think\Controller;

class CodeinfoController extends CommonController{

    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
//        $user = M('user')->where('user_id = '.$_GET['user_id'])->find();
//        $this->assign('user',$user);
        $this->display();
    }

    public function add_friend()
    {
        if ($_POST){
            if ($_POST['friend_id'] != $_SESSION['user_id']){
                $where = array(
                    'user_id' => $_SESSION['user_id'],
                    'friend_id' => $_POST['friend_id']
                );
                $status = M('Friend')->where($where)->find();
                if ($status != null){
                    $data = [
                        'status' => 0,
                        'msg' => '你们已经是好友了!'
                    ];
                    echo json_encode($data);
                }else{
                    $data1 = array(
                        'user_id' => $_SESSION['user_id'],
                        'friend_id' => $_POST['friend_id'],
                    );
                    $data2 = array(
                        'user_id' => $_POST['friend_id'],
                        'friend_id' => $_SESSION['user_id'],
                    );
                    $id = M('Friend')->add($data1);
                    $id2 = M('Friend')->add($data2);
                    if (is_numeric($id) && is_numeric($id2)){
                        $repu = M('User')->where(array('user_id'=>$_POST['friend_id']))->find();
                        $dd = $repu['reputation'] + 1;
                        $repuT = array(
                            'reputation' => $dd,
                        );
                        $ss = M('User')->where(array('user_id'=>$_POST['friend_id']))->save($repuT);
                        $data = [
                            'status' => 1,
                            'msg' => '好友添加成功。'
                        ];
                        echo json_encode($data);
                    }else{
                        $data = [
                            'status' => 2,
                            'msg' => '好友添加失败!'
                        ];
                        echo json_encode($data);
                    }
                }
            }else{
                $data = [
                    'status' => 3,
                    'msg' => '不能加自己为好友额!'
                ];
                echo json_encode($data);
            }
        }
    }
    public function friend(){
        $user = M('user')->where('user_id = '.$_GET['user_id'])->find();
        $this->assign('user',$user);
        $this->display();
    }
}