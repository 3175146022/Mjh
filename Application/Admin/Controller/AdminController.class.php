<?php
namespace Admin\Controller;
use Think\Controller;

class AdminController extends CommonController{
    //公共方法
    public function _initialize(){
        $this->check_login();//检查登录
    }
    //后台管理员列表
    public function index(){
        $data = M('Admin')->select();
        $this->assign('data',$data);
        $this->display();
    }
    //添加管理员
    public function add_user(){
        //关闭表单令牌
        C('TOKEN_ON',false);
        if(IS_POST){
            $verify = D('Admin');
            if(!$verify->create()){
                $this->error($verify->getError());
            }else{
                $data['admin_name'] = $_POST['admin_name'];
                $data['password'] = md5($_POST['password']);
                $admin_password = md5($_POST['admin_password']);
                $admin = M('Admin')->where(array('status'=>1))->select();
                if($admin[0]['password'] == $admin_password){
                    if(!$verify->create()){
                        $this->error($verify->getError());
                    }else{
                        $result = M('Admin')->add($data);
                        if($result){
                            $this->success('添加成功！');
                        }
                    }
                }else{
                    echo "<script>alert('超级管理员密码错误！');window.history.go(-1)</script>";
                }
            }
        }else{
            $this->display();
        }
    }
    //修改管理员
    public function update_user(){
        if(IS_POST){
            $post = array(
                'id' => I('post.id'),
            );
            $data = M('Admin')->where(array('id'=>$post['id']))->find();
            $old_password = md5($_POST['password_old']);
            //判断旧密码是否正确
            if($data['password'] == $old_password){
                $data['admin_name'] = $_POST['admin_name'];
                $data['password'] = md5($_POST['password']);
                //判断提交新密码是否为空
                if(!empty($data['admin_name']) && $data['password'] != 'd41d8cd98f00b204e9800998ecf8427e'){
                    $result = M('Admin')->where(array('id'=>$post['id']))->save($data);
                    $this->success('修改成功！',U('Admin/index'));
                }else{
                    echo "<script>alert('请重新输入账号或密码！');window.history.go(-1)</script>";
                }
            }else{
                echo "<script>alert('旧密码错误，请重新输入！');window.history.go(-1)</script>";
            }
        }else{
            $id = I('get.id');
            $data = M('Admin')->where(array('id'=>$id))->find();
            $this->assign('data',$data);
            $this->display();
        }
    }
    //删除管理员
    public function delete_user(){
        $id = $_GET['id'];
        $admin_status = M('Admin')->where(array('id'=>session('admin_id')))->field('status')->select();
        if($admin_status[0]['status'] == '1'){
            $result = M('Admin')->where(array('id'=>$id))->delete();
            if ($result){
                $data = [
                    'status' => 1,
                    'msg'    => '删除成功'
                ];
                echo json_encode($data);
            }else{
                $data = [
                    'status' => 0,
                    'msg'    => '删除失败，请稍后重试！'
                ];
                echo json_encode($data);
            }
        }else{
            echo "<script>alert('您没有权限删除！');window.history.go(-1)</script>";
        }
    }
}

?>