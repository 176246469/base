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
            $this->redirect('/index.php/admin/admin/login');
        }
        public function check_session(){
                if(empty(Session::get('admin'))){
                     $this->redirect('/index.php/admin/admin/login');
                }
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
                 $data['info']=AdminModel::get($request->get('id'));
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
                $this->returnInfo(0,'','修改成功');               
            }
        }
        public function columns(){
            $data=array();
            foreach(AdminModel::all() as $value){
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
            /*
            foreach($menu as $key=>$value){
                    if(isset($access[$key])){
                         foreach($menu[$key]["child"] as $k=>$v){
                            
                                if(!isset($access[$key][$k])){
                                   unset($menu[$key][$k]);
                                }
                         }
                    }else{
                        unset($menu[$key]);
                    }
            }*/
            $this->assign('menu',$menu);
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


}
