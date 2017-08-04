<?php
namespace app\admin\controller;
use think\Request;
use think\Session;
use think\Validate;
use think\DB;
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
            $in=array();
            $post=$request->post();
            $validate = new Validate([
                'name'  => 'require|max:25',
                'table' => 'require|max:25'
            ]);
            if (!$validate->check($post)) {
                  $this->returnInfo(-1,'',$validate->getError());
            }
             $mould  =new  MouldModel();
             $mould->name=$post['name'];
             $mould->table=$post['table'];
             $mould->ct_time=time();
             $mould->save();
             $sql='CREATE TABLE `'. $mould->table.'` ( `id` int(11) NOT NULL AUTO_INCREMENT,';
             foreach ( $post['fileds']['filed'] as $key => $value) {
                $FiledsModel=new FiledsModel();
                $FiledsModel->mould_id=$mould->id;
                $FiledsModel->filed=$post['fileds']['filed'][$key];
                $FiledsModel->title=$post['fileds']['title'][$key];
                $FiledsModel->type=$post['fileds']['type'][$key];
                preg_match('/\[(.*)\]/i', $mould::Type($FiledsModel->type),$res);
                $FiledsModel->value=$post['fileds']['value'][$key];
                $FiledsModel->save();
               foreach(explode(',',$post['fileds']['check'][$key]) as $val){
                        switch ($val) {
                            case 'add':
                                $in['add'][$FiledsModel->id]=array();
                                break;
                            case 'edit':
                                $in['edit'][$FiledsModel->id]=array();
                                # code...
                                break;
                            case 'list':
                                 $in['list'][$FiledsModel->id]=array();
                                break;
                            case 'sreach':
                                $in['sreach'][$FiledsModel->id]=array();
                                break;  
                        }                
               }
                if(isset($in['add']) && !empty($in['add'])){
                    $mould->add=serialize($in['add']);
                }
                if(isset($in['edit']) && !empty($in['edit'])){
                    $mould->edit=serialize($in['edit']);
                }
                if(isset($in['list']) && !empty($in['list'])){
                    $mould->list=serialize($in['list']);
                }
                if(isset($in['sreach']) && !empty($in['sreach'])){
                    $mould->sreach=serialize($in['sreach']);
                }

                $mould->save();
                $sql.="`".$FiledsModel->filed."` ".$res[1]." DEFAULT NULL COMMENT '".$FiledsModel->title."',";
             }
                $sql.='PRIMARY KEY (`id`) ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;';
                Db::execute($sql);
                $this->returnInfo(0,'/index.php/admin/mould/columns','保存成功');       
            }      
        }

        public function set(Request $request){
            if(empty($request->post())){
                return $this->fetch('set');
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
