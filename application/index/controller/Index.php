<?php
namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\model\Categorys;
use think\Db;
use think\Request;

class Index extends Base
{
    public function index()
    {
        $categorys = $this->navShow();

       $articles =  \app\index\model\Article::order('create_at','desc')->paginate(5);


        return view('',compact('categorys','articles'));
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }

    public  function  category(Request $request){
        $categorys = $this->navShow();
        // 获取栏目id
        $cate_id = $request->param('cate_id');
        if ($cate_id){
         $articles =    \app\index\model\Article::where('cate_id',$cate_id)->paginate(10);

        }
        //获取栏目标题
      $category=   Categorys::get($cate_id);


        return view('',compact('articles','categorys','category'));
    }
    //搜索文章

    public function  search(Request $request){
        //组合条件 第一个参数是数据库字段名，第二个默认是like 第三个是关键字,%的意思后面模糊匹配
        $map = [
            ['title', 'like', '%'.$request->param('keywords').'%'],
        ];
        //查询数据，分页处理
        $articles=   Db::table('articles')->where($map)->paginate(10);
        $categorys = $this->navShow();
//        传输数据到页面
        return view('',compact('articles','categorys'));


    }
    //加入收藏
    public function collection(Request  $request){
        $data = $request->param();
        //判断是否登录进行收藏
        if ($data['session_id'] == null){
            return ['status'=> 0,'message'=>'您还没有登录,不能进行文章收藏'];
        }
        //定义规则,进行数据库查询
        $map[] = ['user_id','=', $data['user_id']];
        $map[] = ['article_id','=', $data['article_id']];
        $rule = Db::table('collection')->where($map)->find();
        if (is_null($rule)){
            $rule = Db::table('collection')->insert(
                [
                    'user_id' => $data['user_id'],
                    'article_id' => $data['article_id'],
                ]

            );
            session('code',1);
            return ['status'=>1,'message'=>'收藏成功'];

        }else{
            session('code',0);
            Db::table('collection')->where($map)->delete();
            return ['status'=>-1, 'message'=>'取消收藏'];
        }




    }
    //点赞
    public function zan(Request $request){
        $data = $request->param();
        //判断是否登录进行收藏
        if ($data['session_id'] == null){
            return ['status'=> 0,'message'=>'您还没有登录,不能对文章点赞'];
        }
        //定义规则,进行数据库查询
        $map[] = ['user_id','=', $data['user_id']];
        $map[] = ['article_id','=', $data['article_id']];
        $rule = Db::table('zan')->where($map)->find();
        if (is_null($rule)){
             Db::table('zan')->insert(
                [
                    'user_id' => $data['user_id'],
                    'article_id' => $data['article_id'],
                ]
            );
            session('zan',1);
            return ['status'=>1,'message'=>'点赞成功'];

        }else{
            session('zan',0);
            Db::table('zan')->where($map)->delete();
            return ['status'=>-1, 'message'=>'取消点赞'];
        }
    }
}
