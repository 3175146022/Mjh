<?php
namespace Home\Model;
use Think\Model;

class RewardModel extends Model{
    public function add_reward($post,$info,$user){
        $img_path = 'Uploads/'.$info['re_image']['savepath'].$info['re_image']['savename'];
        $data = array(
            're_title' => $post['re_title'],
            're_content' => $post['re_content'],
            'end_time' => strtotime($post['end_time']),
            'add_time' => NOW_TIME,
            're_image' => $img_path,
            'author' => $user['user_name'],
        );
        $res = M('Reward')->add($data);
        $num = 0;
        foreach ($info as $k=>$v){
            if($k != 're_image'){
                $num ++ ;
                if($num <= 3){
                    $url = 'Uploads/'.$v['savepath'].$v['savename'];
                    $img = array(
                        're_pic_id' => '',
                        'reward_id' => $res,
                        're_picture' => $url
                    );
                    M('RePicture')->add($img);
                }
            }
        }
        return $res;
    }
}
?>