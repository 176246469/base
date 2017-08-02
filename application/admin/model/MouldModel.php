<?php
namespace app\admin\model;
use think\Cache;

class MouldModel   
{
   public static  function Type($key=0){
          $type=[
                      '1'=>'文本',
                      '2'=>'单选',
                      '3'=>'多选',
                      '4'=>'多行文本',
                      '5'=>'富文本',
                      '6'=>'日期',
                      '7'=>'图片',
                      '8'=>'附件',
            ];
        if(empty($key)){
              return  $type;
        }else{
           return  $type[$key];
        }
   }
}

?>
