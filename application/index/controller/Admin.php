<?php
    namespace app\index\controller;

    use think\Db;

    class Admin
    {
        public function index(){
            //查询数据
                //table
                    //查询所有数据
                    $data = Db::table("client")->select();
                    //查询一条数据
                    $data = Db::table("client")->find();

                //name---name会添加config文件中的表前缀
                    //查询所有数据
                    $data = Db::name("client")->select();
                    //查询一条数据
                    $data = Db::name("client")->find();

                //Db函数-助手函数查询
                    //查询所有数据
                    $data = db("client")->select();
                    //查询一条数据
                    $data = db("client")->find();



                echo Db::getLastSql();

                dump($data);
        }
    }