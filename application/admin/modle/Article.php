<?php
/**
 * Created by PhpStorm.
 * User: gaobin
 * Date: 2019/1/7
 * Time: 5:16 PM
 */

namespace app\admin\modle;


use think\Model;

class Article extends  Model
{   protected $pk = 'id';  //默认主键
    protected $table = 'articles';  //默认数据表

    protected $autoWriteTimestamp = true; //开启自动时间戳
//定义时间戳字段名:默认为create_time和create_time,如果一致可省略
//如果想关闭某个时间戳字段,将值设置为false即可:$create_time = false
    protected $createTime = 'create_at'; //创建时间字段
    protected $updateTime = 'update_at'; //更新时间字段
    protected $dateFormat = 'Y年m月d日'; //时间字段取出后的默认时间格式

    public function category(){
        return $this->hasOne(\app\index\model\Categorys::class,'id','cate_id');
    }
    public function user(){
        return $this->hasOne(\app\index\model\User::class,'id','user_id');
    }

}