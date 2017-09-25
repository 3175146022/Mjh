<?php
namespace Admin\Controller;
use Think\Controller;

class GeneraController extends Controller{
    //推广列表
    public function index(){
        $list = M('Genera')->select();
        $this->assign('list',$list);
        $this->display();
    }
    //添加推广
    public function add_genera(){
        //关闭表单令牌
        C('TOKEN_ON',false);
        if(IS_POST){
            $verify = D('Genera');
            if(!$verify->create()){
                $this->error($verify->getError());
            }else {
                $data = array(
                    'content' => $_POST['content'],
                    'add_time' => NOW_TIME,
                );
                $res = M('Genera')->add($data);
                if($res){
                    $this->success('添加成功！');
                }else{
                    echo "<script>alert('添加失败！');window.history.go(-1)</script>";
                }
            }
        }else{
            $this->display();
        }
    }
    //修改推广
    public function update_genera(){
        //关闭表单令牌
        C('TOKEN_ON',false);
        if(IS_POST){
            $verify = D('Genera');
            if(!$verify->create()){
                $this->error($verify->getError());
            }else {
                $data = array(
                    'content' => $_POST['content']
                );
                $res = M('Genera')->where(array('id'=>$_POST['id']))->save($data);
                if($res){
                    $this->success('修改成功！',U('Genera/index'));
                }else{
                    echo "<script>alert('修改失败！');window.history.go(-1)</script>";
                }
            }
        }else{
            $id = I('get.id');
            $data = M('Genera')->where(array('id'=>$id))->find();
            $this->assign('data',$data);
            $this->display();
        }
    }
    //删除推广
    public function delete_gen(){
        $id = I('get.id');
        $result = M('Genera')->where(array('id'=>$id))->delete();
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
    }
}
?>