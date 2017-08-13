<?php
namespace app\admin\controller;
use think\Request;
use think\Session;
use app\admin\model\MenuModel;
use app\admin\model\GroupModel;
class Menu extends  BaseController
{
        public function columns(){
            $data=array();
            foreach(MenuModel::all() as $value){
              $data['list'][]=$value->toarray();
            }
            $this->assign('data',$data);
            return $this->fetch('columns');
        }

        public function put(Request $request){
            if(empty($request->post())){
                $this->assign('data',array('menu'=>MenuModel::getVals()));
                return $this->fetch('put');
            }else{
                $param=$request->post();
                $menu= new MenuModel();
                $menu->name=$param['name'];
                $menu->address=$param['address'];
                $menu->fa=$param['fa'];
                $menu->pid=$param['pid'];
                $menu->save();
                $this->returnInfo(0,'','新增成功');
            }            
        }

        public function update(Request $request){
            if(empty($request->post())){
                $group=MenuModel::get($request->get('id'));
                $data=$group->toarray();
                $data['menu']=MenuModel::getVals();
                $this->assign('data',$data);
                return $this->fetch('update');
            }else{
                $param=$request->post();
                $menu= MenuModel::get($request->post('id'));
                $menu->name=$param['name'];
                $menu->address=$param['address'];
                $menu->fa=$param['fa'];
                $menu->pid=$param['pid'];
                $menu->save();
                $this->returnInfo(0,'','修改成功');
            }            
        }
        public function del(Request $request){
              MenuModel::destroy($request->get('id'));
              $this->returnInfo(0,'','删除');
        }
}
