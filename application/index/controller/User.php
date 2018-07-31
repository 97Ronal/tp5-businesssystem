<?php
//声明命名空间
namespace app\index\controller;

use think\View;

use think\ Controller;

//声明控制
class User extends Controller{
    //index方法
    public function index(){
        return "我是前台控制器中user的index方法";
    }
    
    //初始化方法
    //可以用来提取控制器下公共的方法-声明变量等
    //后台把控--将权限把控放在这之中
    public function _initialize(){
        echo "我是一个初始化方法";
    }

    public function jiazai(){

        //这个方法加载页面
        
        //实例化view类
        // $view = new \think\View;
        // return $view->fetch();

        //使用系统类
        // $view = new View();
        // return $view->fetch();
        // return $this->fetch();


        //使用系统函数
        //return view();
    }

    //数据输出
    public function shuchu(){
        //输出字符串
            //return "字符串";
        
        //输出数组

            $arr = array(
                'name'=> '肖昭颢',
                'age'=> '18'
                );

            return json_encode($arr);

        //返回一段html代码
                
                return "<h1>111111</h1>";
    }
}
?>