<?php

namespace app\index\controller;

use app\index\common\controller\Base;
use app\index\model\Categorys;
use think\Controller;
use think\Request;

class Article extends Base
{


    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $this->isArticle();
        $categorys = Categorys::all();
        //
        return view('',compact('categorys'));

    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
//       获得前台提交的数据是否是post提交
        if (\think\facade\Request::isPost()){
            // 获得post提交的数据
            //提交数据重组
            $date= [
                'title'=>$request->param('title'),
                'destrin' => $request->param('destrin'),
                'cate_id' => $request->param('cate_id'),
                'user_id' => $request->param('user_id'),
                'content' => $request->param('content-html-code'),
            ];


            //调用 article 里面书写验证规则
            $validata = new \app\index\common\validata\Article();
            //把数据传入验证规则里面，会返回一个布尔值
            $rules = $validata->check($date);
            //验证通过
            if ($rules){

                //获取上传的标题图片信息
                $file = \think\facade\Request::file('title_img'); //获取file对象

                //文件信息验证与上传到服务器指定目录
                $info = $file -> validate([
                                              'size'=>5000000000,  //文件大小 100万字节是约等于1M
                                              'ext'=>'jpeg,,png,jpg,gif'  //文件扩展名
                                          ]) -> move('uploads/');  //移动到public/uploads目录下面
                //图片验证规则是否为真
                if ($info) {
//                    把图片上传的路径存储到数据表中
                    $date['title_img'] = $info->getSaveName();

                } else {
                    //规则匹配不对，返回错误的信息
                  return  ['status'=>'0','message'=>$file->getError()];
                }
//                halt($date);
                //将数据写到文档表中
                if(\app\index\model\Article::create($date)){
                    return ['status'=>'1','message'=>'文章发布成功'];

                } else {
                    return ['status'=>'0','message'=>'文章发布失败'];
                }

            }else{
                return ['status' => '0','message' => $validata->getError()];
            }

        } else{
            return ['status' => '0','message' => '你请求的方式不正确'];
        }

    }

    /**
     * 显示指定的资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function read($id)
    {
        $categorys = Categorys::all();
       $article =  \app\index\model\Article::where('id' ,$id)->find();
       \app\index\model\Article::where('id' ,$id)->setInc('pv');
//       halt($article);

        return view('',compact('article','categorys'));
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request $request
     * @param  int $id
     * @return \think\Response
     */
    public function update(Request $request,$id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
    //Editor 上传图片
    public function  uploadPicture(Request $request){
        //获取上传的标题图片信息
        $file = \think\facade\Request::file('editormd-image-file'); //获取file对象

        //文件信息验证与上传到服务器指定目录
    $info=    $file -> validate([ 'size'=>5000000000,  //文件大小 100万字节是约等于1M
                             'ext'=>'jpeg,,png,jpg,gif'  //文件扩展名
                         ]) -> move('uploads/');
    //处理回调数据
    $data = [
        'success'=> 1,
        'message'=>'上传成功',
        //处理回调图片路径
        'url' => '/uploads/'.$info->getSaveName(),
    ];
//        返回一个json数据
       return  json_encode($data);

    }



}
