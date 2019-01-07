<?php
/**
 * Created by PhpStorm.
 * User: gaobin
 * Date: 2019/1/4
 * Time: 10:32 PM
 */

namespace app\index\common\validata;


use think\Validate;

class User extends Validate
{

    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'usename'=>'require|unique:user',
        'password'=>'require|confirm',
        'code'=>'require|captcha',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */
    protected $message = [
        'usename.require'=>'账号不能为空',
        'usename.unique'=>'您注册账号已存在',
        'password.require'=>'密码不能为空',
        'password.confirm'=>'两次密码不一致',
        'code.require'=>'验证码不能为空',
        'code.captcha'=>'验证码不正确',

    ];
}