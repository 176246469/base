<?php
namespace app\admin\model;
use think\Cache;
use app\admin\model\BaseModel;
class MouldModel  extends BaseModel  
{
    protected $table = 'mould';
   public static  function Type($key=0){
          $type=[
                      '1'=>'文本 [varchar(255)]',
                      '2'=>'单选[tinyint(1)]',
                      '3'=>'多选[tinyint(1)]',
                      '4'=>'多行文本[varchar(255)]',
                      '5'=>'富文本[text(255)]',
                      '6'=>'日期[int(11)]',
                      '7'=>'图片[varchar(255)]',
                      '8'=>'附件[varchar(255)]',
            ];
        if(empty($key)){
              return  $type;
        }else{
           return  $type[$key];
        }
   }
}

?>
