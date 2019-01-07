<?php
/**
 * Created by PhpStorm.
 * User: gaobin
 * Date: 2019/1/7
 * Time: 7:32 PM
 */

namespace app\admin\controller;


use app\admin\common\controller\Base;
use think\Request;

class Web extends Base
{
        public function  index(){

      $web =   \app\admin\modle\Web::where('id',1)->find();
            return view('',compact('web'));
        }
        public function edit(Request $request){

            $data = $request->param();

            if ($data['id']){
                $data = [
                    'title'=>$data['title'],
                    'keywords'=>$data['keywords'],
                    'description'=>$data['description'],
                    'is_open'=>$data['is_open'],
                    'is_users'=>$data['is_users'],
                    'is_comment'=>$data['is_comment'],
                ];
                \app\admin\modle\Web::where('id',1)->data($data)->update();
                $this->success('更新配置成功');

            }else{
                 \app\admin\modle\Web::create($data);
                $this->success('保存配置成功');
            }


        }
}