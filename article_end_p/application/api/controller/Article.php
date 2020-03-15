<?php
namespace app\api\controller;

class Article extends Common
{   
    protected $model;

    protected function _initialize()
    {
        parent::_initialize();
        $this->model = model('Article');
    }

    public function articles_list()
    {
        // echo 'articles_list';
        // 接收参数
        $data = $this->params;
        // dump($data);die;
        // dump($data['title']);die;
        $data['flag'] = isset($data['type'])?$data['type']:false;
        $data['title'] = isset($data['title'])?$data['title']:false;
        $this->model->articles_list($data);
    }

    public function article_detail()
    {
        // echo 'aticle_detail';
        // 接收参数
        $data = $this->params;
        // 查询数据库
        $this->model->article_detail($data['id']);
    }

    public function article_content()
    {
        // echo 'article_content';
        // 接收参数
        $data = $this->params;
        // 查询数据库
        $this->model->article_content($data['id']);
    }

    public function articles_select(){
        // 接收参数
        // 查询数据库
        $this->model->articles_select();
    }

    public function article_add()
    {
        // echo 'article_add';
        // 接收参数
        $data = $this->params;
        // 查询数据库
        $this->model->article_add($data);
    }

    public function article_edit()
    {
        // echo 'article_add';
        // 接收参数
        $data = $this->params;
        // 查询数据库
        $this->model->article_edit($data);
    }

    public function articles_type(){
        // 接收参数
        // 查询数据库
        $this->model->articles_type();
    }

    public function article_delete(){
        // 接收参数
        $data = $this->params;
        // 查询数据库
        $this->model->article_delete($data['id']);
    }
}
