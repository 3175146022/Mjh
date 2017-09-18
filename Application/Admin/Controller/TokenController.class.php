<?php
namespace Admin\Controller;
use Think\Controller;

class TokenController extends Controller{
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
        }
        $this->display();
    }
    //修改令牌
    public function update_token(){
        $this->display();
    }
}
?>