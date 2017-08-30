<?php
namespace app\api\controller;
use think\Request;
use think\Session;
use app\admin\model\MouldModel;
use app\admin\controller\BaseController;

class Api extends  BaseController
{     
       //api方式获取数据
       public function getList(Request $request){
          $param=$request->get();
          $mould_id=$param['mould_id'];
          unset($param['mould_id']);
          if(isset($param['page'])){
            unset($param['page']);
          }
          if(isset($param['mould_fileds'])){
            $mould_fileds=$param['mould_fileds'];
            unset($param['mould_fileds']);
          }else{
            $mould_fileds='';
          }
          $data=MouldModel::getList($mould_id,$param,$mould_fileds);
          $this->returnInfo(0,$data,'获取成功');
       }

       public function getInfo(Request $request){
           $data=MouldModel::getInfo($request->get('mould_id'),$request->get('$id'));
           $this->returnInfo(0,$data,'获取成功');          
       }

       public function updateInfo(Request $request){
           $param= $request->post();
           unset($param['mould_id']);
           unset($param['id']);
           $data=MouldModel::updateInfo($request->post('mould_id'),$request->post('$id'),$param);
           $this->returnInfo(0,$data,'获取成功'); 
       }
       public function delInfo(Request $request){
           $data=MouldModel::delInfo($request->post('mould_id'),$request->get('$id'));
           $this->returnInfo(0,$data,'获取成功');          
       }
}
