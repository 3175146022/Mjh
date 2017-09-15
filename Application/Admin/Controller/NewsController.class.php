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
}
?>