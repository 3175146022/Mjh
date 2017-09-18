<?php
namespace Admin\Controller;
use Think\Controller;

class AdminController extends Controller{
    //后台管理员列表
    public function index(){
        $data = M('Admin')->select();
        $this->assign('data',$data);
        $this->display();
    }
    //添加管理员
    public function add_user(){
        if($_POST){
            $data['admin_name'] = $_POST['admin_name'];
            $data['password'] = md5($_POST['password']);
            $result = M('Admin')->add($data);
            if($result){
                $this->success('修改成功！',U('Admin/add_user'));
            }
        }
        $this->display();
    }
    //修改管理员
    public function update_user(){
        $id = $_GET['id'];
        $data = M('Admin')->where(array('id'=>$id))->find();
        if($_POST){
            $old_password = md5($_POST['password_old']);
            //判断旧密码是否正确
            if($data['password'] == $old_password){
                $data['admin_name'] = $_POST['admin_name'];
                $data['password'] = md5($_POST['password']);
                //判断提交新密码是否为空
                if(!empty($data['admin_name']) && $data['password'] != 'd41d8cd98f00b204e9800998ecf8427e'){
                    $result = M('Admin')->where(array('id'=>$id))->save($data);
                    $this->success('修改成功！',U('Admin/index'));
                }else{
                    echo "<script>alert('请重新输入账号或密码！')</script>";
                }
            }else{
                echo "<script>alert('旧密码错误，请重新输入！')</script>";
            }
        }
        $this->assign('data',$data);
        $this->display();
    }
    //删除管理员
    public function delete_user(){
        $id = $_GET['id'];
        $result = M('Admin')->where(array('id'=>$id))->delete();
        if($result){
            $this->redirect('Admin/index');
        }
    }
}

?>