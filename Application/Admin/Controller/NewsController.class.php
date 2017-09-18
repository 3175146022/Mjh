<?php
namespace Admin\Controller;
use Think\Controller;

class NewsController extends Controller{
    //新闻列表页
    public function index(){
        $this->display();
    }
    //添加新闻
    public function add_news(){
        if($_POST){
            var_dump($_POST);
        }
        $this->display();
    }
    //修改新闻
    public function update_news(){
        $this->display();
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