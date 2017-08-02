<?php
namespace app\admin\model;

use app\admin\model\BaseModel;
use think\Cache;
class MenuModel  extends BaseModel
{

   protected $table = 'menu';

    public  static function getVals($pid=0)
    {    
        $data=Cache::get('menu');
        if(!$data){
          if($pid==0){
            foreach(self::all(['pid' => $pid]) as $value){
                foreach(self::all(['pid' => $value->id]) as $val){
                   $data[$value->id]['child'][]=$val->toarray();
                }
                $data[$value->id]['info']=$value->toarray();
            } 
          }else{ 
            $data[$pid]['info'] =self::get(['id' => $pid])->toarray();
                foreach(self::all(['pid' => $data[$pid]['info']['id']]) as $val){
                   $data[$pid]['child'][$val->id]=$val->toarray();
                }
          } 
        Cache::set('menu',$data,3600);
        }
        return $data;
   }


}

?>
