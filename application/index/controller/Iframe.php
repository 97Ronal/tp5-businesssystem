<?php
    namespace app\index\controller;

    use think\View;
    use think\Request;
    use think\Db;
    use think\Controller;

    class Iframe extends controller{
        public function fill_form(){
        $car = Db::query('select distinct car from parts');
        $car = array_column($car, 'car');
        $parts = Db::query('select distinct partsname from parts');
        $parts = array_column($parts, 'partsname');
        //$names = array_column($msg, 'name');
        // dump($car);
        //dump($parts);
        $this ->assign("car",$car);
        $this ->assign("parts",$parts);
        //dump($parts);
            
            return view();
        }

        public function form_manage(){
            return view();
        }
        public function form_edit(request $request,$id){
            $data = Db::query("select * from orders where id = '$id'");
            //echo Db::getLastSql();
            $car = Db::query("select distinct car from parts");
            $car = array_column($car, 'car');
            $parts = Db::query("select distinct partsname from parts");
            $parts = array_column($parts, 'partsname');
            //$names = array_column($msg, 'name');
            // dump($car);             
            //dump($parts);
            $this ->assign("car",$car);
            $this ->assign("parts",$parts);
            $this ->assign("data",$data[0]);
            // dump($car);
            // dump($parts);
            // dump($data[0]);

            return view();
        }

        function add_parts(){

            return view();
        }
        function search_parts(){

            return view();
        }

        function parts_edit($id){

            $data = Db::query("select * from parts where id = '$id'");
            //echo Db::getLastSql();

            $this ->assign("data",$data[0]);
           //s dump($data[0]);

            return view();
        }

        public function add_outorder(){
            return view();

        }

        public function search_outorder(){
            return view();

        }
        public function add_inorder(){
            $car = Db::query("select distinct car from parts");
            $car = array_column($car, 'car');
            $parts = Db::query("select distinct partsname from parts");
            $parts = array_column($parts, 'partsname');
            //$names = array_column($msg, 'name');
            // dump($car);
            //dump($parts);
            $this ->assign("car",$car);
            $this ->assign("parts",$parts);
            return view();

        }

        public function search_inorder(){
            return view();

        }
        
    }