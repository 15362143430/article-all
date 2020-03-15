<?php
namespace app\api\controller;

class Power extends Common
{
    protected $model;

    protected function _initialize()
    {
        parent::_initialize();
        $this->model = model('Power');
    }

    public function rights_list()
    {
        // echo 'right_list';
        // 接收参数
        $data = $this->params;
        // 查询数据库
        $this->model->rights_list($data);
    }

    public function roles_list()
    {
        // echo 'roles_list';
        // 接收参数
        // 查询数据库
        $this->model->roles_list();
    }

    public function role_edit()
    {
        // 接收参数
        $data = $this->params;
        // 查询数据库
        $this->model->role_edit($data);
    }

    public function role_detail()
    {
        // 接收参数
        $data = $this->params;
        // 查询数据库
        $this->model->role_detail($data);
    }

    public function roles_select()
    {
        // 接收参数
        // 查询数据库
        $this->model->roles_select();
    }

    public function right_edit()
    {
        // 接收参数
        $data = $this->params;
        // 查询数据库
        $this->model->right_edit($data);
    }

    public function right_delete()
    {
        // 接收参数
        $data = $this->params;
        // 查询数据库
        $this->model->right_delete($data);
    }

    public function role_add(){
        // 接收参数
        $data = $this->params;
        // 查询数据库
        $this->model->role_add($data);
    }
}
