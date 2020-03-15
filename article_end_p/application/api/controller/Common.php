<?php
namespace app\api\controller;

use think\Cache;
use think\Controller;
use think\Request;
use think\Validate;//验证
use think\Db;
use think\Image;

class Common extends Controller
{
    protected $request; //用来处理参数
    protected $validate; //用来验证数据/参数
    protected $params; //过滤后符合要求的参数
    protected $rules = [
        'Common' => [
            'database_count' => [

            ]
        ],
        'User' => [
            'users_list' => [
                'pageNum' => 'require|number',
                'pageSize' => 'require|number'
            ],
            'user_position' => [
                'pageNum' => 'require|number',
                'pageSize' => 'require|number'
            ],
            'user_delete' => [
                'id' => 'require|number'
            ],
            'user_edit' => [
                'id' => 'require|number',
                'name' => 'require',
                'position' => 'require|alpha',
                'role_id' => 'require|number'
            ],
            'login' => [
                'username' => 'require|email',
                'password' => 'require'
            ],
            'register' => [
                'email' => 'require|email',
                'name' => 'require|chsDash|max:6',
                'password' => 'require|alphaNum',
                'avator' => 'require|image'
            ],
            'user_detail' => [
                'id' => 'require|number'
            ]
        ],
        'Article' => [
            'articles_list' => [
                'pageNum' => 'number|require',
                'pageSize' => 'number|require'
            ],
            'article_detail' => [
                'id' => 'require|number'
            ],
            'article_content' => [
                'id' => 'require|number'
            ],
            'article_add' => [
                'title' => 'require',
                'type' => 'require',
                'author' => 'require|chsDash|max:6',
                'article_md' => 'require|fileExt:md'
            ],
            'article_edit' => [
                'id' => 'require|number',
                'title' => 'require|chsDash',
                'type' => 'require',
                'author' => 'require|chsDash|max:6'
            ],
            'articles_select' => [

            ],
            'articles_type' => [

            ],
            'article_delete' => [
                'id' => 'require|number'
            ]
            ],
        'Video' => [
            'videos_list' => [
                
            ],
            'videos_list_ms' => [
                'pageNum' => 'require|number',
                'pageSize' => 'require|number'
            ],
            'video_detail' => [
                'id' => 'require|number'
            ],
            'videos_list_type'=>[
                'type' => 'require'
            ],
            'videos_type' => [

            ],
            'video_delete' => [
                'id' => 'require|number'
            ],
            'videos_select' => [

            ],
            'video_edit' => [
                'id' => 'require|number',
                'title' => 'require|chsDash',
                'type' => 'require',
                'author' => 'require|chsDash|max:6'
            ]
            ],
        'Menu' => [
            'menus_list' => [
                'level' => 'number'
            ]
            ],
        'Power' => [
            'rights_list' => [
                'pageNum' => 'require|number',
                'pageSize' => 'require|number'
            ],
            'roles_list' => [

            ],
            'role_edit' => [
                'id' => 'require|number',
                'role_name' => 'require|chsDash',
                'role_remark' => 'require'
            ],
            'role_detail' => [
                'id' => 'require|number'
            ],
            'roles_select' => [

            ],
            'right_edit' => [
                'id' => 'require|number',
                'right_arr' => 'require|array'
            ],
            'right_delete' => [
                'role_id' =>'require|number',
                'operation_id' =>'require|number'
            ],
            'role_add' => [
                'role_name' => 'require|chsDash',
                'role_remark' => 'require',
                'right_arr' => 'require|array'
            ]
        ]
            ];

    protected function _initialize()
    {
        parent::_initialize();
        // $this->header = getallheaders();
        $this->request = Request::instance();
        //涉及到file上传走try，没有file则报错走catch
        try {
            $this->check_params($this->request->param(true));
        } catch (\Throwable $th) {
            // echo 'a';
            $this->check_params($this->request->param());
        }
        // $this->check_rights($this->params);
    }

    
    public function return_msg($status, $msg = '', $data = [])
    {
        $return_data = ['data' => $data, 'meta' => ['msg' => $msg, 'status' => $status]];
        echo json_encode($return_data, JSON_UNESCAPED_UNICODE);
        die; //一定要die哦
    }

    public function check_params($arr)
    {
        //规则，后面为调用的控制器和方法名称
        $rule = $this->rules[$this->request->controller()][$this->request->action()];
        // 验证规则并返回错误
        $this->validate = new Validate($rule);
        if (!$this->validate->check($arr)) {
            return $this->return_msg(400, $this->validate->getError());
        }
        $this->params = $arr;
    }

    // $exist是0表示注册，1表示登录
    public function check_exist($username, $exist)
    {
        $username_res = db("user")->where("email", $username)->find();
        switch ($exist) {
            case 0:
                if ($username_res) {
                    $this->return_msg(400, "此用户名已被占用");
                }
                break;
            case 1:
                if (!$username_res) {
                    $this->return_msg(400, "此用户名不存在");
                }
                break;
        }
    }

    public function upload_image($file, $type='avator')
    {
        // 保存
        $info = $file->move(ROOT_PATH."public".DS."uploads".DS.$type);
        // dump(ROOT_PATH."public".DS."uploads");die;
        if ($info) {
            $path = '\uploads\\'.$type.'\\'.$info->getSaveName();
            // dump($path);die;
            // 裁剪图片
            $this->image_edit($path, $type);
            return str_replace("\\", "/", $path);
        } else {
            $this->return_msg(400, $file->getError());
        }
    }

    // 裁剪方法
    public function image_edit($path, $type)
    {
        // dump(ROOT_PATH."public".$path);die;
        // 获取保存后的图片对象
        $image = Image::open(ROOT_PATH."public".$path);
        switch ($type) {
            case 'avator':
                // 裁剪后覆盖保存
                $image->thumb(200, 200, Image::THUMB_CENTER)->save(ROOT_PATH."public".$path);
                break;
            
        }
    }

    public function database_count()
    {
        $database = [
            'database_name' => [
                'api_role','api_user','api_menu','api_video','api_article','api_power'
            ],
            'database_count' => [
                
                $article = db('role')->count(),
                $article = db('user')->count(),
                
                
                $article = db('menus')->count(),
                $article = db('videos')->count(),
                $article = db('article')->count(),
                $article = db('power')->count()
            ]
            ];
        // $article = db('article')->count();
        // dump($article);
        $this->return_msg(200,'查询成功',$database);
    }
}
