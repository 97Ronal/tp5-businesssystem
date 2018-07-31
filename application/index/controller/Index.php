<?php
namespace app\index\controller;

use app\index\controller\User;

use \app\admin\controller\Index as AdminIndex;

//引入系统数据类
use think\Db;
//引入系统控制器类
use think\Controller;


class Index extends Controller
{
    public function index()
    {
        //return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="ad_bd568ce7058a1091"></think>';
    
        $data = Db::table('client')->select();

        //var_dump($data);

        //分配数据给页面
        $this->assign('data',$data);

        return view();
    
    
    }
    public function test(){
        return "这是我创建的test方法";
    }



    public function modelCall(){
        //调用其他模块
        $model = new \app\index\controller\User;

        echo $model ->index();

        echo "<br>";

        //使用use

        $model = new User;

        echo $model ->index();

        //使用系统方法
        
        echo "<br>";

        $model = controller('User');

        echo $model ->index();

    }
    public function adminCall(){
        //使用命名空间

        $model = new \app\admin\controller\Index;

        echo $model ->index();

        echo "<br>";

        $model = new AdminIndex();

        echo $model ->index();

        echo "<br>";

        $model = controller('admin/Index');

        echo $model ->index();

        echo "<br>";

        //调用当前控制器中的方法

        
    }
    public function innerCall (){
        //return "这句话是正确的";
        //调用当前控制器中的方法
        echo $this ->test();
        
        echo "<hr>";

        echo self::test();
        
        echo "<hr>";

        echo Index::test();
        
        echo "<hr>";

        //使用系统方法
        echo action('test');
    }

    //路由相关
    public function course(){
        echo input('id');
    }
    //带多个参数
    public function time1(){
        echo input('year').' '.input('month');
    }

    //完全匹配
    public function test1(){
        echo "这里是完全匹配方法的test1";
    }

    //带额外参数
    public function test2(){
        echo 'id='.input('id').' name='.input('name');
    }

}
