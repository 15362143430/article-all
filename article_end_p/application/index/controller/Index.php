<?php
namespace app\index\controller;

use think\Request;
use think\Db;//数据库时用到
use think\Controller;//view层用到

define('APP_PA', '这是自己定义的常量值');//常量不能跨模块传送

class Index extends Controller //想要view层注意要extends
{
    public function index()
    {
        // return '<style type='text/css'>*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: 'Century Gothic','Microsoft yahei'; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style='padding: 24px 48px;'> <h1>:)</h1><p> ThinkPHP V5<br/><span style='font-size:30px'>十年磨一剑 - 为API开发设计的高性能框架</span></p><span style='font-size:22px;'>[ V5.0 版本由 <a href='http://www.qiniu.com' target='qiniu'>七牛云</a> 独家赞助发布 ]</span></div><script type='text/javascript' src='http://tajs.qq.com/stats?sId=9347272' charset='UTF-8'></script><script type='text/javascript' src='http://ad.topthink.com/Public/static/client.js'></script><thinkad id='ad_bd568ce7058a1091'></thinkad>';
        // return '<h1>我真的帅啊</h1>';
        // $request = Request::instance();
        // dump($request);
        // echo '当前域名是'.$request->domain().PHP_EOL;
        // echo '当前入口文件是'.$request->baseFile().PHP_EOL;
        // echo $request->param('name').PHP_EOL;
        // echo $request->param('age').PHP_EOL;
        // dump($request->param());
        // $arr = ['ssd','sad'];
        // dump($arr);


        // View层操作
        // 第一种传参方法
        // $name = '来自controller层的name';
        // $age = '来自controller层的age';
        // $this->assign('name',$name);
        // $this->assign('age',$age);

        // return $this->fetch();//默认会函数名文件下的index.html
        // return $this->fetch('test');
        // return $this->fetch('toview/index');//跨模块

        // 第二种传参方法
        // return $this->fetch('',['name'=>'来自controller层的name','age'=>'来自controller层的age']);
        // return $this->fetch('test',['name'=>'来自controller层的name','age'=>'来自controller层的age']);
        // return $this->fetch('toview/index',['name'=>'来自controller层的name','age'=>'来自controller层的age']);

        // 第三种助手函数方式
        return view('', ['name'=>'来自controller层的name','age'=>'来自controller层的age']);
        // return view('test',['name'=>'来自controller层的name','age'=>'来自controller层的age']);
        // return view('toview/index',['name'=>'来自controller层的name','age'=>'来自controller层的age']);
    }



    // 原生增删改查方法
    // public function db(){

    //     //插入数据
    //     // $result = Db::execute('insert into topten (tel,count) value ('2323534534534',90)');

    //     //修改数据
    //     // $result = Db::execute('update topten set count='99999' where id=5');

    //     // 删除数据
    //     // $result = Db::execute('delete from topten where id=6');


    //     // 查询数据
    //     $result = Db::query('select * from topten');
    //     dump($result);
    // }

    // public function db(){

    //     // 插入数据
    //     // $result = Db::table('topten')->insert(['tel'=>'99999999','count'=>999999]);

    //     // 修改数据
    //     // $result = Db::table('topten')->where('id',2)->update(['tel'=>'898989998989','count'=>9999]);

    //     // 删除数据
    //     // $result = Db::table('topten')->where('id',3)->delete();

    //     // 查询数据
    //     // $result = Db::table('topten')->select();
    //     // $result = Db::table('topten')->where('tel','99999999')->select();
    //     // $result = Db::table('topten')->where('id','2')->select();
    //     // dump($result);
    // }

    // 增删改查的方法
    public function db()
    {
        // find只返回符合条件的第一个，一维数组
        // $result = Db::table('topten')->where('tel','99999999')->find();
        // select返回所有符合的，二维数组
        // $result = Db::table('topten')->where('tel','99999999')->select();

        // where的模糊查询，返回tel带有“机”的所有
        // $result = Db::table('topten')->where('tel','like','%机%')->select();
        // where的区间查询，返回id是1-8的所有
        // $result = Db::table('topten')->where('id','between',[1,8])->select();


        // 一次性插入多条数据
        // $data = [['tel'=>'asudhuasda','count'=>888],['tel'=>'asudhuasda','count'=>888]];
        // $result = Db::table('topten')->insertAll($data);

        // 修改数据
        // $result = Db::table('topten')->where('id','8')->setField('tel','超级无敌老人机');
        // 自增1
        // $result = Db::table('topten')->where('id','8')->setInc('count');
        // 自增5
        // $result = Db::table('topten')->where('id','8')->setInc('count',5);
        // 自减1
        // $result = Db::table('topten')->where('id','8')->setDec('count');
        // 自减5
        // $result = Db::table('topten')->where('id','8')->setDec('count',5);

        dump($result);
    }
}
