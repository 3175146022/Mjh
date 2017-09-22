<?php
namespace Admin\Controller;
use Think\Controller;

class SoliveController extends Controller{
    public function index(){
        $data = M('Solive')->select();
        $this->assign('data',$data);
        $this->display();
    }
    public function add_solive(){
        //关闭表单令牌
        C('TOKEN_ON',false);
        $post = array(
            'so_title' => I('post.so_title'),
            'so_detail' => I('post.so_detail'),
            'so_author' => I('post.so_author'),
            'so_link' => I('post.so_link'),
            'add_time' => NOW_TIME,
        );
        if(IS_POST){
            $verify = D('Solive');
            if(!$verify->create()){
                $this->error($verify->getError());
            }else {
                $res = M('Solive')->add($post);
                if($res){
                    $this->success('添加成功',U('Solive/add_solive'));
                }else{
                    echo "<script>alert('添加失败！');window.history.go(-1)</script>";
                }
            }
        }else{
            $this->display();
        }
    }
    public function update_solive(){
        //关闭表单令牌
        C('TOKEN_ON',false);
        $post = array(
            'solive_id' => I('post.solive_id'),
            'so_title' => I('post.so_title'),
            'so_detail' => I('post.so_detail'),
            'so_author' => I('post.so_author'),
            'so_link' => I('post.so_link'),
        );
        if(IS_POST){
            $verify = D('Solive');
            if(!$verify->create()){
                $this->error($verify->getError());
            }else {
                $res = M('Solive')->where(array('solive_id'=>$post['solive_id']))->save($post);
                if($res){
                    $this->success('修改成功',U('Solive/index'));
                }else{
                    echo "<script>alert('修改失败！');window.history.go(-1)</script>";
                }
            }
        }else{
            $id = I('get.id');
            $data = M('Solive')->where(array('solive_id'=>$id))->find();
            $this->assign('data',$data);
            $this->display();
        }
    }
    public function delete_solive(){
        $id = I('get.id');
        $result = M('Solive')->where(array('solive_id'=>$id))->delete();
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