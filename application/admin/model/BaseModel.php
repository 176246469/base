<?php
namespace app\admin\model;

use think\Model;

class BaseModel  extends Model
{
   protected function initialize(){
        parent::initialize();
   }

    public static function  gets($ids,$key='',$order=['id','desc'],$field='*'){
        $data=[];
        $option['ids']=$ids;
        $option['order']=$order;
        $option['field']=$field;
        foreach(self::all(
                    function($query) use ($option) {
                        if($option['ids'] === NULL){
                            $query->field( $option['field'])->order($option['order'][0],$option['order'][1]);          
                         }else{
                            $query->field( $option['field'])->where('id', 'in',$option['ids'])->order($option['order'][0],$option['order'][1]);
                         }
                    })  as $value){
            if(empty($key)){
                $data[]= $value->toArray();
            }else{
                $data[$value->$key]= $value->toArray();
            }
        }
        return $data;
    }
    
    public static function put($option){
        if(isset($option['id'])){
            $info = self::get($option['id']); 
        }else{
              $info = new self();
        }
    foreach($option as $key=>$value){
        $info->$key=$value;
    }
    return $info->save();
    }
 //   public static function puts($list){
            //return $this->saveAll($list);
   // }
//public static function rrr(){
   // public function list($where,$page){
            //    seft::where($where)->select();
 //   }

        public static function show(){
             echo 'test';
    }
}
?>
