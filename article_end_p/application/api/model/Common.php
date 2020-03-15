<?php
namespace app\api\model;

use think\Model;
use think\Db;

class Common extends Model
{
    protected $img_path_arr = [
        'HTML' => 'http://47.100.137.31/img/html2.png',
        'CSS' => 'http://47.100.137.31/img/css2.png',
        'JavaScript' => 'http://47.100.137.31/img/javascript2.png',
        'Vue' => 'http://47.100.137.31/img/vue2.png',
        'Nodejs' => 'http://47.100.137.31/img/nodejs2.png',
        'life' => 'http://47.100.137.31/img/life2.png',
        '生活趣事' => 'http://47.100.137.31/img/life2.png',
        'PHP' => 'http://47.100.137.31/img/php2.png',
        'Linux' => 'http://47.100.137.31/img/linux2.png'
    ];

    public function return_msg($status, $msg = '', $data = [])
    {
        $return_data = ['data' => $data, 'meta' => ['msg' => $msg, 'status' => $status]];
        echo json_encode($return_data, JSON_UNESCAPED_UNICODE);
        die; //一定要die哦
    }

    public function retrieve_return($res, $msg_success, $msg_error)
    {
        if ($res) {
            $this->return_msg(200, $msg_success, $res);
        } else {
            $this->return_msg(404, $msg_error);
        }
    }

    public function retrieve_return_list($res, $count)
    {
        if ($res) {
            $data['list'] = $res;
            $data['total'] = $count;
            $this->return_msg(200, '查询成功', $data);
        } else {
            $this->return_msg(404, '查询失败');
        }
    }

    public function upload_md($file)
    {
        // 保存
        $info = $file->move(ROOT_PATH.'public'.DS.'uploads'.DS.'articles');
        if ($info) {
            $path = '\uploads\\articles\\'.$info->getSaveName();//ROOT_PATH.'/public'.
            return str_replace('\\', '/', $path);
        // $file = file_get_contents($path);
            // $this->return_msg(200,'',$file);
        } else {
            $this->return_msg(400, $file->getError());
        }
    }

}
