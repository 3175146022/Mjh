<?php
namespace Admin\Controller;
use Think\Controller;

class AwardController extends CommonController{
    //公共方法
    public function _initialize(){
        $this->check_login();//检查登录
    }
    public function index(){
        $a = M('reward')->select();
        $this->assign('data',$a);
        $this->display();
    }
    //悬赏详情
    public function award_detail(){
        if ($_GET['reward_id']){
            $a = M('reward')->where('reward_id ='.$_GET['reward_id'])->find();
            $b = M('RePicture')->where(array('reward_id'=>$_GET['reward_id']))->select();
            $this->assign('img',$b);
            $this->assign('data',$a);
            $this->display();
        }
    }

    public function destroy()
    {
        if ($_GET['id']){
            $a = M('reward')->where('reward_id = '.$_GET['id'])->find();
            $b = unlink($a['re_image']);
            $e = M('RePicture')->where(array('reward_id'=>$_GET['id']))->select();
            foreach ($e as $k=>$v){
                $f = unlink($v['re_picture']);
            }
            if ($b){
                $c = M('reward')->where('reward_id = '.$_GET['id'])->delete();
                $g = M('RePicture')->where(array('reward_id'=>$_GET['id']))->delete();
                if ($c){
                    $data = [
                        "status" => 1,
                        "msg" => "删除成功"
                    ];
                    echo json_encode($data);
                }else{
                    $data = [
                        "status" => 0,
                        "msg" => "删除成功"
                    ];
                    echo json_encode($data);
                }
            }else{
                $data = [
                    "status" => 2,
                    "msg" => "图片删除失败"
                ];
                echo json_encode($data);
            }
        }
    }

    public function check_reward()
    {
        if ($_GET['id']){
            $a = M('reward')->where('reward_id = '.$_GET['id'])->save(['re_status' => 1]);
            if (is_numeric($a)){
                $data = [
                    'status' => 1,
                    'msg' => '审核成功'
                ];
                echo json_encode($data);
            }else{
                $data = [
                    'status' => 0,
                    'msg' => '审核失败'
                ];
                echo json_encode($data);
            }
        }
    }
}

?>