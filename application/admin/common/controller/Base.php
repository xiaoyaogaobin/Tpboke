<?php
/**
 * Created by PhpStorm.
 * User: gaobin
 * Date: 2019/1/6
 * Time: 7:54 PM
 */

namespace app\admin\common\controller;


use app\admin\modle\Web;
use think\Controller;
use think\facade\Session;

class Base extends Controller
{
    public function isAdmin(){
        if (!Session::has('admin_uid')){
            return $this->error('客官,您没有登录','/admin/login');
        }
    }




}