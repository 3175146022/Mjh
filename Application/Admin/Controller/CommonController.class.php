<?php
namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller{
    //检查登录
    public function check_login(){
        if(!session('?admin')){
            $this->redirect('Login/index');
        }
    }
    //上传图片
    public function upload(){
        //添加图片
        $upload = new \Think\Upload();                              // 实例化上传类
        $upload->maxSize = 0;                                // 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = './Uploads/';                      // 设置附件上传根目录
        $upload->savePath = 'activity/';                       // 设置附件上传（子）目录
        // 上传文件
        $info = $upload->upload();
        return $info;
    }
}
?>