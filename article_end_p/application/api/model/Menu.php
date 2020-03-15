<?php
namespace app\api\model;

class Menu extends Common
{
    public function menus_list($level){
        switch ($level) {
            case 0:
                $res = db('menus')->where('is_delete', 0)->order('id')->select();
                break;
            case '1':
                $res = db('menus')->where(['level'=>1,'is_delete'=>0])->order('id')->select();
                break;
            case '2':
                $res = db('menus')->where(['level'=>['in','1,2'],'is_delete'=>['=',0]])->order('id')->select();
                break;
            case '3':
                $res = db('menus')->where('is_delete', 0)->order('id')->select();
                break;
            
        }
        $this->retrieve_return($res,'查询成功','查询失败');
    }
}