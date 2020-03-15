<?php
namespace app\api\model;

use think\Cache;

class User extends Common
{
    public function login($arr)
    {
        $res = db('user')->where('email', $arr['username'])->value('password');
        switch ($res) {
            case true:
                if (md5($arr['password']) === $res) {
                    $res = db('user')->alias('u')
                                     ->join('role r', 'r.id=u.role_id')
                                     ->field('name,position,role_id,email,r.role_name,avator')
                                     ->where('email', $arr['username'])
                                     ->find();
                    $user_token = time().$arr["password"];
                    $redis_token = Cache::set($arr["username"]."_token", md5($user_token), 3600);
                    if ($redis_token) {
                        $res["token"] = Cache::get($arr["username"]."_token");
                        $res['avator'] = str_replace("\\", "/", ROOT_PATH."public".$res['avator']);
                        $this->return_msg(200, "登录成功", $res);
                    } else {
                        $this->return_msg(500, "服务器炸了");
                    }
                } else {
                    $this->return_msg(401, "密码错误");
                }
                break;
            
            default:
                $this->return_msg(404, '登录失败');
                break;
        }
    }

    public function register($arr)
    {
        $arr['password'] = md5($arr['password']);
        $res = db('user')->insert($arr);
        $this->retrieve_return($res, '注册成功', '注册失败');
    }

    public function users_list($arr)
    {
        $where_count = $arr['name'] === false?['is_delete'=>0]:['is_delete'=>['=',0],'name'=>['like','%'.$arr['name'].'%']];
        $where_res = $arr['name'] === false?['u.is_delete'=>0]:['u.is_delete'=>0,'u.name'=>['like','%'.$arr['name'].'%']];
        
           
        $count = db('user')->where($where_count)->count();
        $res = db('user')->alias('u')
                                 ->join([['role r','r.id=u.role_id']])
                                 ->field('u.id,u.name,u.email,u.addtime,u.position')
                                 ->field('r.role_name')
                                 ->where($where_res)
                                 ->page($arr['pageNum'], $arr['pageSize'])
                                 ->select();
        
        $this->retrieve_return_list($res, $count);
    }

    public function user_position($arr)
    {
        $count = db('user')->group('position')->count();
        $res = db('user')->field('position,count(*) as total')->group('position')->page($arr['pageNum'], $arr['pageSize'])->select();
        $this->retrieve_return_list($res, $count);
    }

    public function user_delete($id)
    {
        $res = db('user')->where('id', $id)->setField('is_delete', 1);
        $this->retrieve_return($res, '删除成功', '删除失败');
    }

    public function user_detail($arr)
    {
        $res = db('user')->alias('u')
                         ->join('role r', 'r.id=u.role_id')
                         ->field('u.name,u.position,u.role_id')
                         ->where('u.id', $arr['id'])->find();
        $this->retrieve_return($res, '查询成功', '查询失败');
    }

    public function user_edit($arr)
    {
        $res = db('user')->where('id', $arr['id'])->update($arr);
        if ($res !== false) {
            $this->return_msg(200, '编辑成功');
        } else {
            $this->return_msg(422, '编辑失败');
        }
    }
}
