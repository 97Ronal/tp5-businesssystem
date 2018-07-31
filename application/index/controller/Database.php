<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;


class Database extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //

        //实例化系统数据库类
        
        $DB = new Db;

        //查询数据

        $data = $DB::table("client")->select();

        //dump($data);
        $this ->assign("data",$data);
     
        return view();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
        return view();

    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //接收到所有数据

        $data = input("post.");
        // echo "这是data的内容：";
        // dump($data);
        $code = Db::execute("insert into client value(null,?,?,?)",[$data['name'],$data['pass'],$data['tel']]);

        if ($code) {
            
            //跳转

            $this->success("添加成功",'/Database');
        }
        else{
            $this ->error();
        }
        
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //echo $id;
        $data = Db::query("select * from client where id = ?",[$id]);

        //dump($data);

        $this->assign("data",$data);

        //加载页面

        return view();
        
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
        //dump(input());
        $data = Request::instance()->except('_method');
        //dump($data);
        //执行数据库更新操作
        $code = Db::execute("update client set nam = :name ,PSW = :pass ,TELE = :tel where id=:id",$data);
        
        //echo Db::getLastSql();
        //判断是否成功
        if ($code) {
            $this->success("数据更新成功",url('index'));
            
        }
        else{
            $this->error("数据更新失败");
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //

        $code=Db::execute("delete from client where id = $id");

        if ($code) {
            $this->success("删除成功");
        }
        else{
            $this->error("删除失败");
        }
    }

    public function ajax_del(){
        //dump(input('post'));
        
        $id = input('post.id');
        $code=Db::execute("delete from client where id = $id");

        if ($code) {
            $data=[
                'statu'=>200,
                "info"=>'删除成功'
            ];
        }
        else{
            $data=[
                'statu'=>400,
                "info"=>'删除失败'
            ];
        }
        return $data;
        //echo $id;
        //dump(input());
    }
}
