<?php
namespace Admin\Controller;
use Think\Controller;

class TokenController extends Controller{
    //令牌列表
    public function index(){
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
                var_dump($_POST);
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