<?php
namespace Admin\Controller;

use Think\Controller;

class UserController extends CommonController{
    //公共方法
    public function _initialize(){
        $this->check_login();//检查登录
    }

    public function index(){
        $a = M('user')->select();

        for ($i = 0;$i < count($a);$i++){
            if (!empty($a[$i]['trade_type'])){
                $b = M('trade')->where('trade_id = '.$a[$i]['trade_type'])->select();
                $a[$i]['trade_type'] = $b[0]['trade'];
            }
            if (!empty($a[$i]['info_id'])){
                $c = M('user_info')->where('info_id = '.$a[$i]['info_id'])->select();
                $a[$i]['phone'] = $c[0]['phone'];
            }
        }
        $this->assign('user',$a);
        $this->display();
    }

    public function details()
    {
        if ($_GET['id']){

            $a = M('user')->where('user_id = '.$_GET['id'])->select();

            if (!empty($a[0]['trade_type'])){
                $b = M('trade')->where('trade_id = '.$a[0]['trade_type'])->select();
                $a[0]['trade_type'] = $b[0]['trade'];
            }

            if (!empty($a[0]['info_id'])){
                $c = M('user_info')->where('info_id = '.$a[0]['info_id'])->select();
                $a[0]['phone'] = $c[0]['phone'];
            }
            $this->assign('data',$a);
            $this->display();
        }
    }

    public function destroy()
    {
        if ($_GET['id']) {
            $a = M('user')->where('user_id = ' . $_GET['id'])->select();
            if (!empty($a[0]['info_id'])) {
                $b = M('user_info')->where('info_id = ' . $a[0]['info_id'])->delete();
            }
            $d = M('user')->where('user_id = ' . $_GET['id'])->delete();
            if ($d) {
                $data = [
                    'status' => 1,
                    'msg' => '删除成功'
                ];
                echo json_encode($data);
            } else {
                $data = [
                    'status' => 0,
                    'msg' => '删除失败请稍后重试'
                ];
                echo json_encode($data);
            }
        }
    }
}
?>