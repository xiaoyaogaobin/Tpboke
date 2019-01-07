<?php

namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\model\Categorys;
use think\captcha\Captcha;
use think\facade\Session;
use think\Request;
use think\Validate;

class user extends Base
{
    //注册页面调用
    public function  register(){
        $this->isRegister();
        $this->is_reg();
       $categorys = $this->navShow();

        return view('',compact('categorys'));

    }
    //加载验证码
    public function  code(){
        $captcha =   new Captcha();
        //设置验证码长度
        $captcha->length = 4;
        //验证码宽度
        $captcha->imageW= 100;
        //验证码高度
        $captcha->imageH =39;
        //验证码字体大小
        $captcha->fontSize = 14;
        //设置是否启用验证码是否是中文
//      $captcha->useZh = true;
        // 返回验证码
        return $captcha->entry();
    }
    //注册数据提交过来管理
    public function register_form(Request $request){

        $data = $request->param();


      $validata=   new \app\index\common\validata\User();
        if (!$validata->check($data)) {
            return ['status'=>0,'message'=>$validata->getError()];
        }else{
          $rule =   \app\index\model\User::create($data);
            //同时把用户提交数据存入session 里面
            session('usename',$data['usename']);
            session('uid',$rule['id']);

            return ['status'=>1,'message'=>'注册成功'];

        }
    }
    //加载登录页面
    public function  login(){
        $this->isLogin();
        $categorys = $this->navShow();
        return view('',compact('categorys'));
    }
    //用户提交数据处理
    public function  login_form(Request $request){

        $data = $request->param();
        $validate = Validate::make([
            'usename'=>'require',
            'password'=>'require',
            'code'=>'require|captcha',

                               ],[
            'usename.require' =>"账号不能为空",
            'password.require' =>"密码不能为空",
            'code.require' =>"验证码不能为空",
            'code.captcha' =>"验证码不能为空",
        ]);
        $rules = $validate->check($data);
        if (!$rules){
            return ['status'=>'0','message'=>$validate->getError()];
        }else{
          $result =   \app\index\model\User::get(function ($query) use ($data){
                $query->where('usename',$data['usename'])->where('password',sha1($data[
                    'password'])
                    );

            });
          if (is_null($result)){
              return ['status'=>'0','message'=>'用户密码不正确'];
          }else{

              Session::set('uid',$result->id);
              Session::set('usename',$result->usename);
              return ['status'=>'1','message'=>'登录成功'];
          }

        }
    }
    // 退出管理
    public  function  logout(){

        Session::clear();
        return $this->success('退出登录成功','index/index');

    }
}
