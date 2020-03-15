<?php
namespace app\api\controller;

class Menu extends Common
{
    public function menus_list(){
        // echo 'menus_list';
        // 接收参数
        $data = $this->params;
        $level = isset($data['level'])?$data['level']:0;
        // 查询数据库
        $model = model('Menu');
        $model->menus_list($level);
    }
}