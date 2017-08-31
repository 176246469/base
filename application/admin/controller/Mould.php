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
      //核心
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
             $mould->table='ext_'.$post['table'];
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
                    $mould->add= serialize($in['add']);
                }
                if(isset($in['edit']) && !empty($in['edit'])){
                    $mould->edit= serialize($in['edit']);
                }
                if(isset($in['list']) && !empty($in['list'])){
                    $mould->list= serialize($in['list']);
                }
                if(isset($in['sreach']) && !empty($in['sreach'])){
                    $mould->sreach= serialize($in['sreach']);
                }

                $mould->save();
                $sql.="`".$FiledsModel->filed."` ".$res[1]." DEFAULT NULL COMMENT '".$FiledsModel->title."',";
             }
                $sql.=" `status` tinyint(1) DEFAULT '1' COMMENT '删除-1，正常 1', PRIMARY KEY (`id`) ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
                Db::execute($sql);
                $this->returnInfo(0,'/index.php/admin/mould/columns','保存成功');       
            }      
        }
      //核心
        public function set(Request $request){
            if(empty($request->post())){
              $mould= MouldModel::get($request->get('id'));
              $data['info']=$mould->toarray();
            
              $data['info']['add']=$this->mb_unserialize($data['info']['add']);
              $data['info']['edit']=$this->mb_unserialize($data['info']['edit']);
              $data['info']['list']=$this->mb_unserialize($data['info']['list']);
              $data['info']['sreach']=$this->mb_unserialize($data['info']['sreach']);
              foreach (FiledsModel::all(['mould_id'=>$request->get('id')]) as $key => $value) {
                  $data['fileds'][$value->id]=$value->toarray();
              }
            // var_dump(  $data['fileds']);exit();
              $this->assign('type',MouldModel::Type());
              $this->assign('validate',FiledsModel::$validate_data);
              $this->assign('data',$data);
              return $this->fetch('set');
            }else{
              $this->returnInfo(0,'','');
            }            
        }
      //set_add
      public function set_add(Request $request){
            if(!empty($request->post())){
                $data=$request->post();
                $mould= MouldModel::get($data['id']);
                $mould->add=serialize($data['filed']);
                $mould->save();
                 $this->returnInfo(0,'/index.php/admin/mould/set?&id='.$data['id'],'保存成功');       
            }
      }      
      //set_edit
      public function set_edit(Request $request){
            if(!empty($request->post())){
                $data=$request->post();
                $mould= MouldModel::get($data['id']);
                $mould->edit=serialize($data['filed']);
                $mould->save();
                 $this->returnInfo(0,'/index.php/admin/mould/set?tab=tab-2&id='.$data['id'],'保存成功');       
            }
      } 
      //set_list
      public function set_list(Request $request){
            if(!empty($request->post())){
                $data=$request->post();
                $mould= MouldModel::get($data['id']);
                $mould->list=serialize($data['filed']);
                $mould->save();
                 $this->returnInfo(0,'/index.php/admin/mould/set?tab=tab-3&id='.$data['id'],'保存成功');       
            }
      } 
      //set_sreach
      public function set_sreach(Request $request){
            if(!empty($request->post())){
                $data=$request->post();
                $mould= MouldModel::get($data['id']);
                $mould->sreach=serialize($data['filed']);
                $mould->save();
                $this->returnInfo(0,'/index.php/admin/mould/set?tab=tab-4&id='.$data['id'],'保存成功');       
            }
      }  
      public function set_fileds(Request $request){
            if(!empty($request->post())){
                $data=$request->post();
                $mould= MouldModel::get($data['id']);
                $mould_add=$this->mb_unserialize($mould->add);
                $mould_edit=$this->mb_unserialize($mould->edit);
                $mould_list=$this->mb_unserialize($mould->list);
                $mould_sreach=$this->mb_unserialize($mould->sreach);
                 foreach($data['fileds']['filed'] as $key =>$value){
                   $info=  FiledsModel::find($key);
                   if($info->title<>$data['fileds']['title'][$key]){
                      $info->title=$data['fileds']['title'][$key];
                   }
                   if($info->value<>$data['fileds']['value'][$key]){
                      $info->value=$data['fileds']['value'][$key];
                   }
                   if($info->type<>$data['fileds']['type'][$key]){
                    //字段类型修改
                      $info->type=$data['fileds']['type'][$key];
                   }
                   if($info->filed<>$data['fileds']['filed'][$key]){
                    //字段名称修改
                     preg_match('/\[(.*)\]/i', $mould::Type($data['fileds']['type'][$key]),$res);
                       $sql=" ALTER TABLE ".$mould->table." CHANGE ".$info->filed." ".$data['fileds']['filed'][$key]." ".$res[1];
                       $info->filed=$data['fileds']['filed'][$key]; 
                       Db::execute($sql);
                   }
                   //字段

                   $action=explode(',',$data['fileds']['check'][$key]);
                   if(in_array('add',$action)){
                            if(!isset($mould_add[$key])){
                               $mould_add[$key]=array();
                            }
                   }else{
                            if(isset($mould_add[$key])){
                              unset($mould_add[$key]);
                            }
                   }
                   if(in_array('edit',$action)){
                            if(!isset($mould_edit[$key])){
                               $mould_edit[$key]=array();
                            }
                   }else{
                            if(isset($mould_edit[$key])){
                              unset($mould_edit[$key]);
                           //  $mould->edit[$key]=1;
                            }
                   }
                   if(in_array('list',$action)){
                            if(!isset($mould_list[$key])){
                               $mould_list[$key]=array();
                            }
                   }else{
                            if(isset($mould_list[$key])){
                              unset($mould_list[$key]);
                            }
                   }
                   if(in_array('sreach',$action)){
                            if(!isset($mould_sreach[$key])){
                               $mould_sreach[$key]=array();
                            }
                   }else{
                            if(isset($mould_sreach[$key])){
                              unset($mould_sreach[$key]);
                            }
                   }
                   //字段end
                   $info->save();
                    //新增字段
                 }  
                        if(isset($data['add'])){
                         foreach($data['add']['filed'] as $key =>$value){
                            $filedsModel= new FiledsModel();
                            $filedsModel->mould_id=$data['id'];
                            $filedsModel->title=$data['add']['title'][$key]; 
                            $filedsModel->filed=$data['add']['filed'][$key]; 
                            $filedsModel->type=$data['add']['type'][$key]; 
                            $filedsModel->value=$data['add']['value'][$key]; 

                            preg_match('/\[(.*)\]/i', $mould::Type($data['add']['type'][$key]),$res);
                            $sql="alter table ".$mould->table." add ".$filedsModel->filed." ".$res[1]." not Null;";
                               Db::execute($sql);
                            $filedsModel->save();
                             foreach(explode(',',$data['add']['check'][$key]) as $val){
                                      switch ($val) {
                                          case 'add':
                                              $mould_add[$FiledsModel->id]=array();
                                              break;
                                          case 'edit':
                                              $mould_edit[$FiledsModel->id]=array();
                                              # code...
                                              break;
                                          case 'list':
                                              $mould_list[$FiledsModel->id]=array();
                                              break;
                                          case 'sreach':
                                              $mould_sreach[$FiledsModel->id]=array();
                                              break;
                                      }                
                             }
                        }
                    }
                if(isset($mould_add) && !empty($mould_add)){
                    $mould->add= serialize($mould_add);
                }
                if(isset($mould_edit) && !empty($mould_edit)){
                    $mould->edit= serialize($mould_edit);
                }
                if(isset($mould_list) && !empty($mould_list)){
                    $mould->list= serialize($mould_list);
                }
                if(isset($mould_sreach) && !empty($mould_sreach)){
                    $mould->sreach= serialize($mould_sreach);
                } 
                $mould->save();
                 $this->returnInfo(0,'/index.php/admin/mould/set?tab=tab-5&id='.$data['id'],'保存成功');       
            }
      } 
        public function del(Request $request){
              $mould=MouldModel::get($request->get('id'));
              MouldModel::destroy($request->get('id'));
              MenuModel::destroy((['mould_id' =>$request->get('id')]));
              FiledsModel::destroy((['mould_id' =>$request->get('id')]));
              $sql='drop table '. $mould->table;
              Db::execute($sql);
              $this->returnInfo(0,'','删除');
        }

    //模型新增
    public function view_put(Request $request){
      if(empty($request->post())){
             $mould_id=$request->get('mould_id');
              $mould= MouldModel::get($request->get('mould_id'));
              $data['info']=$mould->toarray();
              $data['info']['add']=unserialize($data['info']['add']);
               foreach(FiledsModel::all(['mould_id'=>$mould_id]) as $value){
                  $data['fileds'][$value->id]=$value->toarray();
                  //多选
                  if($value->type==4 || $value->type==5){
                    $data['fileds'][$value->id]['value']=explode(',',$data['fileds'][$value->id]['value']);
                  }
               } 
              $this->assign('data',$data);
              return $this->fetch('view_put');
     }else{
        $mould= MouldModel::get($request->get('mould_id'));
        $mould['add']=$this->mb_unserialize($mould['add']);
        foreach($mould['add'] as $key=>$value){
            if(isset($value["validate"]) &&!empty($value["validate"])){
                        $filed=FiledsModel::get($key);
                         $validate_data[$filed->filed]=FiledsModel::getValidate($value["validate"]);
            }
            // 时间
        }
        if(!empty($validate_data)){
            $validate = new Validate($validate_data);
            if (!$validate->check($request->post())) {
                  $this->returnInfo(-1,'',$validate->getError());
            } 
        }
        Db::table($mould->table)->insert($request->post());
        $this->returnInfo(0,'/index.php/admin/mould/view_columns?mould_id='.$request->get('mould_id'),'保存成功');       
     }
    }
    //模型修改
    public function view_update(Request $request){
      if(empty($request->post())){
        $mould_id=$request->get('mould_id');
        $id=$request->get('id');
        $mould= MouldModel::get($request->get('mould_id'));
        $tab_info=  Db::table($mould->table)->where('id',$id)->find();
        $data['info']=$mould->toarray();
        $data['info']['edit']=unserialize($data['info']['edit']);

           foreach(FiledsModel::all(['mould_id'=>$mould_id]) as $value){
              $data['fileds'][$value->id]=$value->toarray();
              //多选
              if($value->type==4 || $value->type==5){
                $data['fileds'][$value->id]['value']=explode(',',$data['fileds'][$value->id]['value']);
              }
             $data['fileds'][$value->id]['filed_value']=$tab_info[$value->filed];
           } 
              //var_dump($data['fileds']);
              $this->assign('data',$data);
              $this->assign('tab_info',$tab_info);
              return $this->fetch('view_update');

      }else{
        $mould= MouldModel::get($request->get('mould_id'));
        $mould['edit']=$this->mb_unserialize($mould['edit']);
        foreach($mould['edit'] as $key=>$value){
            if(isset($value["validate"]) &&!empty($value["validate"])){
                        $filed=FiledsModel::get($key);
                         $validate_data[$filed->filed]=FiledsModel::getValidate($value["validate"]);
            }
        }
        if(!empty($validate_data)){
            $validate = new Validate($validate_data);
            if (!$validate->check($request->post())) {
                  $this->returnInfo(-1,'',$validate->getError());
            } 
        }
        $insert_data=$request->post();
        $id= $insert_data['mould_tab_id'];
        unset($insert_data['mould_tab_id']);
        Db::table($mould->table)->where('id',$id)->update($insert_data);
        if(!empty($mould['list'])){
            $this->returnInfo(0,'/index.php/admin/mould/view_columns?mould_id='.$request->get('mould_id'),'保存成功');               
        }else{
              $this->returnInfo(0,'/index.php/admin/mould/view_update?mould_id='.$request->get('mould_id').'&id='.$id,'保存成功');  
        }
      }
    }
    //模型列表
    public function view_columns(Request $request){
      $where['status']=['>',0];
      //post 查询

      if($request->post()){
        $post=$request->post();
          Session::set('mould_'.$request->get('mould_id').'.post',$post);   
      }else{
         $post=Session::get('mould_'.$request->get('mould_id').'.post');   
      }

      if(!empty($post)){
        foreach($post as $key=>$value){
          if(!empty($value)){
              if(strpos($key,'_') !== false){
                    $str=explode('_',$key);
                     $where[$str[0]]=['BETWEEN',strtotime($post[$str[0].'_min'].' 00:00:00').','.strtotime($post[$str[0].'_max'].'23:59:59')];
              }else{
                    $where[$key]=['like','%'.$value.'%'];
              }              
          }
        }        
      }
      if(empty($request->get('page'))){
            /*过滤参数*/
            $param=$request->get();
            unset($param['mould_id']);
            unset($param['page']);
            Session::set('mould_'.$request->get('mould_id').'.base',$param); 
            Session::delete('mould_'.$request->get('mould_id').'.post');
      }else{
            Session::get('mould_'.$request->get('mould_id').'.base');   
      }
      if(!empty($param)){
        foreach($param as $key=>$value){
          $where[$key]=['=',$value];
        }   
      }

      $mould= MouldModel::get($request->get('mould_id'));
      $data['info']=$mould->toarray();
      $data['info']['list']=unserialize($data['info']['list']);
      $data['info']['sreach']=unserialize($data['info']['sreach']);
      if(!empty($data['info']['sreach'])){
        foreach($data['info']['sreach'] as $val){
          if(  isset($val['iskey'])&&$val['iskey']==1){
                $iskey=1;
                break;
          }else{
                $iskey=0;
          }
        }
      }
      foreach(FiledsModel::all(['mould_id'=>$request->get('mould_id')]) as $value ){
                $fileds[$value->id]=$value->toarray();
                if($value->type=='4'){
                  $fileds[$value->id]['value']=explode(',',$fileds[$value->id]['value']);
                }
      }
      if(!empty($data['info']['list'])){
        foreach($data['info']['list'] as $key=>$value){
              $data['title'][$fileds[$key]['filed']]=$fileds[$key];
        }        
      }else{
        $data['info']['list']=array();
        $data['title']=array();
      }
      $list=Db::table($mould->table)->where($where)->paginate(15);
      $data['list']=$list; 
      $page = $list->render();
      $this->assign('post', $post);
      $this->assign('page', $page);
      $this->assign('fileds', $fileds);
      $this->assign('host', $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
      $this->assign('data',$data);
      $this->assign('iskey',$iskey);
      return $this->fetch('view_columns');
    }

    public function view_del(Request $request){
      $mould= MouldModel::get($request->get('mould_id'));
      DB::table($mould->table)->where('id', $request->get('id'))->update(['status' => -1]);
      $this->returnInfo(0,'','删除');
    }
    function mb_unserialize($serial_str) { 
        $serial_str = preg_replace_callback('!s:(\d+):"(.*?)";!s', create_function('$math',"return 's:'.strlen(\$math[2]).':\"'.\$math[2].'\";';"), $serial_str); 
        return unserialize($serial_str);
    }

}
