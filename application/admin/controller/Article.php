<?php
/**
 * Created by PhpStorm.
 * User: gaobin
 * Date: 2019/1/7
 * Time: 5:15 PM
 */

namespace app\admin\controller;


use app\admin\common\controller\Base;
use think\facade\Session;
use think\Request;

class Article extends Base
{
    //展示文章页面
    public function index()
    {

        //得到用户id
        $uid = Session::get('admin_uid');

        //得到用户管理员id

        $admin = Session::get('is_admin');

        $articles = \app\admin\modle\Article::where('user_id',$uid)->paginate(10);
        if ($admin == 1){
            $articles = \app\admin\modle\Article::paginate(10);
        }

        return view('',compact('articles'));

    }

    //编辑文章
    public function edit($id)
    {

        $article = \app\index\model\Article::where('id',$id)->find();
        $categorys = \app\admin\modle\Categorys::all();
        return view('',compact('article','categorys'));

    }

    //接受文章处理

    public function update(Request $request)
    {

        $file = \think\facade\Request::file('title_img'); //获取file对象

        //文件信息验证与上传到服务器指定目录
        $info = $file -> validate([
                                      'size'=>5000000000,  //文件大小 100万字节是约等于1M
                                      'ext'=>'jpeg,,png,jpg,gif'  //文件扩展名
                                  ]) -> move('uploads/');  //移动到public/uploads目录下面
        if ($info) {
//                    把图片上传的路径存储到数据表中
            $date['title_img'] = $info->getSaveName();

        } else {
            //规则匹配不对，返回错误的信息
            return  ['status'=>'0','message'=>$file->getError()];
        }

        $data = $request->param();
        unset($data['content-html-code']);

        $id = $data['id'];

        $data = [
            'title'=>$data['title'],
            'title_img'=>$info->getSaveName(),
            'cate_id'=>$data['cate_id'],
            'user_id'=>$data['user_id'],
            'content'=>$data['content'],
            'destrin'=>$data['destrin']

        ];

        $info = \app\admin\modle\Article::where('id',$id)->data($data)->update();

        if ($info){
            return ['status'=>"1",'message'=>'文章修改成功'];
        }else{
            return ['status'=>'0','messge'=>'文章修改失败'];

    }


    }

    //删除文章
    public function delete($id)
    {
        $info = \app\admin\modle\Article::where('id',$id)->delete();

        if ($info){
            return $this->success('文章删除成功','/admin/article');
        }
        halt($id);

    }
}