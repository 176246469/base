<?php
namespace app\demo\model;

use think\Model;

class Base  extends Model
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

    function put($option){
            //修改
            if(isset(t($option['id'])){
                    unset($option['id']);
                    $this->save($option,['id'=>$option['id']]);
            //新增
            }else{


            }

    }
}
?>
