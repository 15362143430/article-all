<?php
namespace app\api\model;

use think\File;

class Article extends Common
{
    public function articles_list($arr)
    {
        // echo $flag;
        switch ($arr['flag']) {
            case false:
                $res = db('article')->where('is_delete', 0)->order('id', 'desc')->limit(5)->select();
                break;

            case 'life':
                $res = db('article')->where(['type'=>'生活趣事','is_delete'=>0])->order('id', 'desc')->select();
                break;

            // case 'book':
            //     $res = db('article')->where(['type'=>'书籍推荐','is_delete'=>0])->order('id', 'desc')->select();
            //     break;

            case 'ms':
                $count = db('article')->where('is_delete', 0)->count();
                if ($arr['title'] !== false) {
                    $res = db('article')->where('is_delete', 0)->order('id')->where('title', 'like', '%'.$arr['title'].'%')->page($arr['pageNum'], $arr['pageSize'])->select();
                    $count = db('article')->where('is_delete', 0)->order('id')->where('title', 'like', '%'.$arr['title'].'%')->page($arr['pageNum'], $arr['pageSize'])->count();
                } else {
                    $res = db('article')->where('is_delete', 0)->order('id')->page($arr['pageNum'], $arr['pageSize'])->select();
                }
                $this->retrieve_return_list($res, $count, '查询成功', '查询失败');
                break;
            
            default:
                $res = db('article')->where('type', $arr['flag'])->where('is_delete', 0)->order('id', 'desc')->select();
                break;
        }
        $count_tec = db('article')->where('type', 'not in', '生活趣事')->where('is_delete', 0)->count();
        $count_life = db('article')->where('type', 'in', '生活趣事')->where('is_delete', 0)->count();
        $count = ['tec'=>$count_tec,'life'=>$count_life];
        $data['count'] = $count;
        $this->retrieve_return_list($res, $count);
    }

    public function article_detail($id)
    {
        $res = db('article')->where('id', $id)->find();
        $this->retrieve_return($res, '查询成功', '查询失败');
    }

    public function article_content($id)
    {
        // $file = ROOT_PATH.'public'.DS.'articles'.DS.$id.'.md';
        $res = db('article')->where('id', $id)->field('md_path')->find();
        // dump($res);die;
        if ($res) {
            try {
                $file = file_get_contents(ROOT_PATH.'public'.$res['md_path']);
                if ($file) {
                    $this->return_msg(200, '获取文章内容成功', $file);
                } else {
                    $this->return_msg(404, '获取文章内容失败');
                }
            } catch (\Throwable $th) {
                $this->return_msg(404, '获取文章内容失败');
            }
        } else {
            $this->return_msg(404, '获取文章内容失败');
        }
    }

    public function articles_select()
    {
        $res = db('article')->field('type')->group('type')->select();
        $this->retrieve_return($res, '查询成功', '查询失败');
    }

    public function article_add($arr)
    {
        $arr['md_path'] = $this->upload_md($arr['article_md']);
        unset($arr['article_md']);
        $arr['img_path'] = $this->img_path_arr[$arr['type']];
        $arr['addtime'] = date('Y-m-d H:i:s', time());
        $res = db('article')->insert($arr);
        if ($res) {
            $this->return_msg(200, '添加文章成功');
        } else {
            $this->return_msg(422, '添加文章失败');
        }
    }

    public function article_edit($arr)
    {
        $res = db('article')->where('id', $arr['id'])->update($arr);
        if ($res !== false) {
            $this->return_msg(200, '修改文章成功');
        } else {
            $this->return_msg(422, '修改文章失败');
        }
    }

    public function articles_type()
    {
        $res = db('article')->where('is_delete', 0)
                           ->field('type as name,count(*) as value')
                           ->group('type')
                           ->select();
        $this->retrieve_return($res, '查询成功', '查询失败');
    }

    public function article_delete($id)
    {
        $res = db('article')->where('id', $id)->setField('is_delete', 1);
        $this->retrieve_return($res, '删除成功', '删除失败');
    }
}
