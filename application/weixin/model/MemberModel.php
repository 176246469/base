<?php
namespace app\api\model;
use think\Cache;
use app\api\model\BaseModel;
class MemberModel  extends BaseModel
{

   protected $table = 'member';

    public function login($option){
      $member=  self::get(['name'=>trim($option['name'])]);
      
      if(empty($member)) {
          return '' ;
      }else{
     
        if($member->password==trim($option['password']) && $member->getData('status')==1){
          $member->token=md5($member->name+time());
          $member->save();
                  return $member->toarray();
                }else{
                  return '';
                }
      }
    }
    public function getStatusAttr($value){
       $status = [-1=>'删除',0=>'未审核',1=>'正常'];
       return $status[$value];
    }

}

?>
