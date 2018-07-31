<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;
use think\View;

class Sale extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index($id)
    {   
        $this ->assign("name",$id);
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
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //

        //dump(input('post.'));
        $data = input('post.');
        $data['number'] = intval($data['number']);
        //echo $data['number'];
        //dump($data);
        //$code = Db::execute("select * from orders;");
        //echo Db::getLastSql();
        $code = Db::execute("INSERT INTO orders VALUES (NULL,'".$data['parts']."','".$data['car']."','".$data['name']."','".$data['tel']."','".$data['bank']."','".$data['card_id']."','".$data['date']."','".$data['sex']."','".$data['remarks']."',".$data['number'].");");
        if ($code) {
            $this->success("添加成功",url('iframe/fill_form'));
        }
        else{
            $this->error("添加失败",url('iframe/fill_form'));            
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
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(request $request,$id=0)
    {
        //
        //echo "1";
        $data = input('post.');        
        $data = Request::instance()->except('_method');    

        $data['number'] = intval($data['number']);
        //dump($data['number']);
        $data['id'] = intval($data['id']);
        //echo $data['number'];
        //dump($data);
        //$code = Db::execute("select * from orders;");
        echo Db::getLastSql();        
        //dump($data);

        $code = Db::execute("UPDATE orders SET parts = :parts,car = :car,name =:name,tel = :tel,bank = :bank,card_id = :card_id,date = :date,sex =:sex,remark =:remarks,number= :number where id =:id;",$data);
        
         if ($code) {
            $this->success("添加成功",url('iframe/form_manage'));
        }
        else{
            $this->error("修改失败",url('iframe/form_edit'));            
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id=0)
    {
        //
        $code=Db::execute("delete from orders where id = $id");
        //echo Db::getLastSql();        
        if ($code) {
            $this->success("删除成功",url('iframe/form_manage'));
        }
        else{
            $this->error("删除失败",url('iframe/form_manage'));
        }
    }

    public function search($date_min,$date_max,$id,$name,$car){
        $od = 0;
        function checkSql($str,$sql){
            global $od;
            if ($str=="this_is_not_define") {
               return "";
            }
            else if($od==0){
                $od++;
                return " where ".$sql;
            }else{return " and ".$sql;}
        }
        $dateminSql = "date >= '$date_min'";
        $datemaxSql = "date <= '$date_max'";
        $idSql = "id = '$id'";
        $nameSql = "name like '%$name%'";
        $carSql = "car like '%$car%'";

        //dump(input('post.'));
        $sql = "select * from orders".checkSql($date_min,$dateminSql).checkSql($date_max,$datemaxSql).checkSql($id,$idSql).checkSql($name,$nameSql).checkSql($car,$carSql);
        //echo $sql;
        $data = Db::query($sql);
        //dump($data);
        $len = count($data);
        //return $data;
        $returnData=[
            "code"=> 0 ,
            "msg"=>"",
            "count"=> $len,
            "data"=>$data
        ];
        //dump($data);
        return json($returnData);

    }

    public function addParts(){
        $data = input('post.');
        //dump($data);        
        //$data = $data->only(['car','parts']);    
        // echo Db::getLastSql();
        $sql = "SELECT * FROM parts WHERE car = '".$data['car']."' AND partsname ='".$data['parts']."';";
        //echo $sql;
        $code = Db::execute($sql);// '
        //echo Db::getLastSql();
        if ($code) {
            $data1 = Db::query($sql)[0];
            $storage = $data1['storage']+intval($data['storage']);
            dump($data);
            $code1 = Db::execute("UPDATE parts SET storage = $storage WHERE car = '".$data['car']."' AND partsname ='".$data['parts']."';");
            if ($code1) {
                $this->success('添加库存成功');
            }
            else{
                $this->error('添加库存失败');
            }
        }
        else{
            $data['storage'] = intval($data['storage']);
            $data['price'] = intval($data['price']);
            $sql2 = "INSERT INTO parts VALUE('".$data['parts']."',NULL,".$data['storage'].",'".$data['car']."',".$data['price'].");";
            $code2 = Db::execute($sql2);
            echo Db::getLastSql();

            dump($data);
            if ($code2) {
                # code...               
                $this->success('添加商品成功');
            }
            else{
                $this->error('添加商品失败');
            }
            
        }
        
    }
    public function searchParts($price_min,$price_max,$id,$car,$partsname){
        $od = 0;
        function checkSql($str,$sql){
            global $od;
            if ($str=="this_is_not_define") {
               return "";
            }
            else if($od==0){
                $od++;
                return " where ".$sql;
            }else{return " and ".$sql;}
        }
        $priceminSql = "price >= '$price_min'";
        $pricemaxSql = "price <= '$price_max'";
        $idSql = "id = '$id'";
        $partsnameSql = "partsname like '%$partsname%'";
        $carSql = "car like '%$car%'";

        //dump(input('post.'));
        $sql = "select * from parts".checkSql($price_min,$priceminSql).checkSql($price_max,$pricemaxSql).checkSql($id,$idSql).checkSql($partsname,$partsnameSql).checkSql($car,$carSql);
        //echo $sql;
        $data = Db::query($sql);
        //dump($data);
        $len = count($data);
        //return $data;
        $returnData=[
            "code"=> 0 ,
            "msg"=>"",
            "count"=> $len,
            "data"=>$data
        ];
        //dump($data);
        return json($returnData);

    }

    public function editParts(request $request,$id){

        $data = input('post.');        
        $data = Request::instance()->except('_method');    

        $data['storage'] = intval($data['storage']);
        $data['price'] = intval($data['price']);

        //dump($data['number']);
        $data['id'] = intval($data['id']);
        //echo $data['number'];
        //dump($data);
        //$code = Db::execute("select * from orders;");
        //echo Db::getLastSql();        
        //dump($data);

        $code = Db::execute("UPDATE parts SET partsname = :partsname,car = :car,storage= :storage,price= :price where id =:id;",$data);
        
         if ($code) {
            $this->success("修改成功",url('iframe/search_parts'));
        }
        else{
            $this->error("修改失败",url('iframe/parts_edit'));            
        }

    }

    public function addOutorder(){
        $data = input('post.');

        //$data['parts_id'] = intval($data['parts_id']);
        $data['number'] = intval($data['number']);
        $data['order_id'] = intval($data['order_id']);
        //dump($data);
        $orderId = $data['order_id'];
        //$partsId = $data['parts_id'];
        $code = Db::query("SELECT * FROM orders WHERE id = $orderId");
        if($code){
            $part_name = array_column($code, 'parts')[0];
            $order_name = array_column($code, 'name')[0];
            $part_car = array_column($code, 'car')[0];
            $order_number = array_column($code, 'number')[0];
            //dump($part_car);
            //dump($order_name);
            //dump($part_name);
            $part_data = Db::query("SELECT * FROM parts WHERE partsname = '$part_name' AND car = '$part_car'");
            $part_id = array_column($part_data, 'id')[0];
            $part_storage =intval(array_column($part_data, 'storage')[0]);
            if ($data['number']>$order_number) {
                $this -> error("出货量大于订单需求！");
                // $data['number'] = $order_number;
                // $storage = $part_storage - $data['number']; 
                // //dump($storage);
                // //dump( $data['number']);
                // $code = Db::execute("UPDATE parts SET storage = $storage WHERE id = $part_id;");
                // $code = Db::execute("UPDATE orders SET statu = '已完成', number = 0 WHERE id = ".$data['order_id'].";");

            }else if ($data['number']>$part_storage) {
                $this -> error("出货量超出库存！");

                // $data['number'] = $order_number;
                // $storage = $part_storage - $data['number'];
                // //dump($storage);
                // //dump( $data['number']);
                // $code = Db::execute("UPDATE parts SET storage = $storage WHERE id = $part_id;");
                // $code = Db::execute("UPDATE orders SET statu = '已完成', number = 0 WHERE id = ".$data['order_id'].";");

            }
            else{
                $storage = $part_storage - $data['number'];
                $code = Db::execute("UPDATE parts SET storage = $storage WHERE id = $part_id;");
                $order_number = $order_number - $data['number'];
                $code = Db::execute("UPDATE orders SET number = $order_number WHERE id =  ".$data['order_id'].";");
                if ($order_number == 0){
                    $code = Db::execute("UPDATE orders SET statu = '已完成' WHERE id = ".$data['order_id'].";");
               }
               $this->success("成功出库");
            }
            //dump($part_id);
            $code1 = Db::execute("INSERT INTO out_orders VALUES (NULL,$part_id,'$part_name',".$data['number'].",".$data['order_id'].",'".$data['date']."','$order_name');");
            //echo Db::getLastSql();
        }
        else{
            $info = "订单号填写错误";
            $this ->assign("info",$info);
            return view('../../../iframe/add_outorder');
        }
    }

    public function searchOutorder($date_min,$date_max,$id,$order_id,$parts_name){
        $od = 0;
        function checkSql($str,$sql){
            global $od;
            if ($str=="this_is_not_define") {
               return "";
            }
            else if($od==0){
                $od++;
                return " where ".$sql;
            }else{return " and ".$sql;}
        }
        $dateminSql = "date >= '$date_min'";
        $datemaxSql = "date <= '$date_max'";
        $idSql = "id = '$id'";
        $parts_nameSql = "parts_name like '%$parts_name%'";
        $order_idSql = "order_id like '%$order_id%'";

        //dump(input('post.'));
        $sql = "select * from out_orders".checkSql($date_min,$dateminSql).checkSql($date_max,$datemaxSql).checkSql($id,$idSql).checkSql($parts_name,$parts_nameSql).checkSql($order_id,$order_idSql);
        //echo $sql;
        $data = Db::query($sql);
        //dump($data);
        $len = count($data);
        //return $data;
        $returnData=[
            "code"=> 0 ,
            "msg"=>"",
            "count"=> $len,
            "data"=>$data
        ];
        //dump($data);
        return json($returnData);

    }
    public function selectParts($car){
        dump(input('post.'));
        $data = [
            "code"=> 0 ,
            "msg"=>$car,
            "count"=> "1",
            "data"=>"1"
        ];
        return json($data);

    }

    public function addInorder(){
        $data = input('post.');
        $data['number'] = intval($data['number']);
        //dump($data);
        

        $code = Db::execute("SELECT * FROM parts where car = '".$data['car']."'and partsname = '".$data['parts']."'");

        //echo Db::getLastSql();
        if ($code){        
            $part_data = Db::query("SELECT * FROM parts where car = '".$data['car']."'and partsname = '".$data['parts']."'")[0];
            $storage = $part_data['storage']+$data['number'];
            $code1 = Db::execute("UPDATE parts SET storage = $storage where id = ".$part_data['id']);
            $code2 = Db::execute("INSERT INTO in_orders VALUES(NULL,:parts,:car,:number,:date,:server)",$data);
            if($code2){
                $this->success("添加成功");
            }
            else{
                $this->error("添加失败");
            }
        }
        else{
            $this->error("库中不存在该商品，请先添加商品在入库！");
        }        
    }

    public function searchInorder($date_min,$date_max,$id,$server,$parts){
        $od = 0;
        function checkSql($str,$sql){
            global $od;
            if ($str=="this_is_not_define") {
               return "";
            }
            else if($od==0){
                $od++;
                return " where ".$sql;
            }else{return " and ".$sql;}
        }
        $dateminSql = "date >= '$date_min'";
        $datemaxSql = "date <= '$date_max'";
        $idSql = "id = '$id'";
        $partsSql = "parts like '%$parts%'";
        $serverSql = "server like '%$server%'";

        //dump(input('post.'));
        $sql = "select * from in_orders".checkSql($date_min,$dateminSql).checkSql($date_max,$datemaxSql).checkSql($id,$idSql).checkSql($parts,$partsSql).checkSql($server,$serverSql);
        //echo $sql;
        $data = Db::query($sql);
        //dump($data);
        $len = count($data);
        //return $data;
        $returnData=[
            "code"=> 0 ,
            "msg"=>"",
            "count"=> $len,
            "data"=>$data
        ];
        //dump($data);
        return json($returnData);

    }

    
}
