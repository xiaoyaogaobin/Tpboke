<?php
/**
 * Created by PhpStorm.
 * User: gaobin
 * Date: 2019/1/7
 * Time: 12:42 PM
 */

namespace app\admin\controller;


use app\admin\common\controller\Base;
use think\Db;
use think\facade\Validate;
use think\Request;

class Categorys extends Base
{
    //栏目首页操作
    public function index()
    {
        $this->isAdmin();
        $categorys = \app\admin\modle\Categorys::all();

        return view('',compact('categorys'));
    }

    //栏目添加页面
    public function add()
    {

        return view();
    }

    //添加栏目页面处理
    public function adds(Request $request)
    {
        $data = $request->param();

        $validate = Validate::make(
            [
                'name' => 'require'
            ],[
                'name.require' => '栏目不能为空'
            ]);
        $result = $validate->check($data);

        if (!$result){
            return $this->error($validate->getError());

        }
        $oldrelus = Db::table('categorys')->where('name',$data['name'])->find();
        if ($oldrelus){
            return $this->error('不能添加重复的栏目');
        } else{
            $relus = \app\admin\modle\Categorys::create($data);
            if ($relus){
                return $this->success('栏目添加成功','/admin/category');
            }
        }


//

    }

    //栏目编辑显示
    public function update(Request $request)
    {

        $id = $request->param('id');
        $result = \app\admin\modle\Categorys::where('id',$id)->find();
        return view('',compact('result'));


    }
    //栏目编辑处理
    public function updateSave( Request $request){

        $date = $request->param();

        $id = $request->param('id');
        unset($date['id']);
//        halt($date);
       $result = \app\admin\modle\Categorys::where('id',$id)->update($date);
        if ($result){
            return $this->success('栏目修改成功','/admin/category');
        }
    }

    //栏目删除操作
    public function delete($id){


        $result =   Db::table('categorys')->delete($id);
        if ($result){
            $this->success('删除栏目成功','/admin/category');
        }



    }
}