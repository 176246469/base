<?php
namespace app\admin\controller;
use think\Request;
use think\Session;
use app\admin\model\MenuModel;
use app\admin\model\GroupModel;
use app\admin\model\TreeModel;
use app\admin\model\MouldModel;
class Mould extends  BaseController
{
        public function columns(){
            $data=array();

            return $this->fetch('columns');
        }
        public function put(Request $request){
            if(empty($request->post())){
                $data['type']=MouldModel::Type();
                $this->assign('data',$data);
                return $this->fetch('put');
            }else{
                $group->save();
            }            
        }

        public function update(Request $request){
            if(empty($request->post())){

                return $this->fetch('update');
            }else{
                $this->returnInfo(0,'','');
            }            
        }
}
