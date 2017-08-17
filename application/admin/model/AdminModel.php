<?php
namespace app\admin\model;
use think\Cache;
use app\admin\model\BaseModel;
use app\admin\model\GroupModel;
class AdminModel  extends BaseModel
{

   protected $table = 'admin';

    public function login($option){
      $admin=  self::get(['name'=>trim($option['name'])]);
      
      if(empty($admin)) {
          return '' ;
      }else{
     
        if($admin->password==trim($option['password']) && $admin->getData('status')==1){
                  //$admin->group=$admin->getData('group');
                  $rs=$admin->toarray();
                  $rs['group']=$admin->getData('group');
                  return $rs;
                }else{
                  return '';
                }
      }
    }
    public function getStatusAttr($value){
       $status = [-1=>'删除',0=>'未审核',1=>'正常'];
       return $status[$value];
    }
    public function getGroupAttr($value){
      $group=Cache::get('group');
      if(!$group){
            foreach (GroupModel::all() as  $val) {
               $group[$val['id']]=$val->toarray();
            }
             Cache::set('group',$group,60);
      }
       return $group[$value]['name'];
    }
}

?>
