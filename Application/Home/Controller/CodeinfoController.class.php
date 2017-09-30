<?php
namespace Home\Controller;

use Think\Controller;

class CodeinfoController extends CommonController{

    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        $user = M('user')->where('user_id = '.$_GET['user_id'])->find();
        $this->assign('user',$user);
        $this->display();
    }

    public function add_friend()
    {
        if ($_POST){
            if ($_POST['friend_id'] != $_SESSION['user_id']){
                $status = M('friend')->where(['user_id' => $_SESSION['user_id'],'friend_id' => $_POST['friend_id']])->find();
                if ($status != null){
                    $data = [
                        'status' => 0,
                        'msg' => '你们已经是好友了!'
                    ];
                    echo json_encode($data);
                }else{
                    $id = M('friend')->data('user_id='.$_SESSION['user_id'].'&friend_id='.$_POST['friend_id'])->add();
                    $id2 = M('friend')->data('user_id='.$_POST['friend_id'].'&friend_id='.$_SESSION['user_id'])->add();
                    if (is_numeric($id) && is_numeric($id2)){
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
}