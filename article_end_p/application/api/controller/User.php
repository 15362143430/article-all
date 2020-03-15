<?php
namespace app\api\controller;

class User extends Common
{
    protected $model;

    protected function _initialize()
    {
        parent::_initialize();
        $this->model = model('User');
    }

    public function login()
    {
        // 接收参数
        $data = $this->params;
        // 判断账号是否存在
        $this->check_exist($data['username'], 1);
        // 查询数据库
        $this->model->login($data);
    }

    public function register()
    {
        // 接收参数
        $data = $this->params;
        // 判断账号是否存在
        $this->check_exist($data['email'], 0);
        $data['avator'] = $this->upload_image($data['avator']);
        // 查询数据库
        $this->model->register($data);
    }

    public function users_list()
    {
        // echo 'users_list';
        // 接收参数
        $data = $this->params;
        $data['name'] = isset($data['name'])?$data['name']:false;
        // 查询数据库
        $this->model -> users_list($data);
    }

    public function user_position()
    {
        // 接收参数
        $data = $this->params;
        // 查询数据库
        $this->model -> user_position($data);
    }

    public function user_delete()
    {
        // echo 'user_delete';
        // 接收参数
        $data = $this->params;
        // 查询数据库
        $this->model->user_delete($data['id']);
    }

    public function user_detail()
    {
        // 接收参数
        $data = $this->params;
        // 查询数据库
        $this->model->user_detail($data);
    }

    public function user_edit()
    {
        // 接收参数
        $data = $this->params;
        // 查询数据库
        $this->model->user_edit($data);
    }
}
