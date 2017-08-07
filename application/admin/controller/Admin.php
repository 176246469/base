<?php
namespace app\admin\controller;
use think\Request;
use think\Session;
use app\admin\model\MenuModel;
use app\admin\model\GroupModel;
use app\admin\model\AdminModel;
use app\admin\model\TreeModel;

class Admin extends  BaseController
{

        public function login(){
            return $this->fetch('login');
        }

        public function quit(){
            Session::delete('admin');
            $this->check_session();
        }
        public function put(Request $request){
            if(empty($request->post())){
                $data=array();
                foreach(GroupModel::all() as $value){
                  $data['group'][]=$value->toarray();
                }
                $treelist=new TreeModel($data['group']);
                $data['group']=$treelist->getChildren(0);
                $this->assign('data',$data);
                return $this->fetch('put');
            }else{
                $param=$request->post();
                $AdminModel= new AdminModel();
                $AdminModel->name=$param['name'];
                $AdminModel->username=$param['username'];
                $AdminModel->password= $param['password'];
                $AdminModel->group= $param['group'];
                $AdminModel->status=1;
                $AdminModel->save();
                $this->returnInfo(0,'','新增成功');               
            }
        }

        public function update(Request $request){
            if(empty($request->post())){
                $data=array();
                 $data['info']=AdminModel::get($request->get('id'))->toarray();
                foreach(GroupModel::all() as $value){
                  $data['group'][]=$value->toarray();
                }
                $treelist=new TreeModel($data['group']);
                $data['group']=$treelist->getChildren(0);
                $this->assign('data',$data); 
                return $this->fetch('update');
            }else{
                $param=$request->post();
                $AdminModel= new AdminModel();
                $AdminModel->name=$param['name'];
                $AdminModel->username=$param['username'];
                $AdminModel->password= $param['password'];
                $AdminModel->group= $param['group'];
                $AdminModel->status=1;
                $AdminModel->save();
                $this->returnInfo(0,'','修改成功');               
            }
        }
        public function columns(){
            $data=array();
            foreach(AdminModel::all(['status'=>['>=',0]]) as $value){
              $data['list'][]=$value->toarray();
            }
            $this->assign('data',$data);
            return $this->fetch('columns');
        }

        public function index(){
            $menu=MenuModel::getVals(); 
            $admin=Session::get('admin');
            $group=GroupModel::get(2);
            $access=unserialize($group['access']);
            $this->assign('menu',$menu);
            $this->assign('admin',$admin);
            return $this->fetch('index');
        }
        public function api_login(Request $request){
            $option['name']=$request->post('name');
            $option['password']=$request->post('password'); 
            $admin=new  AdminModel();
            $admin= $admin->login($option);
            if(empty($admin)){
                    $this->returnInfo(-1,'','密码错误');
            }else{
                    Session::set('admin',$admin);
                    $this->returnInfo(0,'/index.php/admin/admin/index','登录成功');
            }    
        }
        public function del(Request $request){
              $admin=AdminModel::get($request->get('id'));
              $admin->status=-1;
              $admin->save();
              $this->returnInfo(0,'','删除');
        }
}
