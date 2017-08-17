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

        public function set(Request $request){
            if(empty($request->post())){
              $mould= MouldModel::get($request->get('id'));
              $data['info']=$mould->toarray();
            
              $data['info']['add']=$this->mb_unserialize($data['info']['add']);
            //preg_replace_callback('#s:(\d+):"(.*?)";#s',function($match){return 's:'.strlen($match[2]).':"'.$match[2].'";' } );
                            //      $data['info']['add']=unserialize($match); 

              $data['info']['edit']=$this->mb_unserialize($data['info']['edit']);
              $data['info']['list']=$this->mb_unserialize($data['info']['list']);

              $data['info']['sreach']=$this->mb_unserialize($data['info']['sreach']);
              foreach (FiledsModel::all(['mould_id'=>$request->get('id')]) as $key => $value) {
                  $data['fileds'][$value->id]=$value->toarray();
              }
             // var_dump(  MouldModel::Type());exit();
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
                 $this->returnInfo(0,'/index.php/admin/mould/set?id='.$data['id'],'保存成功');       
            }
      }      
      //set_edit
      public function set_edit(Request $request){
            if(!empty($request->post())){
                $data=$request->post();
                $mould= MouldModel::get($data['id']);
                 
                $mould->edit=serialize($data['filed']);
                $mould->save();
                 $this->returnInfo(0,'/index.php/admin/mould/set?id='.$data['id'],'保存成功');       
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
                  if($value->type==2 || $value->type==3){
                    $data['fileds'][$value->id]['value']=explode('，',$data['fileds'][$value->id]['value']);
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
              if($value->type==2 || $value->type==3){
                $data['fileds'][$value->id]['value']=explode('，',$data['fileds'][$value->id]['value']);
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
              $this->returnInfo(0,'','保存成功');  
        }
      }
    }
    //模型列表
    public function view_columns(Request $request){
      $where['status']=['>',0];
      $mould= MouldModel::get($request->get('mould_id'));
      $data['info']=$mould->toarray();
      $data['info']['list']=unserialize($data['info']['list']);
      foreach(FiledsModel::all(['mould_id'=>$request->get('mould_id')]) as $value ){
                $fileds[$value->id]=$value->toarray();
      }
      if(!empty($data['info']['list'])){
        foreach($data['info']['list'] as $key=>$value){
              $data['title'][]=$fileds[$key];
        }        
      }else{
        $data['info']['list']=array();
        $data['title']=array();
      }
      $list=Db::table($mould->table)->where($where)->paginate(15);
      $data['list']=$list;
      $page = $list->render();
      $this->assign('page', $page);
      $this->assign('data',$data);
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
