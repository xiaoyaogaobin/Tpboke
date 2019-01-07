<?php

namespace app\admin\controller;

use app\admin\common\controller\Base;
use app\admin\modle\User;
use think\Db;
use think\facade\Session;
use think\Request;


class index extends Base
{
    //
    public function  index(){

        $this->isAdmin();
        return view();

    }
      public function login(){
           return view();
      }
      public function login_form(Request $request){


      $users =   Db::table('user')->where([
            'usename'=>$request->param('usename'),
            'password'=>sha1($request->param('password'))
                    ])->find();
        if ($users){
            session('admin_uid',$users['id']);
            session('uid',$users['id']);
            session('admin_usename',$users['usename']);
            session('admin_usename',$users['usename']);
            session('usename',$users['usename']);
            Session::set('is_admin',$users['is_admin']);
            return $this->success('登录成功','/admin');
        }




      }
      //退出功能
    public function loginout(){
        Session::clear();
        return $this->success('退出成功','/admin/login');
    }

}
