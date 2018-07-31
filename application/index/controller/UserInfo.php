<?php

namespace app\index\controller;

use think\Controller;

//声明控制器
class UserInfo extends Controller{
    //前置方法属性

    protected $beforeActionList =[
        'one'
    ];

    public function one(){
        echo "one <hr>";
    }

    public function two(){
        echo "two <hr>";
    }

    public function three(){
        echo "three <hr>";
    }
    //声明方法

    public function index(){
        return "我是Userinfo控制器下的Index方法。";
    }


}