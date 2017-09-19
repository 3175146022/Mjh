<?php
/*
 * 王建
 *
 * */
namespace Admin\Controller;
use Think\Controller;

class TokenController extends CommonController{
    //公共方法
    public function _initialize(){
        $this->check_login();//检查登录
    }
    //令牌列表
    public function index(){
        $data = M('Token')->select();
        $this->assign('data',$data);
        $this->display();
    }
    //添加令牌
    public function add_token(){
        //关闭表单令牌
        C('TOKEN_ON',false);
        $verify = D('Token');
        if(IS_POST){
            if(!$verify->create()){
                $this->error($verify->getError());
            }else{
                $data['tok_num'] = $_POST['tok_num'];
                $data['tok_level'] = $_POST['tok_level'];
                $result = M('Token')->add($data);
                if($result){
                    $this->success('添加成功！');
                }
            }
        }else{
            $this->display();
        }
    }
    //修改令牌
    public function update_token(){
        //关闭表单令牌
        C('TOKEN_ON',false);
        if(IS_POST){
            $post =array(
                'token_id' => I('post.token_id'),
            );
            $verify = D('Token');
            if(!$verify->create()){
                $this->error($verify->getError());
            }else{
                $temp['tok_num'] = $_POST['tok_num'];
                $temp['tok_level'] = $_POST['tok_level'];
                $result = M('Token')->where(array('token_id'=>$post['token_id']))->save($temp);
                if($result){
                    $this->success('修改成功！',U('Token/index'));
                }
            }
        }else{
            $id = I('get.id');
            $data = M('Token')->where(array('token_id'=>$id))->find();
            $this->assign('data',$data);
            $this->display();
        }
    }
    public function delete_token(){
        $id = I('get.id');
        $result = M('Token')->where(array('token_id'=>$id))->delete();
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