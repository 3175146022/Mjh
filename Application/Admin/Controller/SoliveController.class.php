<?php
namespace Admin\Controller;
use Think\Controller;

class SoliveController extends CommonController{
    //公共方法
    public function _initialize(){
        $this->check_login();//检查登录
    }
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

        $list1= M('comment')->where(array('pid'=>$id))->select();
        if(empty($list1)){
           M('comment')->where(array('comment_id'=>$id))->delete();
        }else{
            foreach($list1 as $val){
                $list2= M('comment')->where(array('pid'=>$val['comment_id']))->select();
                if(empty($list2)){
                    M('comment')->where(array('comment_id'=>$val['comment_id']))->delete();
                }else{
                    foreach($list2 as $key){
                        M('comment')->where(array('comment_id'=>$key['comment_id']))->delete();
                    }
                    M('comment')->where(array('comment_id'=>$val['comment_id']))->delete();
                }
            }
        }
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

    //查看评论
    public function reply(){
        $id = I('get.id');
        $comment = M('comment')->where(array('solive_id'=>$id,'reply_id'=>0,'pid'=>0))->order('add_time asc')->select();
        foreach($comment as $val){
            $one = M('user')->where(array('user_id'=>$val['user_id']))->find();
            $val['user_name'] = base64_decode($one['user_name']);
            $val['avatar'] = $one['avatar'];
            $where['pid']=$val['comment_id'];
            $reply_list=array();
            $arr['count_1']=array();
            $reply= M('comment')->where($where)->order('add_time asc')->select();
            if($reply){
                foreach($reply  as $key){
                    $three_list=array();
                    $where2['pid']=$key['comment_id'];
                    $where2['solive_id']=$key['solive_id'];
                    $three= M('comment')->where($where2)->order('add_time asc')->select();
                    if($three){
                        foreach($three as $num){
                            $three_1= M('user')->where(array('user_id'=>$num['user_id']))->find();
                            $three_2= M('user')->where(array('user_id'=>$num['reply_id']))->find();
                            $num['user_name'] = base64_decode($three_1['user_name']);
                            $num['reply_name'] = base64_decode($three_2['user_name']);
                            $three_list[]=$num;
                        }
                    }
                    $arr['count_1'][]=count($three);
                    $key['three']=$three_list;
                    $two = M('user')->where(array('user_id'=>$key['user_id']))->find();
                    $key['user_name'] = base64_decode($two['user_name']);
                    $reply_list[]=$key;
                }
            }

            $val['counts']=array_sum($arr['count_1'])+count($reply);
            $val['reply']=$reply_list;
            $comment_list[]=$val;
        }

        $this->assign('reply_list',$comment_list);
        $this->display();
    }

    public function del_replay()
    {
        $id =I('get.id');
        $list1= M('comment')->where(array('pid'=>$id))->select();
        if(empty($list1)){
            $state =M('comment')->where(array('comment_id'=>$id))->delete();
            if($state){
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
            foreach($list1 as $val){
                $list2= M('comment')->where(array('pid'=>$val['comment_id']))->select();
                if(empty($list2)){
                    $state =M('comment')->where(array('comment_id'=>$val['comment_id']))->delete();
                    if($state){
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
                    foreach($list2 as $key){
                            M('comment')->where(array('comment_id'=>$key['comment_id']))->delete();
                    }
                    $state=M('comment')->where(array('comment_id'=>$val['comment_id']))->delete();
                    if($state){
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
        }
    }

}
?>