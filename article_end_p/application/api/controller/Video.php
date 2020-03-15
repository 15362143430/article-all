<?php
namespace app\api\controller;

class Video extends Common
{
    protected $model;

    protected function _initialize()
    {
        parent::_initialize();
        $this->model = model('Video');
    }

    public function videos_list()
    {
        // echo 'video_list';
        // 获取参数
        // 查询数据库
        $this->model -> videos_list();
    }

    public function videos_list_ms()
    {
        // 接收参数
        $data = $this->params;
        // 查询数据库
        $this->model -> videos_list_ms($data);
    }

    public function video_detail()
    {
        // echo 'video_detail';
        // 获取参数
        $data = $this->params;
        // 查询数据库
        $this->model -> video_detail($data['id']);
    }

    public function videos_list_type()
    {
        // echo 'videos_list_type';
        // 接收参数
        $data = $this->params;
        // 查询数据库
        $this->model -> videos_list_type($data['type']);
    }

    public function videos_type()
    {
        // 接收参数
        // 查询数据库
        $this->model->videos_type();
    }

    public function video_delete()
    {
        // 接收参数
        $data = $this->params;
        // 查询数据库
        $this->model->video_delete($data['id']);
    }

    public function videos_select()
    {
        // 接收参数
        // 查询数据库
        $this->model->videos_select();
    }

    public function video_edit()
    {
        // 接收参数
        $data = $this->params;
        // 查询数据库
        $this->model->video_edit($data);
    }
}
