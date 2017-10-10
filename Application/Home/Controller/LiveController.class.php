<?php
namespace Home\Controller;

use Think\Controller;

class LiveController extends CommonController{
    public function __construct(){
        parent::__construct();
    }
    //江湖直播列表
    public function index(){
        $list = M('Solive')->select();
        $this->assign('list',$list);
        $this->display();//页面赋值
    }
    //江湖直播详情
    public function show(){
        $id = I('get.id');
        $data = M('Solive')->where(array('solive_id'=>$id))->find();
        $keep = M('collect')->where(array('collect'=>$data['solive_id'],'cate'=>2,'user_id'=>$_SESSION['user_id']))->find();
        $user = M('user')->where(array('user_id'=>$_SESSION['user_id']))->find();
        //评论

        $comment = M('comment')->where(array('solive_id'=>$data['solive_id'],'reply_id'=>0,'pid'=>0))->order('add_time asc')->select();
        foreach($comment as $val){
            $time = time()-$val['add_time'];
            if($time>=86400){
                $day = floor($time/86400);
                $val['time'] = $day.'天前';
            }else if(86400>$time and $time>=3600){
                $hour = floor($time/3600);
                $val['time'] = $hour.'小时前';
            }else if(3600>$time and $time>=60){
                $hour = floor($time/60);
                $val['time'] = $hour.'分前';
            }else{
                $val['time'] = $time.'秒前';
            }
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
        //回复1级
        $this->assign('comment',$comment_list);
        $this->assign('user',$user);
        $this->assign('keep',$keep);
        $this->assign('data',$data);
        $this->display();//页面赋值
    }


    function arr_foreach ($arr)
    {
        if (!is_array ($arr))
        {
            return false;
        }
        foreach ($arr as $key => $val )
        {
            if (is_array ($val))
            {
                $this->arr_foreach($val);
            }
            else
            {
             $a[]=$val;
            }
        }
        return $a;
    }


    //评论列表
    public function comment(){


    }



    //添加评论
    public function add_comment(){
        if(IS_POST){
            $data['user_id'] = $_SESSION['user_id'];
            $data['solive_id'] = $_POST['live_id'];
            $data['add_time'] = time();
            $data['content'] = $_POST['content'];
            $state = M('comment')->add($data);
            $user = M('user')->where(array('user_id'=>$_SESSION['user_id']))->find();
            if($state){
                $att=[
                    'state'=>200,
                    'time'=>'刚刚',
                    'id'=>$state,
                    'user_name'=>base64_decode($user['user_name']),
                    'avatar'=>$user['avatar'],
                    'content'=>$_POST['content']
                ];
            }else{
                $att=[
                    'state'=>201,
                    'msg'=>'评论失败'
                ];
            }
        }else{
            $att=[
                'state'=>201,
                'msg'=>'评论失败'
            ];
        }
        $this->ajaxReturn($att);
    }

    //回复
    public function reply_comment(){
        if(IS_POST){
            $comment = M('comment')->where(array('comment_id'=>$_POST['id']))->find();
            $data['user_id'] = $_SESSION['user_id'];//用户id
            $data['solive_id'] = $comment['solive_id'];//直播id
            $data['add_time'] = time();
            $data['content'] = $_POST['z_content'];//内容
            $data['reply_id'] = $comment['user_id'];//回复id
            $data['pid'] =$_POST['id'];//上条id
            $state = M('comment')->add($data);
            $user = M('user')->where(array('user_id'=>$_SESSION['user_id']))->find();
            if($state){
                $att=[
                    'state'=>200,
                    'id'=>$state,
                    'name'=>base64_decode($user['user_name']),
                    'user_id'=>$user['user_id'],
                    'content'=>$_POST['z_content']
                ];
            }else{
                $att=[
                    'state'=>201,
                    'msg'=>'评论失败'
                ];
            }
        }else{
            $att=[
                'state'=>201,
                'msg'=>'评论失败'
            ];
        }
        $this->ajaxReturn($att);
    }

    public function reply_edit(){
        if(IS_POST){
            $comment = M('comment')->where(array('comment_id'=>$_POST['ids']))->find();
            if($comment['user_id'] == $_SESSION['user_id']){
                $att=[
                    'state'=>201,
                    'msg'=>'不能回复自己'
                ];
                $this->ajaxReturn($att);
            }
            $data['user_id'] = $_SESSION['user_id'];//用户id
            $data['solive_id'] = $comment['solive_id'];//直播id
            $data['add_time'] = time();
            $data['content'] = $_POST['b_content'];//内容
            $data['reply_id'] = $comment['user_id'];//回复id
            $data['pid'] =$_POST['ids'];//上条id
            $state = M('comment')->add($data);
            $user = M('user')->where(array('user_id'=>$_SESSION['user_id']))->find();
            $edit = M('user')->where(array('user_id'=>$comment['user_id']))->find();
            if($state){
                $att=[
                    'state'=>200,
                    'id'=>$state,
                    'name'=>base64_decode($user['user_name']),
                    'user_id'=>$user['user_id'],
                    'content'=>$_POST['b_content'],
                    'reply'=>base64_decode($edit['user_name'])
                ];
            }else{
                $att=[
                    'state'=>201,
                    'msg'=>'评论失败'
                ];
            }
        }else{
            $att=[
                'state'=>201,
                'msg'=>'评论失败'
            ];
        }
        $this->ajaxReturn($att);
    }


}