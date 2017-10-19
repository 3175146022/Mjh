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
    //匹配令牌列表
    public function index(){
        $data = M('Token')->join('user on user.token_id = token.token_id')->select();
        $this->assign('data',$data);
        $this->display();
    }
    //未使用令牌列表
    public function token(){
        $data = M('Token')->where(array('bind_time'=>0))->select();
        $this->assign('data',$data);
        $this->display();
    }
    //修改未使用令牌
    public function update_tok(){
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
                $temp['phone'] = $_POST['phone'];
                $result = M('Token')->where(array('token_id'=>$post['token_id']))->save($temp);
                if($result){
                    $this->success('修改成功！',U('Token/token'));
                }
            }
        }else{
            $id = I('get.id');
            $data = M('Token')->where(array('token_id'=>$id))->find();
            $this->assign('data',$data);
            $this->display();
        }
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
                $data['phone'] = $_POST['phone'];
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
        $user = M('User as u')
            ->join('token as t ON t.token_id = u.token_id')
            ->find();
        $post = array(
            'token_id' => null,
        );
        $res = M('User')->where(array('token_id'=>$id))->save($post);
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
    public function delete_tok(){
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

    //上传方法
    public function upload()
    {
        header("Content-Type:text/html;charset=utf-8");
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('xls', 'xlsx');// 设置附件上传类
        $upload->savePath  =      '/'; // 设置附件上传目录
        // 上传文件
        $info   =   $upload->uploadOne($_FILES['excelData']);
        $filename = './Uploads'.$info['savepath'].$info['savename'];
        $exts = $info['ext'];
        //print_r($info);exit;
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            $this->goods_import($filename, $exts);
        }
    }
    //导入保存数据方法
    protected function goods_import($filename, $exts='xls')
    {
        //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
        import("Org.Util.PHPExcel");
        //创建PHPExcel对象，注意，不能少了\
        $PHPExcel=new \PHPExcel();
        //如果excel文件后缀名为.xls，导入这个类
        if($exts == 'xls'){
            import("Org.Util.PHPExcel.Reader.Excel5");
            $PHPReader=new \PHPExcel_Reader_Excel5();
        }else if($exts == 'xlsx'){
            import("Org.Util.PHPExcel.Reader.Excel2007");
            $PHPReader=new \PHPExcel_Reader_Excel2007();
        }


        //载入文件
        $PHPExcel=$PHPReader->load($filename);
        //获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
        $currentSheet=$PHPExcel->getSheet(0);
        //获取总列数
        $allColumn=$currentSheet->getHighestColumn();
        //获取总行数
        $allRow=$currentSheet->getHighestRow();
        //循环获取表中的数据，$currentRow表示当前行，从哪行开始读取数据，索引值从0开始
        $data=array();
        for($j=2;$j<=$allRow;$j++){
            //从哪列开始，A表示第一列
            $one =array();
            for($i='B';$i<='E';$i++){
                //读取到的数据，保存到数组$arr中
                $cell =$currentSheet->getCell("$i$j")->getValue();
                //$cell = $data[$currentRow][$currentColumn];
                if($cell instanceof PHPExcel_RichText){
                    $cell  = $cell->__toString();
                }
                $one[]=$cell;
            }
            //此处编写存入数据库代码！
            //var_dump($one);
            $post = array(
                'tok_num' => $one['1'],
                'tok_level' => $_POST['tok_level'],
                'phone' => $one['3']
            );
            $res = M('Token')->add($post);
            if($res){
                $this->success('添加成功！');
            }
        }
    }
}
?>