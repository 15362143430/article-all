<?php
namespace app\api\model;

class Power extends Common
{
    public function rights_list($arr)
    {
        $count = db('menus')->where('is_delete', 0)->count();
        $res = db('menus')->where('is_delete', 0)
                          ->page($arr['pageNum'], $arr['pageSize'])
                          ->select();
        $this->retrieve_return_list($res, $count);
    }

    public function roles_list()
    {
        $role_res = db('role')->where('is_delete', 0)->select();
        $right_one_two = db('menus')->where(['level'=>['not in','3'],'is_delete'=>['=',0]])
                                    ->select();
        $join_m_p = [['menus m','m.id=p.operation_id']];
        $field = ['m.*'];
        if ($role_res && $right_one_two) {
            foreach ($role_res as $key => $value) {
                $right_three = db('power')->alias('p')
                                          ->join($join_m_p)
                                          ->field($field)
                                          ->where(['p.role_id'=>$role_res[$key]['id'],'m.level'=>3,'m.is_delete'=>0,'p.is_delete'=>0])
                                          ->select();
                $role_res[$key]['children'] = array_merge($right_one_two, $right_three);
            }
            $this->return_msg(200, '查询角色列表成功', $role_res);
        } else {
            $this->return_msg(404, '查询角色列表失败');
        }
    }

    public function role_edit($arr)
    {
        $res = db('role')->where('id', $arr['id'])->update($arr);
        if ($res !== false) {
            $this->return_msg(200, '编辑成功');
        } else {
            $this->return_msg(422, '编辑失败');
        }
    }

    public function role_detail($arr)
    {
        $res = db('role')->field('role_name,role_remark')->where('id', $arr['id'])->find();
        $this->retrieve_return($res, '查询成功', '查询失败');
    }

    public function roles_select()
    {
        $res = db('role')->field('role_name,id')->select();
        $this->retrieve_return($res, '查询成功', '查询失败');
    }

    public function right_edit($arr)
    {
        $res_in = db('power')->where(['role_id'=>['=',$arr['id']],'operation_id'=>['in',$arr['right_arr']]])->setField('is_delete', 0);
        $res_notin = db('power')->where(['role_id'=>['=',$arr['id']],'operation_id'=>['not in',$arr['right_arr']]])->setField('is_delete', 1);
        if ($res_in !== false && $res_notin !== false) {
            $this->return_msg(200, '编辑成功');
        } else {
            $this->return_msg(422, '编辑失败');
        }
    }

    public function right_delete($arr)
    {
        $res = db('power')->where(['role_id'=>$arr['role_id'],'operation_id'=>$arr['operation_id']])
                          ->setField('is_delete', 1);
        if ($res !== false) {
            $this->return_msg(200, '编辑成功');
        } else {
            $this->return_msg(422, '编辑失败');
        }
    }

    public function role_add($arr)
    {
        $insert_arr = [
            'role_name' => $arr['role_name'],
            'role_remark'=> $arr['role_remark']
        ];
        $res_id = db('role')->insertGetId($insert_arr);
        $res_right = db('menus')->where('level',3)
                                ->field('id')
                                ->select();
        $insert_power = [];
        for($i=0;$i<count($res_right);$i++){
            $insert_power[$i] = [
                'role_id' => $res_id,
                'operation_id' => $res_right[$i]['id']
            ];
        }
        // $this->return_msg(200,'',$insert_power);die;
        $res = db('power')->insertAll($insert_power);
        if ($res) {
            $res_in = db('power')->where(['role_id'=>['=',$res_id],'operation_id'=>['not in',$arr['right_arr']]])->setField('is_delete', 1);
            if($res_in){
                $this->return_msg(200,'添加成功');
            }else{
                $this->return_msg(422,'添加失败');
            }
        }else{
            $this->return_msg(422,'添加失败');
        }
    }
}
