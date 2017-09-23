<?php
namespace Admin\Controller;
use Think\Controller;

class SoliveController extends Controller{
    //直播列表
    public function index(){
        $data = M('Solive')->select();
        $this->assign('data',$data);
        $this->display();
    }
    //添加直播
    public function add_solive(){
        //关闭表单令牌
        C('TOKEN_ON',false);
        if(IS_POST){
            $verify = D('Solive');
            if(!$verify->create()){
                $this->error($verify->getError());
            }else {
                $_POST['add_time'] = NOW_TIME;
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     0 ;// 设置附件上传大小
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
                $upload->savePath  =     'solive/'; // 设置附件上传（子）目录
                // 上传文件
                $info   =   $upload->upload();
                if(!$info['img']){
                    echo "<script>alert('请添加图片！');window.history.go(-1)</script>";
                }else{
                    $_POST['img'] = 'Uploads/'.$info['img']['savepath'].$info['img']['savename'];
                    $res = M('Solive')->add($_POST);
                    if($res){
                        $this->success('添加成功',U('Solive/add_solive'));
                    }else{
                        echo "<script>alert('添加失败！');window.history.go(-1)</script>";
                    }
                }
            }
        }else{
            $this->display();
        }
    }
    //修改直播
    public function update_solive(){
        //关闭表单令牌
        C('TOKEN_ON',false);
        if(IS_POST){
            $verify = D('Solive');
            if(!$verify->create()){
                $this->error($verify->getError());
            }else {
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     0 ;// 设置附件上传大小
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
                $upload->savePath  =     'solive/'; // 设置附件上传（子）目录
                // 上传文件
                $info   =   $upload->upload();
                $res = D('Solive')->update_solive($_POST,$info);
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
    //删除直播
    public function delete_solive(){
        $id = I('get.id');
        $pic = M('Solive')->field('img')->where(array('news_id'=>$id))->find();
        unlink($pic['img']);
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