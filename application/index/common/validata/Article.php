<?php
/**
 * Created by PhpStorm.
 * User: gaobin
 * Date: 2019/1/5
 * Time: 2:34 PM
 */

namespace app\index\common\validata;


use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'title'=>'require|unique:articles',
        'cate_id'=>'require',
//        'title_img'=>'require',
        'content'=>'require',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */
    protected $message = [
        'title.require'=>'文章不能为空',
        'title.unique'=>'文章标题已经存在',
        'cate_id.require'=>'栏目不能为空',
        'title_img.require'=>'文章图片必须上传',
        'content.require'=>'内容不能为空',

    ];

}