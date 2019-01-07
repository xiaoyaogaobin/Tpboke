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

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');
//注册页面
Route::get('register','index/user/register');
//用户登录
Route::get('login','index/user/login');
//用户注册数据处理
Route::get('register_form','index/user/register_form');
//用户提交登录数据处理
Route::get('login_form','index/user/login_form');
//用户退出管理
Route::get('logout','index/user/logout');
//文章添加
Route::resource('article','index/Article');
//
Route::get('index/category','index/category');
//搜索功能
Route::get('search','index/search');
//Mar上传图片页面
Route::post('uploadPicture','index/Article/uploadPicture');
//加入收藏
Route::get('collection','index/collection');
//点赞
Route::get('zan','index/zan');
//后台登录
Route::get('admin/login','admin/index/login');
//后台登录
Route::get('admin/loginout','admin/index/loginout');
//用户展示
Route::get('admin/userView','admin/User/userView');
//栏目展示
Route::get('admin/category','admin/Categorys/index');
//栏目添加
Route::get('admin/categorys/add','admin/Categorys/add');
//栏目编辑
Route::get('admin/categorys/update','admin/Categorys/update');
//文章管理
Route::get('admin/article','admin/Article/index');
//文章删除
Route::get('admin/articles/delete','admin/Article/delete');
Route::get('admin/articles/edit','admin/Article/edit');

Route::post('admin/articles/update','admin/Article/update');
return [

];

