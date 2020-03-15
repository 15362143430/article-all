<?php
namespace app\api\model;

class Video extends Common
{
    public function videos_list()
    {
        $res_htmlcss = db('videos')->where('type', 'HTML/CSS')->select();
        $res_js = db('videos')->where('type', 'JavaScript')->select();
        $res_vue = db('videos')->where('type', 'Vue')->select();
        $res_node = db('videos')->where('type', 'Nodejs')->select();
        if ($res_htmlcss && $res_js && $res_vue && $res_node) {
            $res_videos = ['HC'=>$res_htmlcss,'J'=>$res_js,'V'=>$res_vue,'N'=>$res_node];
            $this->return_msg(200, '查询视频列表成功', $res_videos);
        } else {
            $this->return_msg(404, '获取视频列表失败');
        }
    }

    public function videos_list_ms($arr)
    {
        $count = db('videos')->where('is_delete', 0)->count();
        $res = db('videos')->where('is_delete', 0)
                           ->page($arr['pageNum'], $arr['pageSize'])
                           ->select();
        $this->retrieve_return_list($res, $count);
    }

    public function video_detail($id)
    {
        $res = db('videos')->where('id', $id)->find();
        $this->retrieve_return($res, '查询成功', '查询失败');
    }

    public function videos_list_type($type)
    {
        $res = db('videos')->where('type', $type)->limit(5)->select();
        $this->retrieve_return($res, '查询成功', '查询失败');
    }

    public function videos_type()
    {
        $res = db('videos')->where('is_delete', 0)
                           ->field('type,count(*) as total')
                           ->group('type')
                           ->select();
        $this->retrieve_return($res, '查询成功', '查询失败');
    }

    public function video_delete($id)
    {
        $res = db('videos')->where('id', $id)->setField('is_delete', 1);
        $this->retrieve_return($res, '删除成功', '删除失败');
    }

    public function videos_select()
    {
        $res = db('videos')->field('type')->group('type')->select();
        $this->retrieve_return($res, '查询成功', '查询失败');
    }

    public function video_edit($arr)
    {
        $res = db('videos')->where('id', $arr['id'])->update($arr);
        if ($res !== false) {
            $this->return_msg(200, '修改文章成功');
        } else {
            $this->return_msg(422, '修改文章失败');
        }
    }
}
