<?php
namespace app\admin\controller;
use think\Request;
use think\Session;
use app\admin\model\MenuModel;
use app\admin\model\GroupModel;
use app\admin\model\TreeModel;
class Group extends  BaseController
{
        public function columns(){
            $data=array();
            foreach(GroupModel::all(['status'=>1]) as $value){
              $data['list'][]=$value->toarray();
            }
            $treelist=new TreeModel($data['list']);
            $data['list']=$treelist->getChildren(0);
            $this->assign('data',$data);
            return $this->fetch('columns');
        }
        public function put(Request $request){
            if(empty($request->post())){
                foreach(GroupModel::all() as $value){
                  $data['list'][]=$value->toarray();
                }
                $treelist=new TreeModel($data['list']);
                $data['list']=$treelist->getChildren(0);
                $data['menu']=MenuModel::getVals();
                $this->assign('data',$data);
                return $this->fetch('put');
            }else{
                $param=$request->post();
                $group= new GroupModel();
                $group->pid=$param['pid'];
                $group->status=$param['status'];
                $group->name=$param['name'];
                $group->access=(isset($param['access']) ? serialize($param['access']) : '') ;
                $group->save();
                $this->returnInfo(0,'/index.php/admin/group/columns','新增成功');
            }            
        }

        public function update(Request $request){
            if(empty($request->post())){
                $group=GroupModel::get($request->get('id'));
                $data['info']=$group->toarray();
                $data['access']=unserialize($data['info']['access']);
                foreach(GroupModel::all() as $value){
                  $data['list'][]=$value->toarray();
                }
                $treelist=new TreeModel($data['list']);
                $data['list']=$treelist->getChildren(0);
                $data['menu']=MenuModel::getVals();
                $this->assign('data',$data);
                return $this->fetch('update');
            }else{
                $param=$request->post();
                $group=GroupModel::get($request->post('id'));
                $group->name=$param['name'];
                $group->pid=$param['pid'];
                $group->status=$param['status'];
                $group->remark=$param['remark'];
                $group->access=(isset($param['access']) ? serialize($param['access']) : '') ;
                $group->save();
                $this->returnInfo(0,'/index.php/admin/group/columns','修改成功');
            }            
        }
        public function del(Request $request){
              $group=GroupModel::get($request->get('id'));
              $group->status=-1;
              $group->save();
              $this->returnInfo(0,'','删除');
        }
}
