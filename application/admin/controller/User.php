<?php
/**
 * Created by PhpStorm.
 * User: gaobin
 * Date: 2019/1/6
 * Time: 9:22 PM
 */

namespace app\admin\controller;


use app\admin\common\controller\Base;
use think\Db;
use think\facade\Request;
use think\facade\Session;

class User extends Base
{

    //加载 用户页面
    public function userView(){


//        获取当前页面session值
      $uid=   Session::get('admin_uid');
      $admin=  Session::get('is_admin');

      $users = \app\admin\modle\User::where('id',$uid)->select();

      if ($admin){

          $users =\app\admin\modle\User::all();

      }

        return view('',compact('users'));


    }
    //执行用户编辑
    public function userUpdate(){

        $id = Request::param('id');
        $user = \app\admin\modle\User::where('id',$id)->find();
        $this->view->assign('empty','<span style="red">没有任何数据</span>');
        $this->view->assign('users', $user);
        //5.渲染出用户列表
        return $this->view->fetch('users');


    }
    //用户编辑操作
    public function  userSave(){
      $user=   Request::param();
        $id =$user['id'];
      $user['password'] = sha1($user['password']);
      unset($user['id']);

    $rule=  \app\admin\modle\User::where('id',$id)->data($user)->update();
    if ($rule){
        return $this->success('修改成功','/admin');
    }


    }
    //用户删除操作
    public function delete($id){

      $result =   Db::table('user')->delete($id);
      if ($result){
          $this->success('删除用户成功','/admin/userView');
      }



    }


}