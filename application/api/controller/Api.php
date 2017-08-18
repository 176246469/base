<?php
namespace app\api\controller;
use think\Request;
use think\Session;
use app\admin\model\MouldModel;
use app\admin\controller\BaseController;

class Api extends  BaseController
{

       public function getList(Request $request){
           $data=MouldModel::getList($request->get('id'));
           $this->returnInfo(0,$data,'获取成功');          
       }

       public function getInfo(Request $request){
           $data=MouldModel::getInfo($request->get('mould_id'),$request->get('$id'));
           $this->returnInfo(0,$data,'获取成功');          
       }

       public function updateInfo(Request $request){
           $data=MouldModel::getInfo($request->post('mould_id'),$request->get('$id'));
           $this->returnInfo(0,$data,'获取成功');          
       }
}
