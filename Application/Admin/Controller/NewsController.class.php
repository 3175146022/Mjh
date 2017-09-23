<?php
namespace Admin\Controller;
use function PHPSTORM_META\type;
use Think\Controller;

class NewsController extends Controller{
    //新闻列表页
    public function index(){
        $a = M('news')->join('news_cate ON news_cate.cate_id = news.cate_id')->select();
        $this->assign('data',$a);

        $this->display();
    }
    //添加新闻
    public function add_news(){
        $a = M('news_cate')->where('pid = 0')->select();
        foreach ($a as $k => $v){
            for ($i = 0;$i < count($a);$i++){
                $a[$i]['cate'] = M('news_cate')->where('pid = '.$a[$i]['cate_id'])->select();
            }
        }
        $this->assign('data',$a);
        $this->display();
    }
    public function save_add()
    {
        C('TOKEN_ON',false);
        if(IS_POST){
            $verify = D('News');
            if(!$verify->create()){
                $this->error($verify->getError());
            }else {
                //添加图片
                $upload = new \Think\Upload();                              // 实例化上传类
                $upload->maxSize = 0;                                // 设置附件上传大小
                $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath = './Uploads/';                      // 设置附件上传根目录
                $upload->savePath = 'news/';                       // 设置附件上传（子）目录
                // 上传文件
                $info = $upload->upload();
                if(!$info['picture']){
                    $this->error('请添加图片');
                }else{
                    $_POST['picture'] = 'Uploads/'.$info['picture']['savepath'].$info['picture']['savename'];
                    $_POST['add_time'] = time();
                    $_POST['update_time'] = time();

                    $a = D('news')->data($_POST)->add();
                    if (is_numeric($a)){
                        $this->success('添加成功',U('News/add_news'));
                    }
                }
            }
        }
    }

    //修改新闻
    public function update_news(){
        if ($_GET['id']){
            $b = M('news')->where('news_id = '.$_GET['id'])->join('news_cate ON news_cate.cate_id = news.cate_id')->select();

            $a = M('news_cate')->where('pid = 0')->select();
            foreach ($a as $k => $v){
                for ($i = 0;$i < count($a);$i++){
                    $a[$i]['cate'] = M('news_cate')->where('pid = '.$a[$i]['cate_id'])->select();
                }
            }
            $this->assign('data',$b);
            $this->assign('cate',$a);
            $this->display();
        }

    }

    public function save_news_update()
    {
        C('TOKEN_ON',false);
        if (IS_POST){
            $verify = D('News');
            if(!$verify->create()){
                $this->error($verify->getError());
            }else{
                $b = M('news')->where('news_id = '.$_GET['id'])->join('news_cate ON news_cate.cate_id = news.cate_id')->select();
                $upload = new \Think\Upload();                              // 实例化上传类
                $upload->maxSize = 0;                                // 设置附件上传大小
                $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath = './Uploads/';                      // 设置附件上传根目录
                $upload->savePath = 'news/';                       // 设置附件上传（子）目录
                // 上传文件
                $info = $upload->upload();
                if(!$info['picture']){
                    $_POST['update_time'] = time();

                    $a = D('news')->where('news_id = '.$_GET['id'])->save($_POST);

                    if (is_numeric($a)){
                        $this->success('修改成功',U('News/index'));
                    }
                }else{
                    unlink($b[0]['picture']);
                    $_POST['picture'] = 'Uploads/'.$info['picture']['savepath'].$info['picture']['savename'];
                    $_POST['update_time'] = time();

                    $a = D('news')->where('news_id = '.$_GET['id'])->save($_POST);

                    if (is_numeric($a)){
                        $this->success('修改成功',U('News/index'));
                    }
                }
            }
        }
    }
    
    //删除新闻
    public function destroy_news()
    {
        if ($_GET['id']){
            $a = M('news')->where('news_id = '.$_GET['id'])->select();
            $b = unlink($a[0]['picture']);
            if ($b){
                $c = M('news')->where('news_id = '.$_GET['id'])->delete();
                if ($c){
                   $data = [
                       "status" => 1,
                       "msg" => "删除成功"
                   ];
                   echo json_encode($data);
                }else{
                    $data = [
                        "status" => 0,
                        "msg" => "删除失败"
                    ];
                    echo json_encode($data);
                }
            }else{
                $data = [
                    "status" => 2,
                    "msg" => "图片删除失败。"
                ];
                echo json_encode($data);
            }

        }

    }
    
    
    
    
    
    //分类列表
    public function news_cate(){
        $a = M('news_cate')->where('pid = 0')->select();
        foreach ($a as $k => $v){
            for ($i = 0;$i < count($a);$i++){
                $a[$i]['cate'] = M('news_cate')->where('pid = '.$a[$i]['cate_id'])->select();
            }
        }
       $this->assign('cate',$a);
        $this->display();
    }
    //添加分类
    public function add_cate(){
        $a = M('news_cate')->where('pid = 0')->select();

        $this->assign('cate_p',$a);

        $this->display();
    }
    public function save_cate(){
        if ($_POST){
            $res = M('news_cate')->data($_POST)->add();
            if ($res){
                $this->success('添加成功',U('News/news_cate'));
            }else{
                $this->error('添加失败，请稍后重试！');
            }
        }
    }
    //修改分类
    public function update_cate()
    {
        if ($_GET['id']){
            $id =$_GET['id'];
            $p = M('news_cate')->where('pid = 0')->select();
            $data = M('news_cate')->where('cate_id = '.$id)->select();

            $this->assign('p',$p);
            $this->assign('data',$data);
            $this->display();
        }
    }

    public function save_update()
    {
        if ($_POST){
            $a = M('news_cate')->where('cate_id = '.$_GET['id'])->save($_POST);
            if (is_numeric($a)){
                $this->success('修改成功',U('News/news_cate'));
            }else{
                $this->error('修改失败，请稍后重试!');
            }
        }
    }
    //删除分类
    public function destroy_cate()
    {
        if ($_GET['id']){
            $id = $_GET['id'];
            $response = M('news')->where('cate_id = '.$id)->select();

            if (empty($response)){
                $res = M('news_cate')->where('cate_id = '.$id)->delete();
                if ($res){
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
                $data = [
                    'status' => 2,
                    'msg'    => '此分类下含有文章，请删除文章后再试！'
                ];
                echo json_encode($data);
            }
        }
    }
}
?>