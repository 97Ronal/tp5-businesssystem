<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// return [
//     '__pattern__' => [
//         'name' => '\w+',
//     ],
//     '[hello]'     => [
//         ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//         ':name' => ['index/hello', ['method' => 'post']],
//     ],
// ];

//静态路由
//Route::rule('路由表达式','路由地址','请求类型','路由参数','变量规则')

use think\Route;

Route::rule('/','index/index/index');
Route::rule('test','index/index/test');

//带参数路由
Route::rule('course/:id','index/index/course');
//带多个参数
Route::rule('time/:year/[:month]','index/index/time1');

//完全匹配方法
Route::rule('test1$','index/index/test1');

//路由额外带参数
Route::rule('test2','Index/index/test2?id=10&name=zhangsan');

//资源路由
//Route::resource('')

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];

