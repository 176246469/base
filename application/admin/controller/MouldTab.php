<?php
namespace app\admin\controller;
use think\Request;
use think\Session;
use app\admin\model\MenuModel;
use app\admin\model\GroupModel;
use app\admin\model\TreeModel;
use app\admin\model\MouldModel;
use app\admin\model\FiledsModel;
class Mould extends  BaseController
{
        public function columns(){
            $data=array();
            foreach(MouldModel::all() as $value){
              $data['list'][]=$value->toarray();
            }
            $this->assign('data',$data);
            return $this->fetch('columns');
        }

        public function put(Request $request){
            if(empty($request->post())){
                $data['type']=MouldModel::Type();
                $this->assign('data',$data);
                return $this->fetch('put');
            }else{
             $mould  =new  MouldModel();
             $mould->name=$request->post('name');
             $mould->table=$request->post('table');
            // $mould->save();
             //$fileds=$request->post('fileds');
             $sql='CREATE TABLE `'. $mould->table.'` ( `id` int(11) NOT NULL AUTO_INCREMENT,';
            /*                                   
             foreach ( $fileds as $key => $value) {
                 $fileds=new FiledsModel();
                 $fileds->mould_id=$mould->id;
                 $fileds->filed='2';
                 $fileds->title=$fileds['title'][$key];
                 $fileds->type=$fileds['type'][$key];
                 preg_match('/\[(.*)\]/i', $MouldModel::Type($fileds['type'][$key]),$res);
                 $fileds->value=$fileds['value'][$key];
                 $sql.="`".$fileds->filed."` ".$res." DEFAULT NULL COMMENT '".$fileds->title."',";
                  
             }*/
           // $sql.='PRIMARY KEY (`id`) ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;';
              var_dump($request->post());
            }      
        }

        public function update(Request $request){
            if(empty($request->post())){
                return $this->fetch('update');
            }else{
                $this->returnInfo(0,'','');
            }            
        }

        public function del(Request $request){
              $admin=AdminModel::get($request->get('id'));
              $admin->status=-1;
              $admin->save();
              $this->returnInfo(-1,'','删除');
        }
}
