<?php
namespace Home\Controller;
use Think\Controller;

class MarkController extends CommonController{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $data = M('Genera')->order('add_time desc')->limit(1)->find();
        $keep = M('collect')->where(array('collect'=>$data['id'],'cate'=>4,'user_id'=>$_SESSION['user_id']))->find();
        $this->assign('keep',$keep);
        $this->assign('data',$data);
        $this->display();
    }

    public function set_mark()
    {
        $status = M('mark')->where('user_id = '.$_SESSION['user_id'])->order('mark_time desc')->limit(1)->find();
        if ($status != null && NOW_TIME > $status['zero_time']){

            $a = M('user')->where('user_id = '.$_SESSION['user_id'])->find();
            $integral = $a['integral'];
            $reputation = $a['reputation'];

            $mark = [
                'integral' => $integral+1,
                'reputation' => $reputation+1
            ];

            $b = M('user')->where('user_id = '.$_SESSION['user_id'])->save($mark);

            if (is_numeric($b)){
                $zero = strtotime('today') + 24*60*60;
                $markd = [
                    'user_id' => $_SESSION['user_id'],
                    'mark_time' => NOW_TIME,
                    'zero_time' => $zero
                ];
                $id = M('mark')->data($markd)->add();
                if (is_numeric($id)){
                    $data = [
                        'status' => 1,
                        'msg' => '签到成功1。'
                    ];
                    echo json_encode($data);
                }
            }
        }elseif ($status == null ){
            $a = M('user')->where('user_id = '.$_SESSION['user_id'])->find();
            $integral = $a['integral'];
            $reputation = $a['reputation'];

            $mark = [
                'integral' => $integral+1,
                'reputation' => $reputation+1
            ];

            $b = M('user')->where('user_id = '.$_SESSION['user_id'])->save($mark);

            if (is_numeric($b)){
                $zero = strtotime('today') + 24*60*60;
                $markd = [
                    'user_id' => $_SESSION['user_id'],
                    'mark_time' => NOW_TIME,
                    'zero_time' => $zero
                ];
                $id = M('mark')->data($markd)->add();
                if (is_numeric($id)){
                    $data = [
                        'status' => 1,
                        'msg' => '签到成功2。'
                    ];
                    echo json_encode($data);
                }
            }
        } else{
            $data = [
                'status' => 0,
                'msg' => '你已签到!'
            ];
            echo json_encode($data);
        }
    }
}
?>