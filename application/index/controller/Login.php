<?php
namespace app\index\controller;

use think\View;
use think\Db;
use think\Controller;
use think\Request;

class Login extends Controller
{
    public function index(){
        //加载登录页面
        return view();
    }

    
    //处理登录的提交页面

    public function login(){
        $data = input('post.');
        //dump($data);
        $code = Db::execute("select * from client where nam = ? and PSW = ?",[$data['name'],$data['pass']]);
        //echo Db::getLastSql()."<hr>";
        if ($code) {
            $this->success("登录成功",'/sale/index/id/'.$data['name']);
        }
        else{
            $code = Db::execute("select * from client where nam = ?",[$data['name']]);
            //dump($code);
            if ($code) {
                $info ='密码错误';
            }
            else{
                $info ='账号不存在';
            }
            $this->error($info);  
            //return view(url('index')); 
            //return $info; 
            //$this->error($info);     
        }
        
        
    }

    public function register(){

        //echo "this is good";
        return view();

    }

    public function save(){

        $data = input("post.");
        // echo "这是data的内容：";
        // dump($data);
        $repeat = Db::execute("select * from client where nam = ?",[$data['name']]);

        //echo Db::getLastSql();
        if (!$repeat) {
            $code = Db::execute("insert into client value(null,?,?,?)",[$data['name'],$data['password'],$data['tel']]);
            if ($code) {
                $this->success("注册成功",'/Login');
            }
            else{
                $this ->error("注册失败");
            }
        }
        else{
            $this->error("用户名重复");
        }
    }
}